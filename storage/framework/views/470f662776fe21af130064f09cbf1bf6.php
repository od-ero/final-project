

<?php $__env->startSection('content'); ?>
    <form method="post" action="<?php echo e(route('register.perform')); ?>">

        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
        <img class="mb-4" src="<?php echo url('images/bootstrap-logo.svg'); ?>" alt="" width="72" height="57">
        
        <h1 class="h3 mb-3 fw-normal">Register</h1>

        <div class="form-group form-floating mb-3">
        <label for="floatingfname">First Name</label>
            <input type="text" class="form-control" name="fname" value="<?php echo e(old('fname')); ?>" placeholder="Enter Your First Name" required="required" autofocus>
           
            <?php if($errors->has('fname')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('fname')); ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group form-floating mb-3">
        <label for="lname">Last Name</label>
            <input type="text" class="form-control" name="lname" value="<?php echo e(old('lname')); ?>" placeholder="Enter Your Last Name" required="required" autofocus>
           
            <?php if($errors->has('lname')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('lname')); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group form-floating mb-3">
        <label for="floatingEmail">Email address</label>
            <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="name@example.com" required="required" autofocus>
           
            <?php if($errors->has('email')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('email')); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group form-floating mb-3">
        <label for="floatingName">Phone Number</label>
            <input type="tel" class="form-control" name="phone" value="<?php echo e(old('phone')); ?>" placeholder="Enter Your Phone Number" required="required" autofocus>
            
            <?php if($errors->has('phone')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('phone')); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group form-floating mb-3">
        <label for="floatingPassword">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo e(old('password')); ?>" placeholder="Password" required="required">
           
            <?php if($errors->has('password')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('password')); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group form-floating mb-3">
        <label for="floatingConfirmPassword">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" value="<?php echo e(old('password_confirmation')); ?>" placeholder="Confirm Password" required="required">
            
            <?php if($errors->has('password_confirmation')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('password_confirmation')); ?></span>
            <?php endif; ?>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        
        <?php echo $__env->make('auth.partials.copy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/auth/register.blade.php ENDPATH**/ ?>