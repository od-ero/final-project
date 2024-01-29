
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
<table class="table table-striped" id="units">
   <thead>
   <tr>
        <th style="width:5%">ID</th>
        
        <th>Door</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

   </thead>
</table>
<script type="text/javascript">
$(function () {
 
    $('#units').DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        ordering: true,
        searching: true,
        language: {
            emptyTable: "We are Sorry, No door has been assigned for you yet, kindly contact your host for assistance"
        },
        ajax: {
            url: '/selected/unit/data/<?php echo e($unit_id); ?>',  // Check if row is available in this context
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                render: function (data, type, row, meta) {
                    var incrementedValue = meta.row + 1;
                    return incrementedValue;
                }
            },
            {
                data: 'door_name',
                name: 'door_name',
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'status',
                name: 'status',
                render: function (data, type, row) {
                    var initialStatus = row.status;
                    var buttonColor = (initialStatus === 'closed') ? '#04AA6D' : 'red';
                    var buttonText = (initialStatus === 'closed') ? 'Open' : 'Close';

                    return '<button class="button" style="background-color: ' + buttonColor + '; color: white;">' +
                           '<a href="/home/myunits/action/' + btoa(row.id) + '/' + btoa(row.status) + '" style="text-decoration: none; color: inherit;">' +
                           buttonText +
                           '</a></button>';
                }
            }
        ]
    });
});
</script>


<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/myUnit.blade.php ENDPATH**/ ?>