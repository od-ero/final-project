@extends('layouts.app-master')
@section('subtitle')
   Edit Schedule Group
@endsection

@section('contentheader_title')
    Edit Schedule Group
@endsection

@section('content')
@csrf

<form name="register-form" id="register-form" method="post" action="{{ url('/update/groups/schedules/' . $encoded_permission_id.'/'.base64_encode($schedule_group['id'])) }}">
  
    <fieldset>
      <legend>Update Permission Group </legend>
      
      <hr>
      <input class="userInput" type="hidden" name="_token" value="{{ csrf_token() }}" />
     
     
      <label for="permission_group_name"><b>Permission Name</b></label>
      <input class="userInput" type="text" placeholder="Please Enter permission Name" name="permission_group_name" id="permission_group_name" value="{{$schedule_group['permission_name']}}" required>
    
   <label for="open_out"><b>Unlock from outside</b></label>
   <div class="d-flex align-items-center userInput">
   <div class="form-check form-check-inline">
       <label class="form-check-label" for="inlineRadio1">Yes</label>
       <input class="form-check-input" type="radio" name="open_out" id="open_out" value="yes" @if($schedule_group['open_out']=='yes') checked @endif>
   </div>

   <div class="form-check form-check-inline">
       <label class="form-check-label" for="inlineRadio2">No</label>
       <input class="form-check-input" type="radio" name="open_out" id="open_out" value="no" @if($schedule_group['open_out']=='no') checked @endif>
   </div>

   <div class="form-floating ">
       <input type="text" class="form-control" name="open_out_fre"  placeholder="Frequency" required="required" @if($schedule_group['open_out']=='yes'){ value='{{$schedule_group['open_out_fre']}}'
 } @else value='0' @endif autofocus>
       <label for="floatingName">Frequency</label>
   </div>
</div>

 <label for="close_out"><b>Lock from outside</b></label>
<div class="d-flex align-items-center userInput">
<div class="form-check form-check-inline" >
     <label class="form-check-label" for="inlineRadio1">Yes</label>
     <input class="form-check-input" type="radio" name="close_out" id="close_out" value="yes" @if($schedule_group['close_out']=='yes') checked @endif>
   </div>
<div class="form-check form-check-inline">
   <label class="form-check-label" for="inlineRadio2">No</label>
  <input class="form-check-input" type="radio" name="close_out" id="close_out" value="no" @if($schedule_group['close_out']=='no') checked @endif>
</div>
<div class="form-floating">
       <input type="text" class="form-control" name="close_out_fre"  placeholder="Frequency" required="required" @if($schedule_group['close_out']=='yes'){ value='{{$schedule_group['close_out_fre']}}'
 } @else value='0' @endif autofocus>
       <label for="floatingName">Frequency</label>
   </div>
</div>
 
<label for="open_in"><b>Unlock from Inside</b></label>
 <div class="d-flex align-items-center userInput">
 <div class="form-check form-check-inline ">
     <label class="form-check-label" for="inlineRadio1">Yes</label>
     <input class="form-check-input" type="radio" name="open_in" id="open_in" value="yes" @if($schedule_group['open_in']=='yes') checked @endif>
   </div>
<div class="form-check form-check-inline">
  <label class="form-check-label" for="inlineRadio2">No</label>
  <input class="form-check-input" type="radio" name="open_in" id="open_in" value="no" @if($schedule_group['open_in']=='no') checked @endif>
</div>
<div class="form-floating">
       <input type="text" class="form-control" name="open_in_fre"  placeholder="Frequency" required="required" @if($schedule_group['open_in']=='yes'){ value='{{$schedule_group['open_in_fre']}}'
 } @else value='0' @endif autofocus>
       <label for="floatingName">Frequency</label>
   </div>
 </div>

<label for="close_in"><b>Lock from Inside</b></label>
<div class="d-flex align-items-center userInput">
<div class="form-check form-check-inline ">
     <label class="form-check-label" for="inlineRadio1">Yes</label>
     <input class="form-check-input" type="radio" name="close_in" id="close_in" value="yes" @if($schedule_group['close_in']=='yes') checked @endif>
   </div>
<div class="form-check form-check-inline">
  <label class="form-check-label" for="inlineRadio2">No</label>
  <input class="form-check-input" type="radio" name="close_in" id="close_in" value="no" @if($schedule_group['close_in']=='no') checked @endif>
</div>
<div class="form-floating">
       <input type="text" class="form-control" name="close_in_fre"  placeholder="Frequency" required="required"  @if($schedule_group['close_in']=='yes'){ value='{{$schedule_group['close_in_fre']}}'
 } @else value='0' @endif autofocus>
       <label for="floatingName">Frequency</label>
   </div>
</div>

      <hr>
    <div class="text-center">
        <button type="submit" class="btn btn-success mb-3 mx-3">Update Schedule Group</button>
        <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
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
