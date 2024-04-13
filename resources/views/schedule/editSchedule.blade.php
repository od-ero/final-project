@extends('layouts.app-master')
@section('subtitle')
   Edit Schedule
@endsection

@section('contentheader_title')
   Edit Schedule
@endsection

@section('content')
@csrf
<form name="register-form" id="register-form" method="post" action="{{ url('/update/schedule/user/' . $encoded_permission_id. '/'.base64_encode($schedule['id']))}}">

    <fieldset>
      <legend>Update Schedule <b class="text-uppercase">{{$unit['premises_name'] . ', ' . $unit['unit_name']}} </b></legend>
      <p>Welcome to my schedule, this will activate the respective door buttons at given times.</p>

      <hr>
      <input class="userInput" type="hidden" name="_token" value="{{ csrf_token() }}" />
      <!-- <input class="userInput" type="hidden" name="unit_id" value="{{$unit['id']}}" /> -->
      <label for="permission_group_id"><b>Schedule Group Name</b></label>
          <select  name="permission_group_id" id="permission_group_id" required class="form-control userInput">
                <option value="{{$schedule['door_schedule_permission_id']}}" > {{$schedule['permission_name']}}</option>
                @foreach($permission_groups as $permission_group)
                <option value="{{ $permission_group->id }}"> {{ $permission_group->permission_name }}</option>
            @endforeach
          </select>
      <label for="door"><i>Select the doors to be affected by the permissions</i></label>

      <div class="userCheck userInput">
        @foreach($doors as $index => $door)
                <div class="form-check">
                    <label class="form-check-label" for="door_id_{{ $index + 1 }}">
                        {{ $door->door_name }}
                    </label>
                    <input class="form-check-input" type="checkbox" name="door_id_{{ $index + 1 }}" value="{{ $door->id }}" id="door_id_{{ $index + 1 }}"
                        @if(in_array($door->id, $selectedDoors)) checked @endif>
                </div>
            @endforeach
      </div>
    
      <label for="email"><b>Start Date And Time</b></label>
      <input class="userInput" type="datetime-local" placeholder="Please Enter the check-in time" name="start_date" id="start_date" value="{{$schedule['start_date']}}" required>

      <label for="phone"><b>End Date And Time</b></label>
      <input class="userInput" type="datetime-local" placeholder="Please Enter the check-out time" name="end_date" id="end_date" value="{{$schedule['end_date']}}" required>


      <hr>
    <div class="text-center">
        <button type="submit" class="btn btn-success mb-3 mx-3">Update Schedule</button>
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
