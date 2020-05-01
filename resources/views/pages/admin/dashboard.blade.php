@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-user text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Waiting List</p>
                                    <p class="card-title">
                                    {{ $applications->count() }}
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <a href="{{ route('admin.waiting-list') }}">
                                <i class="fa fa-arrow-right"></i> Click here</a>
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
                                    <i class="fa fa-home text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Ownership Transfer</p>
                                    <p class="card-title">
                                    {{ $ownershipTransfer->count() }}
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                           <a href="{{ route('admin.ownership-transfer') }}"><i class="fa fa-arrow-right"></i> Click here</a>
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
                                    <i class="fa fa-calendar text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Appointments</p>
                                    <p class="card-title">
                                    {{ $appointments->count() }}
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <a href="{{ route('admin.appointment.index') }}"><i class="fa fa-arrow-right"></i> Click here</a>
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
                                    <i class="fa fa-file text-primary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Statistics &  Archives</p>
                                    <p class="card-title">
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                           <a href="{{ route('admin.statistics') }}"> <i class="fa fa-arrow-right"></i> click here</a>
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