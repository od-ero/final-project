<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo e($description ?? ''); ?>">
    <meta name="keywords" content="<?php echo e($keywords ?? ''); ?>">
    <meta name="author" content="<?php echo e($author ?? ''); ?>">
    <title>Unikey Admin -<?php echo $__env->yieldContent('subtitle'); ?></title>
    <link rel="icon" href="<?php echo e(asset('images/unikey.png')); ?>" type="image/x-icon">
  

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    
    
</head>

<body>
<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('adminstration::layouts.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldSection(); ?>
   
    <div >
    <div class="wrapper" style=" background-color: transparent">

    <?php echo $__env->make('adminstration::layouts.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <?php echo $__env->make('adminstration::layouts.partials.contentheader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       
        <!-- Main content -->
        <section class="content bg-light p-md-5 p-sm-1 rounded">
            <!-- Your Page Content Here -->
            <?php echo $__env->yieldContent('content'); ?>
           
           
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


    <?php echo $__env->make('adminstration::layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<div id="loading_spinner" style="position:fixed; top: 0; left:0; justify-content: center; display: none; background-color: rgb(0,0,0, 0.35);z-index: 9999; align-items: center; width: 100vw; height: 100vh">
    <div  class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>

    
    
</body>
<?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/layouts/master.blade.php ENDPATH**/ ?>