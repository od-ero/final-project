
<?php $__env->startSection('subtitle'); ?>
Give access permission
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
Give access permission
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
      
<form name="register-form" id="register-form" method="post" action="<?php echo e(url('/register')); ?>">
<div class="container">

  
    <fieldset>
    <legend>Give Priviledges</legend>
    <p>Please Fill In This Form To Assign Access Priviledges.</p>

    <hr>
    
    <input class="userInput" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
    <label for="fname"><b>User</b></label>
    <input  class="userInput" type="text" placeholder="Enter Your First Name" name="fname" id="fname" required>
    <label for="open"><i>Select either to use existing permissions or to create a new one</i></label>
 <div class="d-flex align-items-center userInput">
 <div class="form-check form-check-inline" >
      <label class="form-check-label" for="inlineRadio1">Use existing</label>
      <input class="form-check-input" type="radio" name="permission_group" id="use_existing" value="use_existing">
    </div>
<div class="form-check form-check-inline ">
    <label class="form-check-label" for="inlineRadio2">Create A new one</label>
   <input class="form-check-input" type="radio" name="permission_group" id="create_new" value="create_new" checked>
 </div>

 </div>
<label for="role_id"><b>Role</b></label>

  <select  name="role_id" id="role_id" required class="form-control userInput">
    <option value="">Select</option>
    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($role->id); ?>"><?php echo e($role->role_name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
  <label for="unit_id"><b>Unit</b></label>
<select name="unit_id" id="unit_id" required class="form-control userInput">
    <option value="">select</option>
    <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($unit->id); ?>"><?php echo e($unit->unit_name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

    <label for="email"><b>Start Date</b></label>
    <input class="userInput" type="datetime-local" placeholder="Please Enter the check in time" name="start_date" id="start_date" required>

    <label for="phone"><b>End Date</b></label>
    <input class="userInput" type="datetime-local" placeholder="Please Enter the check out time" name="end_date" id="end_date" required>
    
    
    <label for="open"><i>Select the the doors to be affected by the permissions</i></label>
    
   
<div class="userCheck  userInput" >
<?php $__currentLoopData = $doors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $door): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="form-check" >
<label class="form-check-label" for="flexCheckDefault">
  <?php echo e($door->door_name); ?>

  </label>
  <input class="form-check-input" type="checkbox" name="door_id_" value="<?php echo e($door->id); ?>" id="flexCheckDefault">
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
    <label for="permission_group"><b>Permission Name</b></label>
    <input class="userInput"type="text" placeholder="Please Enter permission Name" name="permission_group" id="permission_group" required>
   
    <label for="open"><b>Give Access Permission</b></label>
    <div class="d-flex align-items-center userInput">
    <div class="form-check form-check-inline">
        <label class="form-check-label" for="inlineRadio1">Yes</label>
        <input class="form-check-input" type="radio" name="give_permission" id="give_permission_yes" value="yes">
    </div>

    <div class="form-check form-check-inline">
        <label class="form-check-label" for="inlineRadio2">No</label>
        <input class="form-check-input" type="radio" name="give_permission" id="give_permission_no" value="no">
    </div>

    <div class="form-floating ">
        <input type="text" class="form-control" name="give_permission_fre" value="<?php echo e(old('give_permission_fre')); ?>" placeholder="Frequency" required="required" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
</div>

  <label for="open"><b>Open</b></label>
 <div class="d-flex align-items-center userInput">
 <div class="form-check form-check-inline" >
      <label class="form-check-label" for="inlineRadio1">Yes</label>
      <input class="form-check-input" type="radio" name="open" id="open_yes" value="yes">
    </div>
<div class="form-check form-check-inline">
    <label class="form-check-label" for="inlineRadio2">No</label>
   <input class="form-check-input" type="radio" name="open" id="open_no" value="no">
 </div>
 <div class="form-floating">
        <input type="text" class="form-control" name="open_fre" value="<?php echo e(old('open_fre')); ?>" placeholder="Frequency" required="required" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
 </div>
  
 <label for="open"><b>Close</b></label>
  <div class="d-flex align-items-center userInput">
  <div class="form-check form-check-inline ">
      <label class="form-check-label" for="inlineRadio1">Yes</label>
      <input class="form-check-input" type="radio" name="close" id="close_yes" value="yes">
    </div>
<div class="form-check form-check-inline">
   <label class="form-check-label" for="inlineRadio2">No</label>
   <input class="form-check-input" type="radio" name="close" id="close_no" value="no">
 </div>
 <div class="form-floating">
        <input type="text" class="form-control" name="close_fre" value="<?php echo e(old('close_fre')); ?>" placeholder="Frequency" required="required" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
  </div>

 <label for="open"><b>Schedule Button Access</b></label>
 <div class="d-flex align-items-center userInput">
 <div class="form-check form-check-inline ">
      <label class="form-check-label" for="inlineRadio1">Yes</label>
      <input class="form-check-input" type="radio" name="schedule" id="schedule_yes" value="yes">
    </div>
<div class="form-check form-check-inline">
   <label class="form-check-label" for="inlineRadio2">No</label>
   <input class="form-check-input" type="radio" name="schedule" id="schedule_no" value="no">
 </div>
 <div class="form-floating">
        <input type="text" class="form-control" name="schedule_fre" value="<?php echo e(old('schedule_fre')); ?>" placeholder="Frequency" required="required" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
 </div>
    <hr>
 
  <button type="submit" class="btn btn-primary">Give Priviledges</button>
  </fieldset>
</div>
</form>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/add_permission.blade.php ENDPATH**/ ?>