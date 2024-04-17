@extends('layouts.app-master')
@section('subtitle')
  View Schedule
@endsection

@section('contentheader_title')
    View Schedule
@endsection

@section('content')
<legend>View Schedule Permission</legend>

@foreach($doorSchedulecounters as $index =>$doorSchedulecounter)
       
    <label for="permission_group_name_{{$index}}"><b>Door {{$index + 1}} Name</b></label>
      <input class="userInput" type="text" placeholder="Please Enter permission Name" name="permission_group_name" id="permission_group_name" value='{{$doorSchedulecounter['door_name']}}' required>
    
      <div class="row userxxInput">
        <div class="col-6">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="name" name="name" value="{{$doorSchedulecounter['open_out']. '/' .$schedule['open_out_fre']}}" placeholder=" " required="required" autofocus>
                <label for="name">Unlock from outside</label>
            </div>
        </div>

        <div class="col-6">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="phone" name="phone" value="{{$doorSchedulecounter['close_out']. '/' .$schedule['close_out_fre']}}" placeholder=" " required="required" autofocus>
                <label for="phone">Lock from outside</label>
            </div>
        </div>    
        </div>


        <div class="row userxxInput">
        <div class="col-6">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="name" name="name" value="{{$doorSchedulecounter['open_in']. '/' .$schedule['open_in_fre']}}" placeholder=" " required="required" autofocus>
                <label for="name">Unlock from inside</label>
            </div>
        </div>

        <div class="col-6">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="phone" name="phone" value="{{$doorSchedulecounter['close_in']. '/' .$schedule['close_in_fre']}}" placeholder=" " required="required" autofocus>
                <label for="phone">Lock from inside</label>
            </div>
        </div>
        
        </div> 
  
@endforeach            
<a href="{{ URL::previous() }}" class="btn btn-secondary">  Back</a>
@endsection