
<?php $__env->startSection('subtitle'); ?>
   Add A Unit
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    Add A Unit
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">

                    <div class="container-fluid px-4">
                        <h2 class="mt-4">Roooms</h2>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/welcome">Dashboard</a></li>
                            <li class="breadcrumb-item active">Rooms</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Premise Name</th>
                                            <th>Unit Name</th>
                                            <th>Owner</th>
                                            <th>No Of Doors</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID</th>
                                            <th>Premise Name</th>
                                            <th>Unit Name</th>
                                            <th>Owner</th>
                                            <th>No Of Doors</th>
                                            <th>View</th>
                                        </tr>
                                    </tfoot>
                                    <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($room['premises_name']); ?></td>
                                            <td><?php echo e($room['unit_name']); ?></td>
                                            <td><?php echo e($room['fname'] . ' ' . $room['lname']); ?></td>
                                            <td><?php echo e($room['doors']); ?></td>
                                            <td class="float-end">  
                                                <div class="btn-group dropend">
                                                    <button type="button" class="btn btn-success">
                                                        View
                                                    </button>
                                                    <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="visually-hidden">Toggle Dropright</span> More
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                       <li>rrr</li>
                                                       <li>xxx</li>
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
            <?php $__env->stopSection(); ?>
<?php echo $__env->make('adminstration::layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/rooms/index.blade.php ENDPATH**/ ?>