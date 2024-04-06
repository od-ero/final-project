
<?php $__env->startSection('subtitle'); ?>
 Devices
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Devices
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">

                    <div class="container-fluid px-4">
                        <h2 class="mt-4 text-white">Devices</h2>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/welcome">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                        <!-- <div class="card mb-4">
                             <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div> 
                        </div> -->
                        <div class="card mb-4">
                            <div class="card-header"><i class="fa-solid fa-door-open"></i>
                               
                                Doors
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Door</th>
                                            <th>Door Id</th>
                                            <th>Online State</th>
                                            <th>IP V4 Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Door</th>
                                            <th>Door Id</th>
                                            <th>Online State</th>
                                            <th>IP V4 Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <?php $__currentLoopData = $doors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $door): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($door['door_name']); ?></td>
                                            <td><?php echo e($door['door_id']); ?></td>
                                            <td><?php echo e($door['door_ip_status']); ?></td>
                                            <td><?php echo e($door['ip_address']); ?></td>
                                            <td>
                                            <a href="/rooms/doors/edit/blade/<?php echo e(base64_encode($door['door_id'])); ?>" class="btn btn-primary btn-lg" tabindex="-1" role="button">Edit</a>
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
            <?php $__env->stopSection(); ?>
<?php echo $__env->make('adminstration::layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/rooms/doors.blade.php ENDPATH**/ ?>