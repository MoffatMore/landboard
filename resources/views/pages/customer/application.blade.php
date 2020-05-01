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
                   <li class="breadcrumb-item active" aria-current="page">Plot Application</li>
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
           <img class="card-img-top" src="holder.js/100x180/" alt="">
           <div class="card-body">
               <h4 class="card-title">Application for Plot</h4>
               <form method="POST" action="{{ route('customer.application.store') }}">
                   @csrf
                   <div class="row">
                       <div class="col-6">
                           <div class="form-group">
                               <label for="">Plot Location</label>
                               <select class="form-control form-control-sm" name="plot_location" id="" size="1">
                                   @foreach ($locations as $advert)
                                       <option>{{ $advert->location }}</option>
                                   @endforeach
                               </select>
                           </div>
                       </div>
                       <div class="col-6">
                           <div class="form-group">
                               <label for="">Plot Address/Ward</label>
                               <select class="form-control form-control-sm" name="plot_address" id="" size="1">
                                   @foreach ($address as $advert)
                                       <option>{{ $advert->address }}</option>
                                   @endforeach
                               </select>
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
                   <button type="submit" class="btn btn-primary align-self-end">Submit</button>
               </form>
           </div>
       </div>
   </div>
@stop