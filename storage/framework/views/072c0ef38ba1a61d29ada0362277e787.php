
<?php $__env->startSection('subtitle'); ?>
   Button Activation
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Button Activation
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo csrf_field(); ?>

<form name="register-form" id="register-form" method="post" action="<?php echo e(url('/add/group/schedule/user/' . $encoded_permission_id)); ?>">
  
    <fieldset>
      <legend>Create Schedule Group</legend>
      
      <hr>
      <input class="userInput" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
        <label for="permission_group_name"><b>Schedule Name</b></label>
        <input class="userInput" type="text" placeholder="Please Enter permission Name" name="permission_group_name" id="permission_group_name" required>
        
    <label for="open_out"><b>Unlock from outside</b></label>
    <div class="d-flex align-items-center userInput">
    <div class="form-check form-check-inline">
        <label class="form-check-label" for="inlineRadio1">Yes</label>
        <input class="form-check-input" type="radio" name="open_out" id="open_out" value="yes">
    </div>

    <div class="form-check form-check-inline">
        <label class="form-check-label" for="inlineRadio2">No</label>
        <input class="form-check-input" type="radio" name="open_out" id="open_out" value="no">
    </div>

    <div class="form-floating ">
        <input type="text" class="form-control" name="open_out_fre"  placeholder="Frequency" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
    </div>

    <label for="close_out"><b>Lock from outside</b></label>
    <div class="d-flex align-items-center userInput">
    <div class="form-check form-check-inline" >
        <label class="form-check-label" for="inlineRadio1">Yes</label>
        <input class="form-check-input" type="radio" name="close_out" id="close_out" value="yes">
    </div>
    <div class="form-check form-check-inline">
    <label class="form-check-label" for="inlineRadio2">No</label>
    <input class="form-check-input" type="radio" name="close_out" id="close_out" value="no">
    </div>
    <div class="form-floating">
        <input type="text" class="form-control" name="close_out_fre"  placeholder="Frequency" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
    </div>
    
    <label for="open_in"><b>Unlock from Inside</b></label>
    <div class="d-flex align-items-center userInput">
    <div class="form-check form-check-inline ">
        <label class="form-check-label" for="inlineRadio1">Yes</label>
        <input class="form-check-input" type="radio" name="open_in" id="open_in" value="yes">
    </div>
    <div class="form-check form-check-inline">
    <label class="form-check-label" for="inlineRadio2">No</label>
    <input class="form-check-input" type="radio" name="open_in" id="open_in" value="no">
    </div>
    <div class="form-floating">
        <input type="text" class="form-control" name="open_in_fre"  placeholder="Frequency"  autofocus>
        <label for="floatingName">Frequency</label>
    </div>
    </div>

    <label for="close_in"><b>Lock from Inside</b></label>
    <div class="d-flex align-items-center userInput">
    <div class="form-check form-check-inline ">
        <label class="form-check-label" for="inlineRadio1">Yes</label>
        <input class="form-check-input" type="radio" name="close_in" id="close_in" value="yes">
    </div>
    <div class="form-check form-check-inline">
    <label class="form-check-label" for="inlineRadio2">No</label>
    <input class="form-check-input" type="radio" name="close_in" id="close_in" value="no">
    </div>
    <div class="form-floating">
        <input type="text" class="form-control" name="close_in_fre"  placeholder="Frequency"  autofocus>
        <label for="floatingName">Frequency</label>
    </div>
    </div>
<hr>
    <div class="text-center">
        <button type="submit" class="btn btn-success mb-3 mx-3">Create Schedule Group</button>
        <a href="<?php echo e(URL::previous()); ?>" class="btn btn-secondary">Cancel</a>
    </div>
    </fieldset>
  
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/schedule/addScheduleGroup.blade.php ENDPATH**/ ?>