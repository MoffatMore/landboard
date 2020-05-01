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
                    <li class="breadcrumb-item active" aria-current="page">Waiting List</li>
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
                <h4 class="card-title">Pending Applications</h4>
            </div>
            <div class="card-body">
                <input type="hidden" name="_token" value="{{ @csrf_token() }}">
                <table id="example" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Location</th>
                        <th>Address</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Contacts</th>
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
                                          action="{{ route('admin.accept-application') }}">
                                        @csrf
                                       <input type="hidden" name="id" value="{{ $application->id }}">
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
                            <div class="modal fade" id="schedule{{ $application->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="modelTitle{{ $application->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post"
                                          action="{{ route('admin.appointment.store') }}">
                                        @csrf
                                        <input type="hidden" name="application_id" value="{{ $application->id }}">
                                        <input type="hidden" name="user_id" value="{{ $application->user->id }}">
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
                                                           value="{{ $application->plot_location }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Date</label>
                                                    <input type="datetime-local" name="date" id="" class="form-control"
                                                           placeholder="" aria-describedby="helpId">
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

                            @inject('home','App\Http\Controllers\Admin\HomeController')
                            @if ($home->getSchedule($application->id))
                                <!-- Modal -->
                                    <div class="modal fade" id="editschedule{{ $application->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="modelTitle{{ $application->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form method="post"
                                                  action="{{ route('admin.appointment.update',['appointment'=>$home->getSchedule($application->id)->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="application_id" value="{{ $application->id }}">
                                                <input type="hidden" name="user_id" value="{{ $application->user->id }}">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Interview Schedule</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Venue</label>
                                                            <input type="text" name="venue" id="" class="form-control"
                                                                   value="{{ $home->getSchedule($application->id)->venue }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Date</label>
                                                            <input type="datetime-local" name="date" id="" class="form-control"
                                                            value="{{ $home->getSchedule($application->id)->date }}" required>
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
                            @endif
                            <!-- Modal -->
                            <div class="modal fade" id="modelDelete{{ $application->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="modelDelete{{ $application->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="get" action="{{ route('admin.reject-application',['id'=>$application->id]) }}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Application</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    Are you sure you want to reject this application?
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
                            <td>{{ $application->user->name }}</td>
                            <td>{{ $application->user->profile->last }}</td>
                            <td>{{ $application->user->profile->contacts }}</td>
                            <td>{{ $application->status }}</td>
                            <td class="td-actions text-right">
                                @if ($application->status !== 'rejected' && $application->status !== 'accepted')
                                    @if ($application->status !== 'Interview scheduled')
                                        <button type="button" rel="tooltip" title="Schedule Interview" class="btn btn-info btn-sm btn-icon">
                                            <i class="fa fa-calendar" data-toggle="modal"
                                               data-target="#schedule{{ $application->id }}"></i>
                                        </button>
                                    @else
                                        <button type="button" rel="tooltip" title="Edit Interview Schedule" class="btn btn-warning btn-sm btn-icon">
                                            <i class="fa fa-edit" data-toggle="modal"
                                               data-target="#editschedule{{ $application->id }}"></i>
                                        </button>
                                    @endif
                                    <button type="button" rel="tooltip" title="Approve" class="btn btn-success btn-sm btn-icon">
                                        <i class="fa fa-check" data-toggle="modal"
                                           data-target="#model{{ $application->id }}"></i>
                                    </button>
                                    <button type="button" rel="tooltip" title="Reject" class="btn btn-danger btn-sm btn-icon"
                                            data-toggle="modal"
                                            data-target="#modelDelete{{ $application->id }}">
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