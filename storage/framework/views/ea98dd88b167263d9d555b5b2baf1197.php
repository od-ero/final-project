
<?php $__env->startSection('subtitle'); ?>
   Add A Unit
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    Add A Unit
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">

                    <div class="container-fluid px-4">
                        <h2 class="mt-4">Users</h2>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/welcome">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Phone Number</th>
                                            <th>Email Address</th>
                                            <th>Joining Date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Phone Number</th>
                                            <th>Email Address</th>
                                            <th>Joining Date</th>
                                        </tr>
                                    </tfoot>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($user['fname']); ?></td>
                                            <td><?php echo e($user['lname']); ?></td>
                                            <td><?php echo e($user['phone']); ?></td>
                                            <td><?php echo e($user['email']); ?></td>
                                            <td ><?php echo e($user['created_at']); ?></td>
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
<?php echo $__env->make('adminstration::layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/users/index.blade.php ENDPATH**/ ?>