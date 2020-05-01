@extends('layouts.app', [
    'class' => 'alert alert-secondary',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
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
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-audio-description text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Plots Adverts</p>
                                    <p class="card-title">
                                    {{ $adverts->count() }}
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <a href="{{ route('customer.plots-advert') }}"><i class="fa fa-arrow-circle-right"></i> Click here</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-edit text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Plot Application</p>
                                    <p class="card-title">
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <a href="{{ route('customer.application.create') }}"><i class="fa fa-arrow-circle-right"></i> Click here</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-home text-info"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Manage Plots</p>
                                    <p class="card-title">
                                    {{ $plots->count() }}
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <a href="{{ route('customer.myPlots') }}"><i class="fa fa-arrow-circle-right"></i> Click here</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-exclamation text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Pending Applications</p>
                                    <p class="card-title">
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <a href="{{ route('customer.application.index') }}"><i class="fa fa-arrow-circle-right"></i> Click here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-cols-6">
                <div class="card">
                    <div class="card-body">

                        <!-- markup -->
                        <div id="calendar" class="mt-3"></div>
                    </div>
                </div>
            </div>
    </div>
@endsection

@push('scripts')

    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script src="https://unpkg.com/@fullcalendar/core@4.4.0/main.min.js"></script>
    <script src="https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.js"></script>
    <script src="https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.js"></script>
    <script src="https://unpkg.com/@fullcalendar/list@4.4.0/main.min.js"></script>
    <script src="https://unpkg.com/@fullcalendar/bootstrap@4.4.0/main.min.js"></script>
    <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let events= {!! json_encode($events) !!};

            console.log(events);
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'dayGrid', 'timeGrid', 'list', 'bootstrap' ],
                timeZone: 'UTC+2',
                defaultView: 'dayGridMonth',
                themeSystem: 'bootstrap',
                header: {
                    left: 'prevYear,prev,next,nextYear today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                businessHours: [ // specify an array instead
                    {
                        daysOfWeek: [ 1, 2, 3 ], // Monday, Tuesday, Wednesday
                        startTime: '08:00', // 8am
                        endTime: '18:00' // 6pm
                    },
                    {
                        daysOfWeek: [ 4, 5 ], // Thursday, Friday
                        startTime: '08:00', // 10am
                        endTime: '18:00' // 4pm
                    }
                ],
                weekNumbers: false,
                weekends: false,
                contentHeight: 400,
                eventLimit: true,
                events: events,
                eventColor: '#5393e0',
                eventTextColor: 'white',
                eventTimeFormat: { // like '14:30:00'
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false
                },
                eventRender: function (info) {

                    $(info.el).tooltip({
                        title: info.event.extendedProps.description,
                        trigger: 'hover',
                        placement: 'top',
                        container: 'body',
                    });
                }
            });

            calendar.render();
        });
        <!-- javascript for init -->

    </script>
@endpush