
<?php $__env->startSection('subtitle'); ?>
Update Roles
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Update Roles
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
            Are You Sure you want to delete this Room? 
            <form id="deleteForm" action="/users/roles/update" method="POST">
                
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="user_id" id="userIdInput">
                            
                                         <div class="form-floating mb-3">
                                                <select class="form-select" id="door_ip_status" name="door_ip_status">
                                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($role['id']); ?>"><?php echo e($role['role_name']); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <label for="door_ip_status">Door Ip Status</label>
                                            </div>
                                  
                            
                        </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('deleteForm').submit()">Change Role</button>

            </div>
            </div>
        </div>
        </div>
        
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update Door Details</h3></div>
                                    <div class="card-body">
                                        <form name="edit_ip" id="edit_ip"  method="post" action="<?php echo e(url('/users/admins/show/'.base64_encode($user['id']))); ?>">
                                        <input class="form-control" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                                        <input class="form-control" type="hidden" name="user_id" value="<?php echo e($user['id']); ?>" />
                                            <div class="row mb-3">
                                                
                                                    <div class="form-floating mb-3">
                                                <input class="form-control" name="door_name" id="door_name" type="text" value="<?php echo e($user['fname'] .' '. $user['lname']); ?>" />
                                                        <label for="inputFirstName" >Name</label>
                                                    </div>
                                                
                                               
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="role_id" name="role_id">
                                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($role->id); ?>" <?php echo e($user->role_id === $role->id ? 'selected' : ''); ?>>
                                                        <?php echo e($role->role_name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <label for="door_role">Role</label>
                                            </div>
                                            
                                            <div class="mt-4 mb-0 text-center">
                                            <button type="submit" class="btn btn-primary">Change Role</button>
                                            <a href="<?php echo e(URL::previous()); ?>" class="btn btn-secondary">Cancel</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
       
     <?php $__env->stopSection(); ?>
<?php echo $__env->make('adminstration::layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/users/edit_admin.blade.php ENDPATH**/ ?>