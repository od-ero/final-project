
<?php $__env->startSection('subtitle'); ?>
   My Units
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
  My Units
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
<?php if(auth()->guard()->check()): ?>      



<p>Welcome to <?php echo e($unit['premises_name'] . ', ' . $unit['unit_name']); ?> </p>
<?php $unit_id = base64_encode($unit['id']); ?>
<!-- <div><button class="button button1">
    <a href="/units/create" style="text-decoration: none; color: inherit;">
       Add Unit
    </a>
</button>
<button class="button button1">
    <a href="/add/permissions/<?php echo $unit_id; ?>" style="text-decoration: none; color: inherit;">
       give permission
    </a>
</button>
<button class="button button1">
    <a href="/make/schedule/<?php echo $unit_id; ?>" style="text-decoration: none; color: inherit;">
      Activate button access
    </a>
</button>
</div> -->
<table id="units">
    <tr>
        <th style="width:5%">ID</th>
        
        <th>Door</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php
    
    

    foreach ($myUnits as $key => $myUnit) {
      
        // Rest of your code for processing each $myUnit goes here
        // For example, you need to get $role_name, $start_date, and $end_date from $myUnit

        // Output the table row for each $myUnit
        ?>
       <tr>
    <td style="width:5%"><?= ++$key ?></td>
    <td><?= $myUnit['door_name'] ?></td>
    <td><?= $myUnit['status']  ?></td>
    <td>
    <?php
    // Assuming $myUnit['status'] contains the initial status from the database
    $initialStatus = $myUnit['status'];
    ?>

<button class="button button1" style="background-color: <?php echo ($initialStatus === 'close') ? '#04AA6D' : 'red'; ?>; color: white;">
    <a href="/home/myunits/action/<?php echo base64_encode($myUnit['id']); ?>/<?php echo base64_encode($myUnit['status']); ?>" style="text-decoration: none; color: inherit;">
        <?php echo ($initialStatus === 'close') ? 'Open' : 'Close'; ?>
    </a>
</button>

  
</td>
   
</tr>

        <?php
    }
    ?>
</table>
<script>
     function populateOptions() {
        var dropdown = document.getElementById('statusDropdown');
        var initialStatus = '<?php echo $initialStatus; ?>';

        // Remove existing options
        while (dropdown.options.length > 0) {
            dropdown.remove(0);
        }

        // Add new options
        var openOption = document.createElement('option');
        openOption.value = 'open';
        openOption.text = 'Open';
        openOption.selected = (initialStatus === 'open');
        dropdown.add(openOption);

        var closeOption = document.createElement('option');
        closeOption.value = 'close';
        closeOption.text = 'Close';
        closeOption.selected = (initialStatus === 'close');
        dropdown.add(closeOption);
    }

    function redirectToView(id) {
    // Add logic to construct the URL based on the provided id
    var url = '/home/myunits/action/' + id;

    // Redirect to the constructed URL
    window.location.href = url;
}
</script>

<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/myUnit.blade.php ENDPATH**/ ?>