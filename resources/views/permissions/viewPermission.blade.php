@extends('layouts.app-master')
@section('subtitle')
  View Schedule
@endsection

@section('contentheader_title')
    View Schedule
@endsection

@section('content')
<legend>View Schedule Permission</legend>

@foreach($myPermissionCounters as $index =>$myPermissionCounter)
       
    <label for="permission_group_name_{{$index}}"><b>Door {{$index + 1}} Name</b></label>
      <input class="userInput" type="text" placeholder="Please Enter permission Name" name="permission_group_name" id="permission_group_name" value='{{$myPermissionCounter['door_name']}}' required>
    
      <div class="row userxxInput">
        <div class="col-6">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="name" name="name" value="{{$myPermissionCounter['give_permission']. '/' .$permission['give_permission_fre']}}" placeholder=" " required="required" autofocus>
                <label for="name">Give Permission</label>
            </div>
        </div>

        <div class="col-6">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="phone" name="phone" value="{{$myPermissionCounter['schedule']. '/' .$permission['schedule_fre']}}" placeholder=" " required="required" autofocus>
                <label for="phone">Schedule</label>
            </div>
        </div>    
        </div>


        <div class="row userxxInput">
        <div class="col-6">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="name" name="name" value="{{$myPermissionCounter['open']. '/' .$permission['open_fre']}}" placeholder=" " required="required" autofocus>
                <label for="name">Unlock</label>
            </div>
        </div>

        <div class="col-6">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="phone" name="phone" value="{{$myPermissionCounter['close']. '/' .$permission['close_fre']}}" placeholder=" " required="required" autofocus>
                <label for="phone">Lock </label>
            </div>
        </div>
        
        </div> 
  
@endforeach            
<a href="{{ URL::previous() }}" class="btn btn-secondary">  Back</a>
@endsection