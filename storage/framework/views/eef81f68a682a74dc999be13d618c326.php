<!-- <header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
      </a>

   
      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <input type="text" class="form-control form-control-ligth" value="Unikey">
      </form>

      <?php if(auth()->guard()->check()): ?>
      <?php echo e(auth()->user()->name); ?>

    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2 text-secondary">Home</a></li>
        <li><a href="/units/create" class="nav-link px-2 text-white">Add A Room</a></li>

        <?php if(isset($encoded_permission_id)): ?>
            <li><a href="/add/permissions/<?php echo e($encoded_permission_id); ?>" class="nav-link px-2 text-white">Give Permission</a></li>
            <li><a href="/make/schedule/<?php echo e($encoded_permission_id); ?>" class="nav-link px-2 text-white">Activate Button Access</a></li>
        <?php endif; ?>
    </ul>

        <div class="text-end">
          <a href="<?php echo e(route('logout.perform')); ?>" class="btn btn-outline-light me-2">Logout</a>
        </div>
      <?php endif; ?>

      <?php if(auth()->guard()->guest()): ?>
        <div class="text-end">
          <a href="<?php echo e(route('login.perform')); ?>" class="btn btn-outline-light me-2">Login</a>
          <a href="<?php echo e(route('register.perform')); ?>" class="btn btn-warning">Sign-up</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</header> 
<p>Jjj rtrcccc</p> -->
 <!-- <header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
      </a>

   
      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <input type="text" class="form-control form-control-ligth" value="Unikey">
      </form>

      <?php if(auth()->guard()->check()): ?>
      <?php echo e(auth()->user()->name); ?>

    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2 text-secondary">Home</a></li>
        <li><a href="/units/create" class="nav-link px-2 text-white">Add A Room</a></li>

        <?php if(isset($encoded_permission_id)): ?>
            <li><a href="/add/permissions/<?php echo e($encoded_permission_id); ?>" class="nav-link px-2 text-white">Give Permission</a></li>
            <li><a href="/make/schedule/<?php echo e($encoded_permission_id); ?>" class="nav-link px-2 text-white">Activate Button Access</a></li>
        <?php endif; ?>
    </ul>

        <div class="text-end">
          <a href="<?php echo e(route('logout.perform')); ?>" class="btn btn-outline-light me-2">Logout</a>
        </div>
      <?php endif; ?>

      <?php if(auth()->guard()->guest()): ?>
        <div class="text-end">
          <a href="<?php echo e(route('login.perform')); ?>" class="btn btn-outline-light me-2">Login</a>
          <a href="<?php echo e(route('register.perform')); ?>" class="btn btn-warning">Sign-up</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</header> 

   
     <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  --> 
   
     <header class="p-3 bg-dark text-white">

   
    <nav class="navbar navbar-expand-lg bg-dark text-white">
      <div class="container">
      
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use href="<?php echo e(asset('images/unikey.png')); ?>"/></svg>
      </a>

   
      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 d-none d-sm-block">
        <input type="text" class="form-control form-control-ligth  text-center" value="Unikey" readonly>
      </form>
      <?php if(auth()->guard()->check()): ?>
      <?php echo e(auth()->user()->name); ?>

       <a href="/" class="btn btn-outline-secondary text-secondary me-2">
          <span class ="fa-light fa-house"></span> Home
        </a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button> 
        <div class="collapse navbar-collapse bg-dark text-ligth text-center" id="navbarSupportedContent">
        <!-- <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form> -->
          <ul class="navbar-nav col-md-10">
            <!-- <li class="nav-item">
              <a class="nav-link active px-2 text-white" aria-current="page" href="/">Home</a>
            </li> -->
            <?php if(isset($encoded_permission_id)): ?>
            <li class="nav-item">
              <a class="nav-link px-2 text-white" href="/add/permissions/<?php echo e($encoded_permission_id); ?>">Give Permission</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-2 text-white" href="/make/schedule/<?php echo e($encoded_permission_id); ?>">Activate Button Access</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-2 text-white" href="/get/unit/ipAddresses/<?php echo e($encoded_permission_id); ?>">Ip Addresses</a>
            </li>
            <?php endif; ?>
             <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>  -->
            <li class="nav-item">
              <a href="/units/create" class="nav-link px-2 text-white">Add A Room</a>
            </li>
          </ul>
          <div class="text-end">
          <a href="<?php echo e(route('logout.perform')); ?>" class="btn btn-outline-danger ">Logout</a>
        </div>
        <?php endif; ?>
        <?php if(auth()->guard()->guest()): ?>
        <div class="text-end">
          <a href="<?php echo e(route('login.perform')); ?>" class="btn btn-outline-success me-2">Login</a>
          <a href="<?php echo e(route('register.perform')); ?>" class="btn btn-warning">Sign-up</a>
        </div>
      <?php endif; ?>
         
       
      </div>
    </nav>
  </header> <?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/layouts/partials/navbar.blade.php ENDPATH**/ ?>