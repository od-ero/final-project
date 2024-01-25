@extends('layouts.app-master')
@section('subtitle')
Give access permission
@endsection

@section('contentheader_title')
Give access permission
@endsection

@section('content')
   
      
<form name="register-form" id="register-form" method="post" action="{{url('/register')}}">
<div class="container">

  
    <fieldset>
    <legend>Give Priviledges</legend>
    <p>Please Fill In This Form To Assign Access Priviledges.</p>

    <hr>
    
    <input class="userInput" type="hidden" name="_token" value="{{ csrf_token() }}" />
    <label for="fname"><b>User</b></label>
    <input  class="userInput" type="text" placeholder="Enter Your First Name" name="fname" id="fname" required>
    <label for="open"><i>Select either to use existing permissions or to create a new one</i></label>
 <div class="d-flex align-items-center userInput">
 <div class="form-check form-check-inline" >
      <label class="form-check-label" for="inlineRadio1">Use existing</label>
      <input class="form-check-input" type="radio" name="permission_group" id="use_existing" value="use_existing">
    </div>
<div class="form-check form-check-inline ">
    <label class="form-check-label" for="inlineRadio2">Create A new one</label>
   <input class="form-check-input" type="radio" name="permission_group" id="create_new" value="create_new" checked>
 </div>

 </div>
<label for="role_id"><b>Role</b></label>

  <select  name="role_id" id="role_id" required class="form-control userInput">
    <option value="">Select</option>
    @foreach($roles as $role)
        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
    @endforeach

</div>
  <label for="unit_id"><b>Unit</b></label>
<select name="unit_id" id="unit_id" required class="form-control userInput">
    <option value="">select</option>
    @foreach($units as $unit)
        <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
    @endforeach
</select>

    <label for="email"><b>Start Date</b></label>
    <input class="userInput" type="datetime-local" placeholder="Please Enter the check in time" name="start_date" id="start_date" required>

    <label for="phone"><b>End Date</b></label>
    <input class="userInput" type="datetime-local" placeholder="Please Enter the check out time" name="end_date" id="end_date" required>
    
    
    <label for="open"><i>Select the the doors to be affected by the permissions</i></label>
    
   
<div class="userCheck  userInput" >
@foreach($doors as $door)
<div class="form-check" >
<label class="form-check-label" for="flexCheckDefault">
  {{$door->door_name}}
  </label>
  <input class="form-check-input" type="checkbox" name="door_id_" value="{{ $door->id }}" id="flexCheckDefault">
</div>
@endforeach
</div>
    <label for="permission_group"><b>Permission Name</b></label>
    <input class="userInput"type="text" placeholder="Please Enter permission Name" name="permission_group" id="permission_group" required>
   
    <label for="open"><b>Give Access Permission</b></label>
    <div class="d-flex align-items-center userInput">
    <div class="form-check form-check-inline">
        <label class="form-check-label" for="inlineRadio1">Yes</label>
        <input class="form-check-input" type="radio" name="give_permission" id="give_permission_yes" value="yes">
    </div>

    <div class="form-check form-check-inline">
        <label class="form-check-label" for="inlineRadio2">No</label>
        <input class="form-check-input" type="radio" name="give_permission" id="give_permission_no" value="no">
    </div>

    <div class="form-floating ">
        <input type="text" class="form-control" name="give_permission_fre" value="{{ old('give_permission_fre') }}" placeholder="Frequency" required="required" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
</div>

  <label for="open"><b>Open</b></label>
 <div class="d-flex align-items-center userInput">
 <div class="form-check form-check-inline" >
      <label class="form-check-label" for="inlineRadio1">Yes</label>
      <input class="form-check-input" type="radio" name="open" id="open_yes" value="yes">
    </div>
<div class="form-check form-check-inline">
    <label class="form-check-label" for="inlineRadio2">No</label>
   <input class="form-check-input" type="radio" name="open" id="open_no" value="no">
 </div>
 <div class="form-floating">
        <input type="text" class="form-control" name="open_fre" value="{{ old('open_fre') }}" placeholder="Frequency" required="required" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
 </div>
  
 <label for="open"><b>Close</b></label>
  <div class="d-flex align-items-center userInput">
  <div class="form-check form-check-inline ">
      <label class="form-check-label" for="inlineRadio1">Yes</label>
      <input class="form-check-input" type="radio" name="close" id="close_yes" value="yes">
    </div>
<div class="form-check form-check-inline">
   <label class="form-check-label" for="inlineRadio2">No</label>
   <input class="form-check-input" type="radio" name="close" id="close_no" value="no">
 </div>
 <div class="form-floating">
        <input type="text" class="form-control" name="close_fre" value="{{ old('close_fre') }}" placeholder="Frequency" required="required" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
  </div>

 <label for="open"><b>Schedule Button Access</b></label>
 <div class="d-flex align-items-center userInput">
 <div class="form-check form-check-inline ">
      <label class="form-check-label" for="inlineRadio1">Yes</label>
      <input class="form-check-input" type="radio" name="schedule" id="schedule_yes" value="yes">
    </div>
<div class="form-check form-check-inline">
   <label class="form-check-label" for="inlineRadio2">No</label>
   <input class="form-check-input" type="radio" name="schedule" id="schedule_no" value="no">
 </div>
 <div class="form-floating">
        <input type="text" class="form-control" name="schedule_fre" value="{{ old('schedule_fre') }}" placeholder="Frequency" required="required" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
 </div>
    <hr>
 
  <button type="submit" class="btn btn-primary">Give Priviledges</button>
  </fieldset>
</div>
</form>  

@endsection