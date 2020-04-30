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
                    <li class="breadcrumb-item active" aria-current="page">Appointments</li>
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
                <h4 class="card-title">Pending Appointments</h4>
            </div>
            <div class="card-body">
                <input type="hidden" name="_token" value="{{ @csrf_token() }}">
                <table id="example" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Customer Name</th>
                        <th>Customer Surname</th>
                        <th>Customer Contacts</th>
                        <th>Venue</th>
                        <th>Date</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <!-- Modal -->
                            <div class="modal fade" id="model{{ $appointment->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="modelTitle{{ $appointment->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post"
                                          action="{{ route('admin.accept-application') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $appointment->id }}">
                                        <div class="modal-content">
                                            <div class="modal-header alert alert-success text-white">
                                                <h5 class="modal-title">Plot Application</h5>
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
                            <div class="modal fade" id="schedule{{ $appointment->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="modelTitle{{ $appointment->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post"
                                          action="{{ route('admin.appointment.update', ['appointment'=>$appointment->id]) }}">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="application_id" value="{{ $appointment->id }}">
                                        <input type="hidden" name="user_id" value="{{ $appointment->user->id }}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Schedule Interview</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Venue</label>
                                                    <input type="text" name="venue" id="" class="form-control"
                                                           placeholder="" aria-describedby="helpId"
                                                           value="{{ $appointment->venue }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Date</label>
                                                    <input type="datetime-local" name="date" id="" class="form-control"
                                                           value="{{ $appointment->date }}"
                                                           placeholder="" aria-describedby="helpId" required>
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
                            <td>{{ $appointment->user->name }}</td>
                            <td>{{ $appointment->user->profile->last }}</td>
                            <td>{{ $appointment->user->profile->contacts }}</td>
                            <td>{{ $appointment->venue }}</td>
                            <td>{{ $appointment->date }}</td>
                            <td class="td-actions text-right">
                                @if ($appointment->status !== 'rejected' && $appointment->status !== 'accepted')
                                    @if ($appointment->status !== 'Interview scheduled')
                                        <button type="button" rel="tooltip" title="Schedule Interview" class="btn btn-info btn-sm btn-icon">
                                            <i class="fa fa-calendar" data-toggle="modal"
                                               data-target="#schedule{{ $appointment->id }}"></i>
                                        </button>
                                    @endif
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