<?php $__env->startSection('content'); ?>
    <div class="bg-light p-5 rounded">
        <?php if(auth()->guard()->check()): ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <style>
#units {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#units td, #units th {
  border: 1px solid #ddd;
  padding: 8px;
}

#units tr:nth-child(even){background-color: #f2f2f2;}

#units tr:hover {background-color: #ddd;}

#units th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>

<body>
<h1>Dashboard</h1>
<p>My Units</p>
<table id="units">
    <tr>
        <th style="width:5%">ID</th>
        <th style="width:35%">Name</th>
        <th>Role</th>
        <th>Start Date</th>
        <th>End Date</th>
    </tr>

    <?php
    
    

    foreach ($myUnits as $key => $myUnit) {
      
        // Rest of your code for processing each $myUnit goes here
        // For example, you need to get $role_name, $start_date, and $end_date from $myUnit

        // Output the table row for each $myUnit
        ?>
       <tr>
    <td style="width:5%"><a href="/selected/unit/<?= base64_encode($myUnit['id']) ?>"><?= ++$key ?></a></td>
    <td style="width:35%"><a href="/selected/unit/<?=  base64_encode($myUnit['id']) ?>"><?= $myUnit['premises_name'] . ', ' . $myUnit['unit_name'] ?></a></td>
    <td><a href="/selected/unit/<?= base64_encode($myUnit['id']) ?>"><?= $myUnit['role_name'] ?></a></td>
    <td><a href="/selected/unit/<?= base64_encode($myUnit['id']) ?>"><?= $myUnit['start_date'] ?></a></td>
    <td><a href="/selected/unit/<?= base64_encode($myUnit['id']) ?>"><?= $myUnit['end_date'] ?></a></td>
</tr>

        <?php
    }
    ?>
</table>


 
</body>
</html>
        <?php endif; ?>

        <?php if(auth()->guard()->guest()): ?>
        <h1>Unikey</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/home/index.blade.php ENDPATH**/ ?>