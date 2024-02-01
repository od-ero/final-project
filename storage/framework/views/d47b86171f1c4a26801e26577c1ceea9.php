
User
<script
  src="https://code.jquery.com/jquery-3.7.1.js"
></script>


<script
  src="https://code.jquery.com/jquery-3.7.1.slim.js"
  integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


   <script>
     <?php echo $__env->yieldPushContent('jquery-scripts'); ?>
   </script>
    <script>
       

        <?php if(Session::has('message')): ?>
            var type = "<?php echo e(Session::get('alert-type', 'info')); ?>"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 10000;
                    toastr.info("<?php echo e(Session::get('message')); ?>");
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
                case 'success':

                    toastr.options.timeOut = 10000;
                    toastr.success("<?php echo e(Session::get('message')); ?>");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'warning':

                    toastr.options.timeOut = 10000;
                    toastr.warning("<?php echo e(Session::get('message')); ?>");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'error':

                    toastr.options.timeOut = 10000;
                    toastr.error("<?php echo e(Session::get('message')); ?>");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
            }
        <?php endif; ?>
    </script><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/layouts/partials/scripts.blade.php ENDPATH**/ ?>