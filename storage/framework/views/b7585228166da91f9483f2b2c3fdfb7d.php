
<?php $__env->startSection('subtitle'); ?>
   Button Activation
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Button Activation
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo csrf_field(); ?>
    
<form name="register-form" id="register-form" method="post" action="{{url('/make/schedule/<?php echo ($unit_id); ?>)}}">
  <div class="container">
   
   <legend>Active the door buttons access</legend> 
    <p>Welcome to my schedule, this will activate the respective door buttons at given times.</p>
    
  
  <hr>
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

<label for="email"><b>Start Date And  Time</b></label>
    <input class="userInput" type="datetime-local" placeholder="Please Enter the check in time" name="start_date" id="start_date" required>

    <label for="phone"><b>End Date And Time</b></label>
    <input class="userInput" type="datetime-local" placeholder="Please Enter the check out time" name="end_date" id="end_date" required>
    
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
    
    <label for="permission_group"><b>Permission Name</b></label>
    <input class="userInput"type="text" placeholder="Please Enter permission Name" name="permission_group" id="permission_group" required>
   
    <label for="open"><b>Open from outside</b></label>
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
        <input type="text" class="form-control" name="give_permission_fre"  placeholder="Frequency" required="required" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
</div>

  <label for="open"><b>Close from outside</b></label>
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
        <input type="text" class="form-control" name="open_fre"  placeholder="Frequency" required="required" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
 </div>
  
 <label for="open"><b>Open from Inside</b></label>
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
        <input type="text" class="form-control" name="close_fre"  placeholder="Frequency" required="required" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
  </div>

 <label for="open"><b>Lock from Inside</b></label>
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
        <input type="text" class="form-control" name="schedule_fre"  placeholder="Frequency" required="required" autofocus>
        <label for="floatingName">Frequency</label>
    </div>
 </div>
    <hr>
  </div>
   
  <button type="submit" class="btn btn-primary">Give Priviledges</button>
  <fieldset>
</form>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/add_schedule.blade.php ENDPATH**/ ?>