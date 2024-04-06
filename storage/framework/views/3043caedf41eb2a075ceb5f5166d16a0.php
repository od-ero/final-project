
<?php $__env->startSection('subtitle'); ?>
   Rooms
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Rooms
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
      Are You Sure you want to delete this Room? 
      <form id="deleteForm" action="/rooms/destroy" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="unit_id" id="unitIdInput">
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteForm').submit()">Delete</button>

      </div>
    </div>
  </div>
</div>
                    <div class="container-fluid px-4">
                        <h2 class="mt-4 text-white">Rooms</h2>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/welcome">Dashboard</a></li>
                            <li class="breadcrumb-item active">Rooms</li>
                        </ol>
                        <div class="card mb-4">
                            <!-- <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div> -->
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-house-medical me-1"></i>
                               Rooms
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Google Pin</th>
                                            <th>Premise Name</th>
                                            <th>Unit Name</th>
                                            <th>Owner</th>
                                            <th>Doors</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Google Pin</th>
                                            <th>Premise Name</th>
                                            <th>Unit Name</th>
                                            <th>Owner</th>
                                            <th>Doors</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($room['google_location']); ?></td>
                                            <td><?php echo e($room['premises_name']); ?></td>
                                            <td><?php echo e($room['unit_name']); ?></td>
                                            <td><?php echo e($room['fname'] . ' ' . $room['lname']); ?></td>
                                            <td><?php echo e($room['doors']); ?></td>
                                            <td><?php echo e($room['latitude']); ?></td>
                                            <td><?php echo e($room['longitude']); ?></td>
                                            <td class="float-end">  
                                                <div class="btn-group dropend">
                                                    <a href="/rooms/doors/<?php echo e(base64_encode($room['id'])); ?>" class="btn btn-primary btn-lg" tabindex="-1" role="button">View</a>
                                                    <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="visually-hidden">Toggle Dropright</span> More
                                                    </button>
                                                    <ul class="dropdown-menu"><div class="m-2 text-center">
                                            
                                                       <li class="mb-2"><a href="/rooms/details/update/<?php echo e(base64_encode($room['id'])); ?>" class="btn btn-primary" role="button">Update</a></li>
                                                       <li>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setUnitId('<?php echo e($room->id); ?>')">Delete</button>

                                                        </li>
                                               
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            <script>
                window.addEventListener('DOMContentLoaded', event => {
                // Simple-DataTables
                // https://github.com/fiduswriter/Simple-DataTables/wiki

                const datatablesSimple = document.getElementById('datatablesSimple');
                if (datatablesSimple) {
                    new simpleDatatables.DataTable(datatablesSimple);
                }
            });

            </script>
            <script>
                function setUnitId(unitId) {
                    document.getElementById('unitIdInput').value = unitId;
                }
            </script>
            <?php $__env->stopSection(); ?>
<?php echo $__env->make('adminstration::layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/rooms/index.blade.php ENDPATH**/ ?>