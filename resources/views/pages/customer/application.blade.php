@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'dashboard'
])

@section('content')
   <div class="container-fluid " style="margin-top: 100px">
       <div class="card">
           <img class="card-img-top" src="holder.js/100x180/" alt="">
           <div class="card-body">
               <h4 class="card-title">Application for Plot</h4>

               <div class="row">
                   <div class="col-6">
                       <div class="form-group">
                           <label for="">Plot Location</label>
                           <select class="form-control form-control-sm" name="" id="" size="1">
                               <option>Molepolole</option>
                               <option>Lobatse</option>
                               <option>Gaborone</option>
                           </select>
                       </div>
                   </div>
                   <div class="col-6">
                       <div class="form-group">
                           <label for="">Plot Address/Ward</label>
                           <select class="form-control form-control-sm" name="" id="" size="1">
                               <option>Magokotswana</option>
                               <option>Newtown</option>
                               <option>Borakalalo</option>
                           </select>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-6">
                       <div class="form-group">
                           <label for="">Name</label>
                           <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId">
                           <small id="helpId" class="text-muted">Help text</small>
                       </div>
                   </div>
                   <div class="col-6">
                       <div class="form-group">
                           <label for="">Last Name</label>
                           <input type="text" name="last" id="" class="form-control" placeholder="" aria-describedby="helpId">
                           <small id="helpId" class="text-muted">Help text</small>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-6">
                       <div class="form-group">
                           <label for="">Contacts</label>
                           <input type="text" name="contacts" id="" class="form-control" placeholder="" aria-describedby="helpId">
                           <small id="helpId" class="text-muted">Help text</small>
                       </div>
                   </div>
                   <div class="col-6">
                       <div class="form-group">
                           <label for="">Gender</label>
                           <select class="form-control form-control-sm" name="gender" id="" size="1">
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
                           <input type="date" name="dob" id="" class="form-control" placeholder="" aria-describedby="helpId">
                           <small id="helpId" class="text-muted">Help text</small>
                       </div>
                   </div>
                   <div class="col-6">
                       <div class="form-group">
                           <label for="">Email Address</label>
                           <input type="text" name="email" id="" class="form-control" placeholder="" aria-describedby="helpId">
                           <small id="helpId" class="text-muted">Help text</small>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-6">
                       <div class="form-group">
                           <label for="">Postal Address</label>
                           <input type="text" name="" id="postal_address" class="form-control" placeholder="" aria-describedby="helpId">
                           <small id="helpId" class="text-muted">Help text</small>
                       </div>
                   </div>
                   <div class="col-6">
                       <div class="form-group">
                           <label for="">Physical Address</label>
                           <input type="text" name="physical_address" id="" class="form-control" placeholder="" aria-describedby="helpId">
                           <small id="helpId" class="text-muted">Help text</small>
                       </div>
                   </div>
               </div>
               <button type="button" class="btn btn-primary align-self-end">Submit</button>
           </div>
       </div>
   </div>
@stop