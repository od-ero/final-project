  
<?php $__env->startSection('subtitle'); ?>
Register
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <form method="post" action="<?php echo e(route('register.perform')); ?>">

        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
        <input type="hidden" name="role_id" value="1" />
       <div class="align-items-center ">
       <img class=" mb-4" src="<?php echo url('images/unikey.png'); ?>" alt="" width="72" height="57">
        
       </div>
        <h1 class="h3 mb-3 fw-normal">Register</h1>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="fname" value="<?php echo e(old('fname')); ?>" placeholder="First Name" required="required" autofocus>
            <label for="floatingEmail">First Name</label>
            <?php if($errors->has('fname')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('fname')); ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="lname" value="<?php echo e(old('lname')); ?>" placeholder="Last Name" required="required" autofocus>
            <label for="floatingEmail">Last Name</label>
            <?php if($errors->has('lname')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('lname')); ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group form-floating mb-3">
            <input type="tel" class="form-control" name="phone" value="<?php echo e(old('email')); ?>" placeholder="0798765432" required="required" autofocus>
            <label for="floatingEmail">Phone Number</label>
            <?php if($errors->has('phone')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('phone')); ?></span>
            <?php endif; ?>
        </div>
        <div class="form-group form-floating mb-3">
            <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="name@example.com" required="required" autofocus>
            <label for="floatingEmail">Email address</label>
            <?php if($errors->has('email')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('email')); ?></span>
            <?php endif; ?>
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="<?php echo e(old('password')); ?>" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            <?php if($errors->has('password')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('password')); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password_confirmation" value="<?php echo e(old('password_confirmation')); ?>" placeholder="Confirm Password" required="required">
            <label for="floatingConfirmPassword">Confirm Password</label>
            <?php if($errors->has('password_confirmation')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('password_confirmation')); ?></span>
            <?php endif; ?>
        </div>

        <button class="w-100 btn btn-lg btn-success" type="submit">Register</button>
        <div class="form-group form-floating mb-3">
        <br>  <p>Already have an account?<a href="/login">login</a></p>
        </div>

      
        
        <?php echo $__env->make('auth.partials.copy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/auth/register.blade.php ENDPATH**/ ?>