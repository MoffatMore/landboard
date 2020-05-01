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
                    <li class="breadcrumb-item active" aria-current="page">Statistics & Archives</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col-12">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-5">Statistics & Archives</h1>
                            <p class="lead">The following files shows all the records for each year</p>
                            <hr class="my-2">
                            @foreach ($years = range(\Carbon\Carbon::now()->year, 2016) as $year)
                                <div id="accordianId{{ $year }}" role="tablist" aria-multiselectable="false">
                                    <div class="card">
                                        <div class="card-header" role="tab" id="{{ $year }}">
                                            <h5 class="mb-2">
                                                <a data-toggle="collapse" data-parent="#accordianId{{ $year }}" href="#section1ContentId{{ $year }}"
                                                   aria-expanded="true" aria-controls="section1ContentId{{ $year }}">
                                                    <span class="badge badge-pill badge-info">{{ $year }}</span>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="section1ContentId{{ $year }}" class="collapse" role="tabpanel"
                                             aria-labelledby="section1HeaderId{{ $year }}">
                                            <div class="card-body">
                                                <div id="subaccordianId{{ $year }}" role="tablist" aria-multiselectable="true">
                                                    <div class="card">
                                                        <div class="card-header" role="tab" id="subsection1HeaderId">
                                                            <h5 class="mb-0">
                                                                <a data-toggle="collapse" data-parent="#subaccordianId{{ $year }}"
                                                                   href="#subsectionContentId" aria-expanded="true"
                                                                   aria-controls="sectionContentId">
                                                                    Registered Customers <span class="badge badge-pill badge-primary">
                                                                        @php
                                                                        $count = 0;
                                                                        foreach ($users as $user){
                                                                            if (\Carbon\Carbon::parse($user->created_at)->format('Y') === $year.''){
                                                                                $count++;
                                                                            }
                                                                        }
                                                                        echo $count;
                                                                        @endphp
                                                                    </span>
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="subsectionContentId" class="collapse in" role="tabpanel"
                                                             aria-labelledby="section1HeaderId">
                                                            <div class="card-body">
                                                                <table class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="text-center">#</th>
                                                                        <th>Name</th>
                                                                        <th>Surname</th>
                                                                        <th>Email</th>
                                                                        <th>Contacts</th>
                                                                        <th>Gender</th>
                                                                        <th>DOB</th>
                                                                        <th>Physical Address</th>
                                                                        <th>Postal Address</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach ($users as $user)
                                                                        @if ($user->hasRole('customer') && \Carbon\Carbon::parse($user->created_at)->format('Y') === $year.'')
                                                                            <tr>
                                                                                <td class="text-center">1</td>
                                                                                <td>{{ $user->name }}</td>
                                                                                <td>{{ $user->profile->last }}</td>
                                                                                <td>{{ $user->email }}</td>
                                                                                <td>{{ $user->profile->contacts }}</td>
                                                                                <td>{{ $user->profile->gender }}</td>
                                                                                <td>{{ $user->profile->dob }}</td>
                                                                                <td>{{ $user->profile->physical_address }}</td>
                                                                                <td>{{ $user->profile->postal_address }}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" role="tab" id="subsection1HeaderId">
                                                            <h5 class="mb-0">
                                                                <a data-toggle="collapse" data-parent="#subaccordianId{{ $year }}"
                                                                   href="#subsection1ContentId" aria-expanded="true"
                                                                   aria-controls="subsection1ContentId">
                                                                    Registered Plots <span class="badge badge-pill badge-primary">
                                                                        @php
                                                                            $count = 0;
                                                                            foreach ($plots as $plot){
                                                                                if (\Carbon\Carbon::parse($plot->created_at)->format('Y') === $year.''){
                                                                                    $count++;
                                                                                }
                                                                            }
                                                                            echo $count;
                                                                        @endphp
                                                                    </span>
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="subsection1ContentId" class="collapse in" role="tabpanel"
                                                             aria-labelledby="section1HeaderId">
                                                            <div class="card-body">
                                                                <table class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="text-center">#</th>
                                                                        <th>Plot No</th>
                                                                        <th>Location</th>
                                                                        <th>Address</th>
                                                                        <th>Owner</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach ($plots as $plot)
                                                                        @if (\Carbon\Carbon::parse($plot->created_at)->format('Y') === $year.'')
                                                                            <tr>
                                                                                <td class="text-center">{{ $plot->id }}</td>
                                                                                <td>{{ $plot->plot_no }}</td>
                                                                                <td>{{ $plot->location }}</td>
                                                                                <td>{{ $plot->address }}</td>
                                                                                <td>{{ $plot->user->name }}</td>
                                                                                <td>{{ $plot->status }}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" role="tab" id="subsection2HeaderId">
                                                            <h5 class="mb-0">
                                                                <a data-toggle="collapse" data-parent="#subaccordianId{{ $year }}"
                                                                   href="#subsection2ContentId" aria-expanded="true"
                                                                   aria-controls="section2ContentId">
                                                                    Applicants <span class="badge badge-pill badge-primary">
                                                                        @php
                                                                            $count = 0;
                                                                            foreach ($applications as $app){
                                                                                if (\Carbon\Carbon::parse($app->created_at)->format('Y') === $year.''){
                                                                                    $count++;
                                                                                }
                                                                            }
                                                                            echo $count;
                                                                        @endphp
                                                                    </span>
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="subsection2ContentId" class="collapse in" role="tabpanel"
                                                             aria-labelledby="subsection2HeaderId">
                                                            <div class="card-body">
                                                                <table class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="text-center">#</th>
                                                                        <th>Name</th>
                                                                        <th>Location</th>
                                                                        <th>Address</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach ($applications as $app)
                                                                        @if (\Carbon\Carbon::parse($app->created_at)->format('Y') === $year.'')
                                                                            <tr>
                                                                                <td class="text-center">{{ $plot->id }}</td>
                                                                                <td>{{ $app->user->name }}</td>
                                                                                <td>{{ $app->plot_location }}</td>
                                                                                <td>{{ $app->plot_address }}</td>
                                                                                <td>
                                                                                    @if ($app->status === 'accepted')
                                                                                        <i class="fa fa-check text-success" title="Approved"></i>

                                                                                    @elseif($app->status === 'pending')
                                                                                        <i class="fa fa-exchange text-warning " title="Pending"></i>
                                                                                    @else
                                                                                        <i class="fa fa-times text-danger" title="Rejected"></i>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" role="tab" id="subsection3HeaderId">
                                                            <h5 class="mb-0">
                                                                <a data-toggle="collapse" data-parent="#subaccordianId{{ $year }}"
                                                                   href="#subsection3ContentId" aria-expanded="true"
                                                                   aria-controls="section2ContentId">
                                                                    Plots Transfers <span class="badge badge-pill badge-primary">
                                                                        @php
                                                                            $count = 0;
                                                                            foreach ($ownershipTransfer as $app){
                                                                                if (\Carbon\Carbon::parse($app->created_at)->format('Y') === $year.''){
                                                                                    $count++;
                                                                                }
                                                                            }
                                                                            echo $count;
                                                                        @endphp
                                                                    </span>
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="subsection3ContentId" class="collapse in" role="tabpanel"
                                                             aria-labelledby="section2HeaderId">
                                                            <div class="card-body">
                                                                <table class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="text-center">#</th>
                                                                        <th>Plot No</th>
                                                                        <th>Location</th>
                                                                        <th>Address</th>
                                                                        <th>Owner</th>
                                                                        <th>Transferee</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach ($ownershipTransfer as $app)
                                                                        @if (\Carbon\Carbon::parse($app->created_at)->format('Y') === $year.'')
                                                                            <tr>
                                                                                <td class="text-center">{{ $plot->id }}</td>
                                                                                <td>{{ $app->plot->plot_no }}</td>
                                                                                <td>{{ $app->plot->location }}</td>
                                                                                <td>{{ $app->plot->address }}</td>
                                                                                <td>{{ $app->user->name }}</td>
                                                                                <td>{{ $app->transferee->name }}</td>
                                                                                <td>
                                                                                    @if ($app->status === 'transfered')
                                                                                        <i class="fa fa-check text-success" title="Approved"></i>

                                                                                    @elseif($app->status === 'pending')
                                                                                        <i class="fa fa-exchange text-warning " title="Pending"></i>
                                                                                    @else
                                                                                        <i class="fa fa-times text-danger" title="Rejected"></i>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                           </div>
                    </div>
                </div>
        </div>
    </div>
@stop

@push('scripts')
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src=""></script>
    <script src=""></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                'search': true,
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'User Details for '+data[1];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                }
            } );
        } );
    </script>
@endpush