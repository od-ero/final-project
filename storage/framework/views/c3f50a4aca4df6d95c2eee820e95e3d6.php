
<?php $__env->startSection('subtitle'); ?>
   Ip Addresses
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
 Ip Addresses
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
<?php if(auth()->guard()->check()): ?>     
<div class="d-flex justify-content-between align-items-center">
    <p>Welcome to <?php echo e($unit['premises_name'] . ', ' . $unit['unit_name']); ?> Ip addresses </p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Add IP Address
    </button>
</div>
<?php $unit_id = base64_encode($unit['id']); ?>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <form method="post" action="<?php echo e(route('global.create')); ?>">
      <div class="modal-header bg-success">
        <h5 class="modal-title bg-success" id="exampleModalLongTitle">Add An Ip Address</Address></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
    
        <label for="door_id"><i>Door Name</i></label>
            <select  name="door_id" id="door_id" required class="form-control userxxInput">
              <option value="">Select</option>
              <?php $__currentLoopData = $doors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $door): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($door->id); ?>"> <?php echo e($door->door_name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        
            <label for="ip_address"><i>IP V4 Address</i></label>
    <input class="userxxInput"type="text" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$" placeholder="eg. 127.168.1.1" name="ip_address" id="ip_address" required>
   
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <!-- onclick="redirectToAction(row_id, encoded_permission_id, status)" -->
        <button type="submit" class="btn btn-success" onclick="">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>
<table class="table table-striped" id="units">
   <thead>
   
   <tr>
        <th style="width:5%">ID</th>
        
        <th>Door</th>
        <th>Ip Addres</th>
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
            emptyTable: "We are Sorry, No Ip Adress allocated for the doors in this room"
        },
        ajax: {
            url: '/get/unit/ipAddresses/data/<?php echo e($unit_id); ?>',  // Check if row is available in this context
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
                data: 'ip_address',
                name: 'ip_address',
            },
            {
                data: 'id',
                name: 'id',
                render:function(data,type,row,meta){
               
               var review=JSON.stringify(row);
                return `<div class='btn-group'>
                
                        <a href='#' class='btn btn-success'>
                            
                            <span>edit</span>
                        </a>
                    </div>`;
                }
               
}      
        ]
    });
});
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/ip_address.blade.php ENDPATH**/ ?>