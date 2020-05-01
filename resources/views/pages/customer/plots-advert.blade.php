@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'Plot Adverts'
])

@section('content')
    <div class="container-fluid " style="margin-top: 100px">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Plot Adverts</li>
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
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="card-title">List of Available Plots</h4>
                        <table id="example" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Address</th>
                                <th>Closing Date</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Location</th>
                                <th>Address/Ward</th>
                                <th>Closing Date</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach ($adverts as $advert)
                                @php
                                $found = false;
                                @endphp
                                @if ($advert->closing_date >= now())
                                    @foreach ($applications as $app)
                                        @if ($advert->location === $app->plot_location && $advert->address === $app->plot_address )
                                          @php
                                          $found = true;
                                          @endphp
                                            @break
                                        @endif
                                    @endforeach
                                    <tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="model{{ $advert->id }}" tabindex="-1" role="dialog"
                                             aria-labelledby="modelTitle{{ $advert->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <form method="POST" action="{{ route('customer.application.store') }}">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Application for Plot</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="">Plot Location</label>
                                                                        <input type="text" class="form-control" aria-describedby="helpId"
                                                                               value="{{ $advert->location }}" readonly>
                                                                        <input type="hidden" name="plot_location" value="{{ $advert->location }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="">Plot Address/Ward</label>
                                                                        <input type="text" class="form-control" aria-describedby="helpId"
                                                                               value="{{ $advert->address }}" readonly>
                                                                        <input type="hidden" name="plot_address" value="{{ $advert->address }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="">Name</label>
                                                                        <input type="text" name="name" id="" class="form-control"
                                                                               placeholder="" aria-describedby="helpId"
                                                                               value="{{ Auth::user()->name }}" required>
                                                                        <small id="helpId" class="text-muted">Help text</small>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="">Last Name</label>
                                                                        <input type="text" name="last" id="" class="form-control"
                                                                               placeholder="" aria-describedby="helpId"
                                                                               value="{{ isset($profile) ? $profile->last : '' }}" required>
                                                                        <small id="helpId" class="text-muted">Help text</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="">Identifier</label>
                                                                        <select class="form-control form-control-sm"
                                                                                name="gender" id="" size="1"
                                                                                value="{{ isset($profile) ? $profile->identifier: '' }}"required>
                                                                            <option>Omang</option>
                                                                            <option>Passport</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="">ID/Passport No</label>
                                                                        <input type="text" name="contacts" id="" class="form-control"
                                                                               placeholder="" aria-describedby="helpId"
                                                                               value="{{ isset($profile) ? $profile->id_no : '' }}" required>
                                                                        <small id="helpId" class="text-muted">Help text</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="">Contacts</label>
                                                                        <input type="text" name="contacts" id="" class="form-control"
                                                                               placeholder="" aria-describedby="helpId"
                                                                               value="{{ isset($profile) ? $profile->contacts : '' }}" required>
                                                                        <small id="helpId" class="text-muted">Help text</small>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="">Gender</label>
                                                                        <select class="form-control form-control-sm"
                                                                                name="gender" id="" size="1"
                                                                                value="{{ isset($profile) ? $profile->gender : '' }}"required>
                                                                            <option>Male</option>
                                                                            <option>Female</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="">DOB</label>
                                                                        <input type="date" name="dob" id="" class="form-control"
                                                                               placeholder=""
                                                                               value="{{ isset($profile) ? $profile->dob : '' }}" aria-describedby="helpId"
                                                                               required >
                                                                        <small id="helpId" class="text-muted">Help text</small>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="">Email Address</label>
                                                                        <input type="text" name="email" id="" class="form-control"
                                                                               placeholder="" aria-describedby="helpId"
                                                                               value="{{ Auth::user()->email }}" required>
                                                                        <small id="helpId" class="text-muted">Help text</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="">Postal Address</label>
                                                                        <input type="text" name="postal_address" id="postal_address" class="form-control"
                                                                               placeholder=""
                                                                               value="{{ isset($profile) ? $profile->postal_address : '' }}" aria-describedby="helpId" required>
                                                                        <small id="helpId" class="text-muted">Help text</small>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="">Physical Address</label>
                                                                        <input type="text" name="physical_address" id="" class="form-control"
                                                                               placeholder="" aria-describedby="helpId"
                                                                               value="{{ isset($profile) ? $profile->physical_address : '' }}"required>
                                                                        <small id="helpId" class="text-muted">Help text</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <button type="submit" class="btn btn-primary align-self-end">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <td>{{ $advert->location }}</td>
                                        <td>{{ $advert->address }}</td>
                                        <td>{{ $advert->closing_date }}</td>
                                        <td class="text-right">
                                            <!-- Button trigger modal -->
                                            @if (!$found)
                                                <a href="javascript:;" title="Apply for plot" data-toggle="modal"
                                                   data-target="#model{{ $advert->id }}"
                                                   class="btn btn-info btn-link btn-sm like">
                                                    <i class="fa fa-send"></i>
                                                </a>
                                            @else
                                                <a href="javascript:;" title="Application sent"
                                                   class="btn btn-success btn-sm like">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            @endif

                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end col-md-12 -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>

@stop