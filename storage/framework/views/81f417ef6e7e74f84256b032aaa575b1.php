


<?php $__env->startSection('subtitle'); ?>
    Update Permissions Group
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    Update Permissions Group
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>  
<form name="add_permission" id="add_permission" method="post" action="<?php echo e(url('/groups/me/permissions/update/' .$encoded_permission_id). '/' .$encoded_permission_group_id); ?>">


  
    <fieldset>
  
   <legend>Update the permission Group</legend>
    <p>Please Fill In This Form To Update the permission Group.</p>

   
    <hr>
    
    <input class="userInput" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
    <input  class="userInput" id="encoded_permission_id" type="hidden"  name="encoded_permission_id">
       
            <label for="permission_group_name"><b>Permission Name</b></label>
         <input class="userInput"type="text" placeholder="Please Enter permission Name" name="permission_group_name" id="permission_group_name" value="<?php echo e($permissionGroup['name']); ?>" required>
        
         <label for="give_permission"><b>Give Access Permission</b></label>
         <div class="d-flex align-items-center userInput">
         <div class="form-check form-check-inline">
             <label class="form-check-label" for="give_permission_yes">Yes</label>
             <input class="form-check-input" type="radio" name="give_permission" id="give_permission_yes" value="yes" <?php if($permissionGroup['give_permission']=='yes'): ?> checked <?php endif; ?>>
         </div>
     
         <div class="form-check form-check-inline">
             <label class="form-check-label" for="give_permission_no">No</label>
             <input class="form-check-input" type="radio" name="give_permission" id="give_permission_no" value="no" <?php if($permissionGroup['give_permission']=='no'): ?> checked <?php endif; ?>>
         </div>
     
         <div class="form-floating ">
             <input type="text" class="form-control" name="give_permission_fre" <?php if($permissionGroup['give_permission']=='yes'): ?>{ value='<?php echo e($permissionGroup['give_permission_fre']); ?>'
 } <?php else: ?> value='0' <?php endif; ?>  placeholder="Frequency" required="required" autofocus>
             <label for="give_permission_fre">Frequency</label>
         </div>
     </div>
     
       <label for="open"><b>Unlock</b></label>
      <div class="d-flex align-items-center userInput">
      <div class="form-check form-check-inline" >
           <label class="form-check-label" for="open_yes">Yes</label>
           <input class="form-check-input" type="radio" name="open" id="open_yes" value="yes"  <?php if($permissionGroup['open']=='yes'): ?> checked <?php endif; ?>>
         </div>
     <div class="form-check form-check-inline">
         <label class="form-check-label" for="open_no">No</label>
        <input class="form-check-input" type="radio" name="open" id="open_no" value="no"  <?php if($permissionGroup['open']=='no'): ?> checked <?php endif; ?>>
      </div>
      <div class="form-floating">
             <input type="text" class="form-control" name="open_fre" <?php if($permissionGroup['open']=='yes'): ?>{ value='<?php echo e($permissionGroup['open_fre']); ?>'
 } <?php else: ?> value='0' <?php endif; ?> placeholder="Frequency" required="required" autofocus>
             <label for="open_fre">Frequency</label>
         </div>
      </div>
       
      <label for="open"><b>Lock</b></label>
       <div class="d-flex align-items-center userInput">
       <div class="form-check form-check-inline ">
           <label class="form-check-label" for="close_yes">Yes</label>
           <input class="form-check-input" type="radio" name="close" id="close_yes" value="yes"  <?php if($permissionGroup['close']=='yes'): ?> checked <?php endif; ?>>
         </div>
     <div class="form-check form-check-inline">
        <label class="form-check-label" for="close_no">No</label>
        <input class="form-check-input" type="radio" name="close" id="close_no" value="no"  <?php if($permissionGroup['close']=='no'): ?> checked <?php endif; ?>>
      </div>
      <div class="form-floating">
             <input type="text" class="form-control" name="close_fre" <?php if($permissionGroup['close']=='yes'): ?>{ value='<?php echo e($permissionGroup['close_fre']); ?>'
 } <?php else: ?> value='0' <?php endif; ?> placeholder="Frequency" required="required" autofocus>
             <label for="close_fre">Frequency</label>
         </div>
       </div>
     
      <label for="schedule"><b>Schedule Button Access</b></label>
      <div class="d-flex align-items-center userInput">
      <div class="form-check form-check-inline ">
           <label class="form-check-label" for="schedule_yes">Yes</label>
           <input class="form-check-input" type="radio" name="schedule" id="schedule_yes" value="yes"  <?php if($permissionGroup['schedule']=='yes'): ?> checked <?php endif; ?>>
         </div>
     <div class="form-check form-check-inline">
        <label class="form-check-label" for="schedule_yes">No</label>
        <input class="form-check-input" type="radio" name="schedule" id="schedule_no" value="no"  <?php if($permissionGroup['schedule']=='no'): ?> checked <?php endif; ?>>
      </div>
      <div class="form-floating">
             <input type="text" class="form-control" name="schedule_fre"<?php if($permissionGroup['schedule']=='yes'): ?>{ value='<?php echo e($permissionGroup['schedule_fre']); ?>'
 } <?php else: ?> value='0' <?php endif; ?> placeholder="Frequency" required="required" autofocus>
             <label for="schedule_fre">Frequency</label>
       </div>
      </div>
      <hr>

<div class="text-center">
<button type="submit" class="btn btn-success mx-3">Update Permission Group</button>
<a href="<?php echo e(URL::previous()); ?>" class="btn btn-secondary">Cancel</a>
</div>


<!-- next elements -->
</fieldset>
</div>
</form>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/permissions/editPermissionGroup.blade.php ENDPATH**/ ?>