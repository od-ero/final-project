<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Evans Odero">
    <meta name="generator" content="Hugo 0.87.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Unikey-<?php echo $__env->yieldContent('subtitle'); ?> </title>
    
   <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- 
      Bootstrap core CSS -->
    <link href="<?php echo url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    
    <link href="<?php echo url('assets/css/all.css'); ?>" rel="stylesheet" type="text/css">
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="<?php echo url('assets/css/app.css'); ?>" rel="stylesheet">
</head>
<body>
    
    <?php echo $__env->make('layouts.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <?php $__env->startSection('scripts'); ?>
       <?php echo $__env->make('layouts.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <?php echo $__env->yieldSection(); ?>
  
  </body>
</html>
<?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/layouts/app-master.blade.php ENDPATH**/ ?>