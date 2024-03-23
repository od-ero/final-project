@extends('layouts.app-master')
@section('subtitle')
   Button Activation
@endsection

@section('contentheader_title')
   Button Activation
@endsection

@section('content')
@csrf

<form name="register-form" id="register-form" method="post" action="{{ url('/make/schedule/' . $encoded_permission_id) }}">
  
    <fieldset>
      <legend>Active The Door Buttons Access To <b class="text-uppercase">{{$unit['premises_name'] . ', ' . $unit['unit_name']}} </b></legend>
      <p>Welcome to my schedule, this will activate the respective door buttons at given times.</p>

      <hr>
      <input class="userInput" type="hidden" name="_token" value="{{ csrf_token() }}" />
      <label for="door"><i>Select the doors to be affected by the permissions</i></label>

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
      <label for="open"><i>Select either to use existing permissions or to create a new one</i></label>
      <div class="d-flex align-items-center userInput">
        <div class="form-check form-check-inline">
          <label class="form-check-label" for="inlineRadio1">Use existing</label>
          <input class="form-check-input" type="radio" name="permission_group" id="use_existing" value="use_existing">
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label" for="inlineRadio2">Create A new one</label>
          <input class="form-check-input" type="radio" name="permission_group" id="create_new" value="create_new">
        </div>
      </div>
      <div class="use_existing">
          <label for="permission_group_id"><b>Permision Name</b></label>
          <select  name="permission_group_id" id="permission_group_id" required class="form-control userInput">
                <option value="">Select</option>
                @foreach($permission_groups as $permission_group)
                <option value="{{ $permission_group->id }}"> {{ $permission_group->permission_name }}</option>
            @endforeach
          </select>
      </div>

      <div class="create_new">
      <label for="permission_group_name"><b>Permission Name</b></label>
      <input class="userInput" type="text" placeholder="Please Enter permission Name" name="permission_group_name" id="permission_group_name" required>
    
   <label for="open_out"><b>Unlock from outside</b></label>
   <div class="d-flex align-items-center userInput">
   <div class="form-check form-check-inline">
       <label class="form-check-label" for="inlineRadio1">Yes</label>
       <input class="form-check-input" type="radio" name="open_out" id="open_out" value="yes">
   </div>

   <div class="form-check form-check-inline">
       <label class="form-check-label" for="inlineRadio2">No</label>
       <input class="form-check-input" type="radio" name="open_out" id="open_out" value="no">
   </div>

   <div class="form-floating ">
       <input type="text" class="form-control" name="open_out_fre"  placeholder="Frequency" required="required" autofocus>
       <label for="floatingName">Frequency</label>
   </div>
</div>

 <label for="close_out"><b>Lock from outside</b></label>
<div class="d-flex align-items-center userInput">
<div class="form-check form-check-inline" >
     <label class="form-check-label" for="inlineRadio1">Yes</label>
     <input class="form-check-input" type="radio" name="close_out" id="close_out" value="yes">
   </div>
<div class="form-check form-check-inline">
   <label class="form-check-label" for="inlineRadio2">No</label>
  <input class="form-check-input" type="radio" name="close_out" id="close_out" value="no">
</div>
<div class="form-floating">
       <input type="text" class="form-control" name="close_out_fre"  placeholder="Frequency" required="required" autofocus>
       <label for="floatingName">Frequency</label>
   </div>
</div>
 
<label for="open_in"><b>Unlock from Inside</b></label>
 <div class="d-flex align-items-center userInput">
 <div class="form-check form-check-inline ">
     <label class="form-check-label" for="inlineRadio1">Yes</label>
     <input class="form-check-input" type="radio" name="open_in" id="open_in" value="yes">
   </div>
<div class="form-check form-check-inline">
  <label class="form-check-label" for="inlineRadio2">No</label>
  <input class="form-check-input" type="radio" name="open_in" id="open_in" value="no">
</div>
<div class="form-floating">
       <input type="text" class="form-control" name="open_in_fre"  placeholder="Frequency" required="required" autofocus>
       <label for="floatingName">Frequency</label>
   </div>
 </div>

<label for="close_in"><b>Lock from Inside</b></label>
<div class="d-flex align-items-center userInput">
<div class="form-check form-check-inline ">
     <label class="form-check-label" for="inlineRadio1">Yes</label>
     <input class="form-check-input" type="radio" name="close_in" id="close_in" value="yes">
   </div>
<div class="form-check form-check-inline">
  <label class="form-check-label" for="inlineRadio2">No</label>
  <input class="form-check-input" type="radio" name="close_in" id="close_in" value="no">
</div>
<div class="form-floating">
       <input type="text" class="form-control" name="close_in_fre"  placeholder="Frequency" required="required" autofocus>
       <label for="floatingName">Frequency</label>
   </div>
</div>
</div>
      <label for="email"><b>Start Date And Time</b></label>
      <input class="userInput" type="datetime-local" placeholder="Please Enter the check-in time" name="start_date" id="start_date" required>

      <label for="phone"><b>End Date And Time</b></label>
      <input class="userInput" type="datetime-local" placeholder="Please Enter the check-out time" name="end_date" id="end_date" required>


      <hr>
    <div class="text-center">
        <button type="submit" class="btn btn-success mb-3 mx-3">Give Privileges</button><button type="#" class="btn btn-primary mx-3">cancel</button>
    </div>
    </fieldset>
  
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
