
<?php $__env->startSection('subtitle'); ?>
  Users
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Users
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        <div class="container">
                
                    <div class="container-fluid px-4">
                        <h2 class="mt-4 text-white">Users</h2>
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
                            <div class="card-header">
                                <i class="fas fa-users me-1"></i>
                                Users
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Phone Number</th>
                                            <th>Email Address</th>
                                            <?php if($user_role_id > 2): ?>
                                            <th>Role</th>
                                            <?php endif; ?>
                                            <th>Joining Date</th>
                                            <?php if($user_role_id > 2): ?>
                                            <th>Action</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Phone Number</th>
                                            <th>Email Address</th>
                                            <?php if($user_role_id > 2): ?>
                                            <th>Role</th>
                                            <?php endif; ?>
                                            <th>Joining Date</th>
                                            <?php if($user_role_id > 2): ?>
                                            <th>Action</th>
                                            <?php endif; ?>
                                        </tr>
                                    </tfoot>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($user['fname']); ?></td>
                                            <td><?php echo e($user['lname']); ?></td>
                                            <td><?php echo e($user['phone']); ?></td>
                                            <td><?php echo e($user['email']); ?></td>
                                            <?php if($user_role_id > 2): ?>
                                            <td><?php echo e($user['role_name']); ?></td>
                                            <?php endif; ?>
                                            <td ><?php echo e($user['created_at']); ?></td>
                                            <?php if($user_role_id > 2): ?>
                                            <td> <a href="/users/admins/show/<?php echo e(base64_encode($user['id'])); ?>" class="btn btn-primary btn-lg" tabindex="-1" role="button">Update Role</a></td>
                                            <?php endif; ?>
                                        </tr>
                                        
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
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
                function setUserId(userId) {
                    document.getElementById('userIdInput').value = userId;
                }
            </script>
            <?php $__env->stopSection(); ?>
<?php echo $__env->make('adminstration::layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/users/index.blade.php ENDPATH**/ ?>