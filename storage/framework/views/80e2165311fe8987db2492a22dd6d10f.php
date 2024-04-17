
<?php $__env->startSection('subtitle'); ?>
  View Schedule
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    View Schedule
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<legend>View Schedule Permission</legend>

<?php $__currentLoopData = $doorSchedulecounters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index =>$doorSchedulecounter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       
    <label for="permission_group_name_<?php echo e($index); ?>"><b>Door <?php echo e($index + 1); ?> Name</b></label>
      <input class="userInput" type="text" placeholder="Please Enter permission Name" name="permission_group_name" id="permission_group_name" value='<?php echo e($doorSchedulecounter['door_name']); ?>' required>
    
      <div class="row userxxInput">
        <div class="col-6">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="name" name="name" value="<?php echo e($doorSchedulecounter['open_out']. '/' .$schedule['open_out_fre']); ?>" placeholder=" " required="required" autofocus>
                <label for="name">Unlock from outside</label>
            </div>
        </div>

        <div class="col-6">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="phone" name="phone" value="<?php echo e($doorSchedulecounter['close_out']. '/' .$schedule['close_out_fre']); ?>" placeholder=" " required="required" autofocus>
                <label for="phone">Lock from outside</label>
            </div>
        </div>    
        </div>


        <div class="row userxxInput">
        <div class="col-6">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="name" name="name" value="<?php echo e($doorSchedulecounter['open_in']. '/' .$schedule['open_in_fre']); ?>" placeholder=" " required="required" autofocus>
                <label for="name">Unlock from inside</label>
            </div>
        </div>

        <div class="col-6">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="phone" name="phone" value="<?php echo e($doorSchedulecounter['close_in']. '/' .$schedule['close_in_fre']); ?>" placeholder=" " required="required" autofocus>
                <label for="phone">Lock from inside</label>
            </div>
        </div>
        
        </div> 
  
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            
<a href="<?php echo e(URL::previous()); ?>" class="btn btn-secondary">  Back</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/schedule/viewSchedule.blade.php ENDPATH**/ ?>