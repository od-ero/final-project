

<?php $__env->startSection('content'); ?>
    <form method="post" action="<?php echo e(route('login.perform')); ?>">
        
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
        <img class="mb-4" src="<?php echo url('images/bootstrap-logo.svg'); ?>" alt="" width="72" height="57">
        
        <h1 class="h3 mb-3 fw-normal">Login</h1>

        <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="form-group form-floating mb-3">
        <label for="floatingName">Email or Phone</label>
            <input type="text" class="form-control" name="login_identifier" value="<?php echo e(old('login_identifier')); ?>" placeholder="enter email" required="required" autofocus>
           
            <?php if($errors->has('login_identifier')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('login_identifier')); ?></span>
            <?php endif; ?>
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="<?php echo e(old('password')); ?>" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            <?php if($errors->has('password')): ?>
                <span class="text-danger text-left"><?php echo e($errors->first('password')); ?></span>
            <?php endif; ?>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        
        <?php echo $__env->make('auth.partials.copy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/auth/login.blade.php ENDPATH**/ ?>