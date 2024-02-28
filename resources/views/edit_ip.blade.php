@extends('layouts.app-master')
@section('subtitle')
Add Unit
@endsection

@section('contentheader_title')
  Add Unit
@endsection

@section('content')
   
        
@csrf
<form name="edit_ip" id="edit_ip"  method="post" action="{{url('units/doors/ip/update')}}">
  
  <fieldset>
    
    <legend >Edit Door Ip Address:</legend>
    <p>Please Edit the Ip of the selected door.</p>
    
    <hr>
   
    <input class="userInput" type="hidden" name="_token" value="{{ csrf_token() }}" />
    
    <input class="userInput" type="hidden" name="id" value="{{$ip_details['id']}}" />
    <input class="userInput" type="hidden" name="encoded_permission_id" value="{{$encoded_permission_id}}" />
    <label class="inputLabel" class="inputLabel" for="door_name"><b>Door Name</b></label>
    <input  class="userInput" type="text"  name="door_name" id="door_name" value='{{$ip_details['door_name']}}'required readonly>

    <label class="inputLabel"  for="unit_name"><b>IP V4 Address</b></label>
    <input  class="userInput" type="text"  name="ip_address" id="ip_address" value='{{$ip_details['ip_address']}}'>

  <div class="text-center">
   <hr> 
    <button type="submit" class="btn btn-success mx-3"> Edit</button>  <button type="reset" class="btn btn-default pull-right">Cancel reset</button> <button id="cancel" name="cancel" class="btn btn-default" onclick="history.back()">Cancel onclick</button>
  </div>
  </div>
  <fieldset>
  
</form>  
@endsection