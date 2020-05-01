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
                    <li class="breadcrumb-item active" aria-current="page">Plot Transfer</li>
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
                <h4 class="card-title">Pending Plots Transfer</h4>
            </div>
            <div class="card-body">
                <input type="hidden" name="_token" value="{{ @csrf_token() }}">
                <table id="example" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Plot No</th>
                        <th>Owner</th>
                        <th>Transferee</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($ownershipTransfer as $transfer)
                        <tr>
                            <!-- Modal -->
                            <div class="modal fade" id="model{{ $transfer->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="modelTitle{{ $transfer->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post"
                                          action="{{ route('admin.accept-transfer') }}">
                                        @csrf
                                        <input type="hidden" name="transfer_id" value="{{ $transfer->id }}">
                                        <input type="hidden" name="plot_id" value="{{ $transfer->plot->id }}">
                                        <div class="modal-content">
                                            <div class="modal-header alert alert-success text-white">
                                                <h5 class="modal-title">Plot Transfer Application</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="">Are you sure you want to accept application?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                                </button>
                                                <button type="submit" class="btn btn-success">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="modelDelete{{ $transfer->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="modelDelete{{ $transfer->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="get" action="{{ route('admin.reject-transfer-application',['id'=>$transfer->id]) }}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header alert alert-danger">
                                                <h5 class="modal-title">Reject Transfer Plot Application</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    Are you sure you want to reject this plot transfer application?
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
                            <td>{{ $transfer->plot_no }}</td>
                            <td>{{ $transfer->user->name }}</td>
                            <td>{{ $transfer->transferee->name }}</td>
                            <td>{{ $transfer->status }}</td>
                            <td class="td-actions text-right">
                                @if ($transfer->status !== 'rejected' && $transfer->status !== 'transfered')
                                    <button type="button" rel="tooltip" title="Approve" class="btn btn-success btn-sm btn-icon">
                                        <i class="fa fa-check" data-toggle="modal"
                                           data-target="#model{{ $transfer->id }}"></i>
                                    </button>
                                    <button type="button" rel="tooltip" title="Reject" class="btn btn-danger btn-sm btn-icon"
                                            data-toggle="modal"
                                            data-target="#modelDelete{{ $transfer->id }}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop