@extends('layouts.app-master')
@section('subtitle')
 Give access permission
@endsection

@section('contentheader_title')
    Give access permission
@endsection

@section('content')
   
     
<form name="add_permission" id="add_permission" method="post" action="{{ url('/add/permissions/' .$encoded_permission_id) }}">


    <fieldset>
  
   <legend>Give Access Priviledges To <b class="text-uppercase"> {{$unit['premises_name'] . ', ' . $unit['unit_name']}}</b> </legend>
    <p>Please Fill In This Form To Assign Access Priviledges.</p>

   
    <hr>
    
    <input class="userInput" type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input  class="userInput" id="owner_id" type="hidden"  name="user_id">
    <label for="door"><i>Select the the doors to be affected by the permissions</i></label>
      <div class="userCheck userInput">
          @foreach($doors as $index => $door)
              <div class="form-check">
                  <label class="form-check-label" for="flexCheckDefault">
                      {{ $door->door_name }}
                  </label>
                  <input class="form-check-input" type="checkbox" name="door_id_{{ $index + 1 }}" value="{{ $door->id }}" id="flexCheckDefault">
              </div>
          @endforeach
      </div>
    <label for="fname"><b>User</b></label>
    <p><i>
      Kindly enter either of the Users name and and phone number and search to select the user
    </i></p>
   
    <div class="row userxxInput">
        <div class="col-5">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="name" name="name" value="{{ old('name') }}" placeholder=" " required="required" autofocus>
                <label for="name">Name</label>
            </div>
        </div>

        <div class="col-5">
            <div class="form-floating mt-3 mb-3">
                <input type="tel" class=".inputUserInput form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder=" " required="required" autofocus>
                <label for="phone">Phone number</label>
            </div>
        </div>

        <div class="col-2 mt-4 mb-3">
            <button class="btn btn-outline-secondary" type="button" id="userSearchButton">search</button>
        </div>
        
        </div>
        <ul class="dropdown-menu" id="searchResults" style="display: none;">
    <!-- Display search results here -->
</ul>
   

    <label for="selectPermissionGroup"><i>Select either to use existing permissions or to create a new one</i></label>
    <div class="d-flex align-items-center userInput">
        <div class="form-check form-check-inline" >
              <label class="form-check-label" for="inlineRadio1">Use existing</label>
              <input class="form-check-input" type="radio" name="permission_group" id="use_existing" value="use_existing">
           </div>
         <div class="form-check form-check-inline ">
            <label class="form-check-label" for="inlineRadio2">Create A new one</label>
            <input class="form-check-input" type="radio" name="permission_group" id="create_new" value="create_new">
         </div>

        </div>
        <div class="use_existing">
            <label for="permission_group_id"><i>Permision Name</i></label>
            <select  name="permission_group_id" id="permission_group_id" required class="form-control userInput">
              <option value="">Select</option>
              @foreach($permission_groups as $permission_group)
                  <option value="{{ $permission_group->id }}"> {{ $permission_group->name }}</option>
              @endforeach
            </select>
       </div> 
      <div class="create_new">
            
       <label for="permission_group_name"><b>Permission Name</b></label>
    <input class="userInput"type="text" placeholder="Please Enter permission Name" name="permission_group_name" id="permission_group_name" required>
   
    <label for="give_permission"><b>Give Access Permission</b></label>
    <div class="d-flex align-items-center userInput">
    <div class="form-check form-check-inline">
        <label class="form-check-label" for="give_permission_yes">Yes</label>
        <input class="form-check-input" type="radio" name="give_permission" id="give_permission_yes" value="yes">
    </div>

    <div class="form-check form-check-inline">
        <label class="form-check-label" for="give_permission_no">No</label>
        <input class="form-check-input" type="radio" name="give_permission" id="give_permission_no" value="no">
    </div>

    <div class="form-floating ">
        <input type="text" class="form-control" name="give_permission_fre" value="{{ old('give_permission_fre') }}" placeholder="Frequency"  autofocus>
        <label for="give_permission_fre">Frequency</label>
    </div>
</div>

  <label for="open"><b>Unlock</b></label>
 <div class="d-flex align-items-center userInput">
 <div class="form-check form-check-inline" >
      <label class="form-check-label" for="open_yes">Yes</label>
      <input class="form-check-input" type="radio" name="open" id="open_yes" value="yes">
    </div>
<div class="form-check form-check-inline">
    <label class="form-check-label" for="open_no">No</label>
   <input class="form-check-input" type="radio" name="open" id="open_no" value="no">
 </div>
 <div class="form-floating">
        <input type="text" class="form-control" name="open_fre" value="{{ old('open_fre') }}" placeholder="Frequency"  autofocus>
        <label for="open_fre">Frequency</label>
    </div>
 </div>
  
 <label for="open"><b>Lock</b></label>
  <div class="d-flex align-items-center userInput">
  <div class="form-check form-check-inline ">
      <label class="form-check-label" for="close_yes">Yes</label>
      <input class="form-check-input" type="radio" name="close" id="close_yes" value="yes">
    </div>
<div class="form-check form-check-inline">
   <label class="form-check-label" for="close_no">No</label>
   <input class="form-check-input" type="radio" name="close" id="close_no" value="no">
 </div>
 <div class="form-floating">
        <input type="text" class="form-control" name="close_fre" value="{{ old('close_fre') }}" placeholder="Frequency"  autofocus>
        <label for="close_fre">Frequency</label>
    </div>
  </div>

 <label for="schedule"><b>Schedule Button Access</b></label>
 <div class="d-flex align-items-center userInput">
 <div class="form-check form-check-inline ">
      <label class="form-check-label" for="schedule_yes">Yes</label>
      <input class="form-check-input" type="radio" name="schedule" id="schedule_yes" value="yes">
    </div>
<div class="form-check form-check-inline">
   <label class="form-check-label" for="schedule_yes">No</label>
   <input class="form-check-input" type="radio" name="schedule" id="schedule_no" value="no">
 </div>
 <div class="form-floating">
        <input type="text" class="form-control" name="schedule_fre" value="{{ old('schedule_fre') }}" placeholder="Frequency"  autofocus>
        <label for="schedule_fre">Frequency</label>
  </div>
 </div>
  </div> 
 
      <label for="start_date"><b>Start Date</b></label>
    <input class="userInput" type="datetime-local" placeholder="Please Enter the check in time" name="start_date" id="start_date" required>

    <label for="end_date"><b>End Date</b></label>
    <input class="userInput" type="datetime-local" placeholder="Please Enter the check out time" name="end_date" id="end_date" required>
   

    <hr>

    <div class="text-center">
      <a href="{{ URL::previous() }}" class="btn btn-secondary">Back</a>
     <button type="submit" class="btn btn-success mx-3">Give Priviledges</button>
  
    </div>


    <!-- next elements -->
  </fieldset>
</div>
</form>  
<style>
    .use_existing, .create_new {
      display: none;
    }

    .visible {
      display: block;
    }
  </style>
    <script>
    $(document).ready(function () {
      $('input[type=radio][name=permission_group]').change(function() {
        var selectedClass = $(this).val();

        // Hide all classes
        $('.use_existing, .create_new').removeClass('visible');

        // Show the selected class
        $('.' + selectedClass).addClass('visible');
      });
    });
  </script> 

<script>
    $(document).ready(function () {
      $('input[type=radio][name=permission_group]').change(function() {
        var selectedClass = $(this).val();

        // Hide all classes
        $('.use_existing, .create_new').removeClass('visible');

        // Disable elements within the invisible class
        $('.use_existing *').prop('disabled', true);
        $('.create_new *').prop('disabled', true);

        // Show the selected class
        $('.' + selectedClass).addClass('visible');

        // Enable elements within the visible class
        $('.' + selectedClass + ' *').prop('disabled', false);
      });
    });
  </script>

@endsection
