


<?php $__env->startSection('subtitle'); ?>
    Add Permissions Group
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    Add Permissions Group
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>  
<form name="add_permission" id="add_permission" method="post" action="<?php echo e(url('/groups/me/create/permissions/' .$encoded_permission_id)); ?>">


  
    <fieldset>
  
   <legend>Add A Permission Group</legend>
    <p>Please Fill In This Form To Assign Access Priviledges.</p>

   
    <hr>
    
    <input class="userInput" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
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
             <input type="text" class="form-control" name="give_permission_fre" value="<?php echo e(old('give_permission_fre')); ?>" placeholder="Frequency" required="required" autofocus>
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
             <input type="text" class="form-control" name="open_fre" value="<?php echo e(old('open_fre')); ?>" placeholder="Frequency" required="required" autofocus>
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
             <input type="text" class="form-control" name="close_fre" value="<?php echo e(old('close_fre')); ?>" placeholder="Frequency" required="required" autofocus>
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
             <input type="text" class="form-control" name="schedule_fre" value="<?php echo e(old('schedule_fre')); ?>" placeholder="Frequency" required="required" autofocus>
             <label for="schedule_fre">Frequency</label>
       </div>
      </div>
      <hr>

<div class="text-center">
<button type="submit" class="btn btn-success mx-3">Add Permission Group</button>
<a href="<?php echo e(URL::previous()); ?>" class="btn btn-secondary">Cancel</a>
</div>


<!-- next elements -->
</fieldset>
</div>
</form>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/permissions/addPermissionGroup.blade.php ENDPATH**/ ?>