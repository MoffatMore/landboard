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
                    <li class="breadcrumb-item active" aria-current="page">Pending Applications</li>
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
        <div class="card border-info">
            <div class="card-header">
                <h4 class="card-title">My Pending Applications</h4>
            </div>
            <div class="card-body">
                <input type="hidden" name="_token" value="{{ @csrf_token() }}">
                <table id="example" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Location</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <!-- Modal -->
                            <div class="modal fade" id="model{{ $application->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="modelTitle{{ $application->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post"
                                          action="{{ route('customer.application.update',['application'=>$application->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Application</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Location</label>
                                                    <input type="text" name="plot_location" id="" class="form-control"
                                                           placeholder="" aria-describedby="helpId"
                                                           value="{{ $application->plot_location }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Address</label>
                                                    <input type="text" name="plot_address" id="" class="form-control"
                                                           placeholder="" aria-describedby="helpId"
                                                           value="{{ $application->plot_address }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modelDelete{{ $application->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="modelDelete{{ $application->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="{{ route('customer.application.destroy',['application'=>$application->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Application</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    Are you sure you want to delete this application?
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <td class="text-center">1</td>
                            <td>{{ $application->plot_location }}</td>
                            <td>{{ $application->plot_address }}</td>
                            <td>{{ $application->status }}</td>
                            <td class="td-actions text-right">
                                <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-icon">
                                    <i class="fa fa-edit" data-toggle="modal"
                                       data-target="#model{{ $application->id }}"></i>
                                </button>
                                <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-icon"
                                        data-toggle="modal"
                                        data-target="#modelDelete{{ $application->id }}">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop