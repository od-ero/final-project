
@extends('layouts.app-master')

@section('subtitle')
    Add Permissions Group
@endsection

@section('contentheader_title')
    Add Permissions Group
@endsection
@section('content')  
<form name="add_permission" id="add_permission" method="post" action="{{ url('/groups/me/create/permissions/' .$encoded_permission_id) }}">


  
    <fieldset>
  
   <legend>Add A Permission Group</legend>
    <p>Please Fill In This Form To Assign Access Priviledges.</p>

   
    <hr>
    
    <input class="userInput" type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input  class="userInput" id="encoded_permission_id" type="hidden"  name="encoded_permission_id">
       
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
             <input type="text" class="form-control" name="give_permission_fre" value="{{ old('give_permission_fre') }}" placeholder="Frequency" autofocus>
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
     
      <label for="schedule"><b>Schedule</b></label>
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
      <hr>

<div class="text-center">
    <a href="{{ URL::previous() }}" class="btn btn-secondary">Back</a>
    <button type="submit" class="btn btn-success mx-3">Create Permission Group</button>

</div>


<!-- next elements -->
</fieldset>
</div>
</form>  
@endsection