
<?php $__env->startSection('subtitle'); ?>
   Edit Schedule
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Edit Schedule
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo csrf_field(); ?>
<form name="register-form" id="register-form" method="post" action="<?php echo e(url('/update/schedule/user/' . $encoded_permission_id. '/'.base64_encode($schedule['id']))); ?>">

    <fieldset>
      <legend>Update Schedule <b class="text-uppercase"><?php echo e($unit['premises_name'] . ', ' . $unit['unit_name']); ?> </b></legend>
      <p>Welcome to my schedule, this will activate the respective door buttons at given times.</p>

      <hr>
      <input class="userInput" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
      <!-- <input class="userInput" type="hidden" name="unit_id" value="<?php echo e($unit['id']); ?>" /> -->
      <label for="permission_group_id"><b>Schedule Group Name</b></label>
          <select  name="permission_group_id" id="permission_group_id" required class="form-control userInput">
                <option value="<?php echo e($schedule['door_schedule_permission_id']); ?>" > <?php echo e($schedule['permission_name']); ?></option>
                <?php $__currentLoopData = $permission_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($permission_group->id); ?>"> <?php echo e($permission_group->permission_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
      <label for="door"><i>Select the doors to be affected by the permissions</i></label>

      <div class="userCheck userInput">
        <?php $__currentLoopData = $doors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $door): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-check">
                    <label class="form-check-label" for="door_id_<?php echo e($index + 1); ?>">
                        <?php echo e($door->door_name); ?>

                    </label>
                    <input class="form-check-input" type="checkbox" name="door_id_<?php echo e($index + 1); ?>" value="<?php echo e($door->id); ?>" id="door_id_<?php echo e($index + 1); ?>"
                        <?php if(in_array($door->id, $selectedDoors)): ?> checked <?php endif; ?>>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    
      <label for="email"><b>Start Date And Time</b></label>
      <input class="userInput" type="datetime-local" placeholder="Please Enter the check-in time" name="start_date" id="start_date" value="<?php echo e($schedule['start_date']); ?>" required>

      <label for="phone"><b>End Date And Time</b></label>
      <input class="userInput" type="datetime-local" placeholder="Please Enter the check-out time" name="end_date" id="end_date" value="<?php echo e($schedule['end_date']); ?>" required>


      <hr>
    <div class="text-center">
        <button type="submit" class="btn btn-success mb-3 mx-3">Update Schedule</button>
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

<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/schedule/editSchedule.blade.php ENDPATH**/ ?>