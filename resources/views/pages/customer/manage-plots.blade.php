@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="container-fluid " style="margin-top: 100px">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Plots</li>
                </ol>
            </nav>
        </div>
        @if(Session::has('status'))
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <strong>Alert!</strong> {{  Session::get('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(Session::has('fail'))
            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                <strong>Alert!</strong> {{  Session::get('fail') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">List of my plots</h4>
            </div>
            <div class="card-body">
                @isset($plots)
                <table id="example" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%" >
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Location</th>
                        <th>Address</th>
                        <th>Plot Number</th>
                        <th>Plot Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($plots as $plot)
                        <tr>
                            <!-- Modal -->
                            <div class="modal fade" id="model{{ $plot->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="modelTitle{{ $plot->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title">Transfer Plot</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <form action="{{ route('customer.transfer-plot') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">Plot No</label>
                                                        <input type="text" name="plot_no" id="" class="form-control"
                                                               placeholder="" aria-describedby="helpId" readonly
                                                               value="{{ $plot->plot_no }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Location</label>
                                                        <input type="text" name="location" id="" class="form-control"
                                                               placeholder="" aria-describedby="helpId" readonly
                                                               value="{{ $plot->location }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Address</label>
                                                        <input type="text" name="plot_address" id="" class="form-control"
                                                               placeholder="" aria-describedby="helpId" readonly
                                                               value="{{ $plot->address }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Transferee</label>
                                                        <select class="form-control form-control-sm" name="transferee" id="" size="1">
                                                            @if (isset($users))
                                                                @foreach ($users as $user)
                                                                    @if ($user->id !== Auth::user()->id)
                                                                        <option value="{{ $user->id }}">
                                                                            {{ $user->name }} {{ isset($user->profile) ? $user->profile->id_no : '' }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Request</button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                            <td class="text-center">{{ $plot->id }}</td>
                            <td>{{ $plot->location }}</td>
                            <td>{{ $plot->address }}</td>
                            <td>{{ $plot->plot_no }}</td>
                            <td>{{ $plot->status === 'approved' ? 'Active' : 'Transfer' }}</td>
                            <td class="td-actions text-right">
                                @if ($plot->status === 'approved')
                                    <button type="button" rel="tooltip" title="Transfer plot" class="btn btn-success btn-sm btn-icon"
                                            data-toggle="modal" data-target="#model{{ $plot->id }}">
                                        <i class="fa fa-exchange" ></i>
                                    </button>
                                @else
                                    <button type="button" rel="tooltip" title="Cancel Transfer plot Request"
                                            class="btn btn-danger btn-sm btn-icon" data-toggle="modal"
                                            data-toggle="modal" data-target="#delete{{ $plot->id }}">
                                        <i class="fa fa-trash" ></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $plot->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="modelTitle{{ $plot->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Cancel Ownership Transfer</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p style="text-align: justify">By clicking below save button, you agree to cancel request to transfer ownership of this plot</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning btn-md"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <div class="clearfix"></div>
                                                    <form method="get" action="{{ route('customer.cancel-transfer',['id'=>$plot->plot_no]) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info btn-md">Save</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    @else
                    <div class="alert alert-warning" role="alert">
                        <strong>No plots at the moment!</strong>
                    </div>
                @endisset
            </div>
        </div>
    </div>
@stop