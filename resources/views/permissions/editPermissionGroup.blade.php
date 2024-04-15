
@extends('layouts.app-master')

@section('subtitle')
    Update Permissions Group
@endsection

@section('contentheader_title')
    Update Permissions Group
@endsection
@section('content')  
<form name="add_permission" id="add_permission" method="post" action="{{ url('/groups/me/permissions/update/' .$encoded_permission_id). '/' .$encoded_permission_group_id }}">


  
    <fieldset>
  
   <legend>Update the permission Group</legend>
    <p>Please Fill In This Form To Update the permission Group.</p>

   
    <hr>
    
    <input class="userInput" type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input  class="userInput" id="encoded_permission_id" type="hidden"  name="encoded_permission_id">
       
            <label for="permission_group_name"><b>Permission Name</b></label>
         <input class="userInput"type="text" placeholder="Please Enter permission Name" name="permission_group_name" id="permission_group_name" value="{{$permissionGroup['name']}}" required>
        
         <label for="give_permission"><b>Give Access Permission</b></label>
         <div class="d-flex align-items-center userInput">
         <div class="form-check form-check-inline">
             <label class="form-check-label" for="give_permission_yes">Yes</label>
             <input class="form-check-input" type="radio" name="give_permission" id="give_permission_yes" value="yes" @if($permissionGroup['give_permission']=='yes') checked @endif>
         </div>
     
         <div class="form-check form-check-inline">
             <label class="form-check-label" for="give_permission_no">No</label>
             <input class="form-check-input" type="radio" name="give_permission" id="give_permission_no" value="no" @if($permissionGroup['give_permission']=='no') checked @endif>
         </div>
     
         <div class="form-floating ">
             <input type="text" class="form-control" name="give_permission_fre" @if($permissionGroup['give_permission']=='yes'){ value='{{$permissionGroup['give_permission_fre']}}'
 } @else value='0' @endif  placeholder="Frequency" required="required" autofocus>
             <label for="give_permission_fre">Frequency</label>
         </div>
     </div>
     
       <label for="open"><b>Unlock</b></label>
      <div class="d-flex align-items-center userInput">
      <div class="form-check form-check-inline" >
           <label class="form-check-label" for="open_yes">Yes</label>
           <input class="form-check-input" type="radio" name="open" id="open_yes" value="yes"  @if($permissionGroup['open']=='yes') checked @endif>
         </div>
     <div class="form-check form-check-inline">
         <label class="form-check-label" for="open_no">No</label>
        <input class="form-check-input" type="radio" name="open" id="open_no" value="no"  @if($permissionGroup['open']=='no') checked @endif>
      </div>
      <div class="form-floating">
             <input type="text" class="form-control" name="open_fre" @if($permissionGroup['open']=='yes'){ value='{{$permissionGroup['open_fre']}}'
 } @else value='0' @endif placeholder="Frequency" required="required" autofocus>
             <label for="open_fre">Frequency</label>
         </div>
      </div>
       
      <label for="open"><b>Lock</b></label>
       <div class="d-flex align-items-center userInput">
       <div class="form-check form-check-inline ">
           <label class="form-check-label" for="close_yes">Yes</label>
           <input class="form-check-input" type="radio" name="close" id="close_yes" value="yes"  @if($permissionGroup['close']=='yes') checked @endif>
         </div>
     <div class="form-check form-check-inline">
        <label class="form-check-label" for="close_no">No</label>
        <input class="form-check-input" type="radio" name="close" id="close_no" value="no"  @if($permissionGroup['close']=='no') checked @endif>
      </div>
      <div class="form-floating">
             <input type="text" class="form-control" name="close_fre" @if($permissionGroup['close']=='yes'){ value='{{$permissionGroup['close_fre']}}'
 } @else value='0' @endif placeholder="Frequency" required="required" autofocus>
             <label for="close_fre">Frequency</label>
         </div>
       </div>
     
      <label for="schedule"><b>Schedule Button Access</b></label>
      <div class="d-flex align-items-center userInput">
      <div class="form-check form-check-inline ">
           <label class="form-check-label" for="schedule_yes">Yes</label>
           <input class="form-check-input" type="radio" name="schedule" id="schedule_yes" value="yes"  @if($permissionGroup['schedule']=='yes') checked @endif>
         </div>
     <div class="form-check form-check-inline">
        <label class="form-check-label" for="schedule_yes">No</label>
        <input class="form-check-input" type="radio" name="schedule" id="schedule_no" value="no"  @if($permissionGroup['schedule']=='no') checked @endif>
      </div>
      <div class="form-floating">
             <input type="text" class="form-control" name="schedule_fre" @if($permissionGroup['schedule']=='yes'){ value='{{$permissionGroup['schedule_fre']}}'
 } @else value='0' @endif placeholder="Frequency" required="required" autofocus>
             <label for="schedule_fre">Frequency</label>
       </div>
      </div>
      <hr>

<div class="text-center">
<button type="submit" class="btn btn-success mx-3">Update Permission Group</button>
<a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
</div>


<!-- next elements -->
</fieldset>
</div>
</form>  
@endsection