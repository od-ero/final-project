<?php $__env->startSection('content'); ?>
    <h1>Hello World</h1>

    <p>Module: <?php echo config('adminstration.name'); ?></p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminstration::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/index.blade.php ENDPATH**/ ?>