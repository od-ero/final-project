
<?php $__env->startSection('subtitle'); ?>
Update Rooms
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Update Rooms
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 
        <div class="bg-primary" id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update Door Details</h3></div>
                                    <div class="card-body">
                                        <form name="edit_ip" id="edit_ip"  method="post" action="<?php echo e(url('/rooms/doors/edit')); ?>">
                                        <input class="form-control" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                                        <input class="form-control" type="hidden" name="door_id" value="<?php echo e($door_details['door_id']); ?>" />
                                            <div class="row mb-3">
                                                
                                                    <div class="form-floating mb-3">
                                                <input class="form-control" name="door_name" id="door_name" type="text" value="<?php echo e($door_details['door_name']); ?>" />
                                                        <label for="inputFirstName" >Door Name</label>
                                                    </div>
                                                
                                               
                                            </div>
                                            <div class="row mb-3">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="ip_address" type="text" name="ip_address" value="<?php echo e($door_details['ip_address']); ?>" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$" />
                                                        <label for="ip_address">IP V4 Address</label>
                                                    </div>
                                               
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="door_ip_status" name="door_ip_status">
                                                    <option value="<?php echo e($door_details['door_ip_status']); ?>" selected><?php echo e($door_details['door_ip_status']); ?></option>
                                                    <option value="Offline">Offline</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                                <label for="door_ip_status">Door Ip Status</label>
                                            </div>
                                            
                                            <div class="mt-4 mb-0 text-center">
                                            <button type="submit" class="btn btn-primary"> Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
       
     <?php $__env->stopSection(); ?>
<?php echo $__env->make('adminstration::layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/rooms/door_edit.blade.php ENDPATH**/ ?>