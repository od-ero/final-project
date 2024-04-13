
<?php $__env->startSection('subtitle'); ?>
   Edit Schedule Group
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    Edit Schedule Group
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo csrf_field(); ?>

<form name="register-form" id="register-form" method="post" action="<?php echo e(url('/update/groups/schedules/' . $encoded_permission_id.'/'.base64_encode($schedule_group['id']))); ?>">
  
    <fieldset>
      <legend>Update Permission Group </legend>
      
      <hr>
      <input class="userInput" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
     
     
      <label for="permission_group_name"><b>Permission Name</b></label>
      <input class="userInput" type="text" placeholder="Please Enter permission Name" name="permission_group_name" id="permission_group_name" value="<?php echo e($schedule_group['permission_name']); ?>" required>
    
   <label for="open_out"><b>Unlock from outside</b></label>
   <div class="d-flex align-items-center userInput">
   <div class="form-check form-check-inline">
       <label class="form-check-label" for="inlineRadio1">Yes</label>
       <input class="form-check-input" type="radio" name="open_out" id="open_out" value="yes" <?php if($schedule_group['open_out']=='yes'): ?> checked <?php endif; ?>>
   </div>

   <div class="form-check form-check-inline">
       <label class="form-check-label" for="inlineRadio2">No</label>
       <input class="form-check-input" type="radio" name="open_out" id="open_out" value="no" <?php if($schedule_group['open_out']=='no'): ?> checked <?php endif; ?>>
   </div>

   <div class="form-floating ">
       <input type="text" class="form-control" name="open_out_fre"  placeholder="Frequency" required="required" <?php if($schedule_group['open_out']=='yes'): ?>{ value='<?php echo e($schedule_group['open_out_fre']); ?>'
 } <?php else: ?> value='0' <?php endif; ?> autofocus>
       <label for="floatingName">Frequency</label>
   </div>
</div>

 <label for="close_out"><b>Lock from outside</b></label>
<div class="d-flex align-items-center userInput">
<div class="form-check form-check-inline" >
     <label class="form-check-label" for="inlineRadio1">Yes</label>
     <input class="form-check-input" type="radio" name="close_out" id="close_out" value="yes" <?php if($schedule_group['close_out']=='yes'): ?> checked <?php endif; ?>>
   </div>
<div class="form-check form-check-inline">
   <label class="form-check-label" for="inlineRadio2">No</label>
  <input class="form-check-input" type="radio" name="close_out" id="close_out" value="no" <?php if($schedule_group['close_out']=='no'): ?> checked <?php endif; ?>>
</div>
<div class="form-floating">
       <input type="text" class="form-control" name="close_out_fre"  placeholder="Frequency" required="required" <?php if($schedule_group['close_out']=='yes'): ?>{ value='<?php echo e($schedule_group['close_out_fre']); ?>'
 } <?php else: ?> value='0' <?php endif; ?> autofocus>
       <label for="floatingName">Frequency</label>
   </div>
</div>
 
<label for="open_in"><b>Unlock from Inside</b></label>
 <div class="d-flex align-items-center userInput">
 <div class="form-check form-check-inline ">
     <label class="form-check-label" for="inlineRadio1">Yes</label>
     <input class="form-check-input" type="radio" name="open_in" id="open_in" value="yes" <?php if($schedule_group['open_in']=='yes'): ?> checked <?php endif; ?>>
   </div>
<div class="form-check form-check-inline">
  <label class="form-check-label" for="inlineRadio2">No</label>
  <input class="form-check-input" type="radio" name="open_in" id="open_in" value="no" <?php if($schedule_group['open_in']=='no'): ?> checked <?php endif; ?>>
</div>
<div class="form-floating">
       <input type="text" class="form-control" name="open_in_fre"  placeholder="Frequency" required="required" <?php if($schedule_group['open_in']=='yes'): ?>{ value='<?php echo e($schedule_group['open_in_fre']); ?>'
 } <?php else: ?> value='0' <?php endif; ?> autofocus>
       <label for="floatingName">Frequency</label>
   </div>
 </div>

<label for="close_in"><b>Lock from Inside</b></label>
<div class="d-flex align-items-center userInput">
<div class="form-check form-check-inline ">
     <label class="form-check-label" for="inlineRadio1">Yes</label>
     <input class="form-check-input" type="radio" name="close_in" id="close_in" value="yes" <?php if($schedule_group['close_in']=='yes'): ?> checked <?php endif; ?>>
   </div>
<div class="form-check form-check-inline">
  <label class="form-check-label" for="inlineRadio2">No</label>
  <input class="form-check-input" type="radio" name="close_in" id="close_in" value="no" <?php if($schedule_group['close_in']=='no'): ?> checked <?php endif; ?>>
</div>
<div class="form-floating">
       <input type="text" class="form-control" name="close_in_fre"  placeholder="Frequency" required="required"  <?php if($schedule_group['close_in']=='yes'): ?>{ value='<?php echo e($schedule_group['close_in_fre']); ?>'
 } <?php else: ?> value='0' <?php endif; ?> autofocus>
       <label for="floatingName">Frequency</label>
   </div>
</div>

      <hr>
    <div class="text-center">
        <button type="submit" class="btn btn-success mb-3 mx-3">Update Schedule Group</button>
        <a href="<?php echo e(URL::previous()); ?>" class="btn btn-secondary">Cancel</a>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/schedule/editScheduleGroup.blade.php ENDPATH**/ ?>