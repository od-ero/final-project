
<?php $__env->startSection('subtitle'); ?>
Add Unit
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
  Add Unit
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
        
<?php echo csrf_field(); ?>



<form name="register-form" id="register-form" onsubmit="return validateForm()"  method="post" action="<?php echo e(url('/units/create')); ?>">
  <div class="container">
  <fieldset>
    <legend>Add a unit:</legend>
    <p>Please fill in this form to Add A Unit.</p>
    <hr>
    <input class="userInput" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
      
    <label  for="lname"><b>Premises Name</b></label>
    <input  class="userInput" type="text" placeholder="Enter Premises Name" name="premises_name" id="premises_name" required>

    <label  for="unit_name"><b>Unit Name</b></label>
    <input  class="userInput" type="text" placeholder=" Enter Unit Name" name="unit_name" id="unit_name" required>
   
   
    <label for="owner_id"><b>Owner Details</b></label>
    <input type="text" class="form-controller userInput" id="search" name="search"></input>
  
    <label for="longitude"><b>Longitude</b></label>
    <input type="text" placeholder="Enter longitude" name="longitude" id="longitude" required>

    <label  for="latitude"><b>Latitude</b></label>
    <input class="userInput" type="text" placeholder="Enter Latitude" name="latitude" id="latitude" required>

    
    <label for="doors"><b>Number Of Doors</b></label>
    <input class="userInput" type="number" placeholder="Enter Number Of Doors" name="doors" id="doors" min="1" required>

    <label for="validateCheckbox"><b>Kindly Check The Box To Enter the Doors Names</b></label>
    <input type="checkbox" id="validateCheckbox" onchange="toggleValidation()" required>

    <div id="doorNamesContainer"></div>
    <hr>

  
    <button type="submit" class="btn btn-primary">Cancel</button> <button type="submit" class="registerbtn">Next</button>
  </div>
  <fieldset>
  
</form>  
<script type="text/javascript">

$('#search').on('keyup',function(){

$value=$(this).val();

$.ajax({

type : 'get',

url : '<?php echo e(URL::to('search')); ?>',

data:{'search':$value},

success:function(data){

$('tbody').html(data);

}

});



})

</script>

<script type="text/javascript">

$.ajaxSetup({ headers: { 'csrftoken' : '<?php echo e(csrf_token()); ?>' } });

</script>
<script>
function toggleValidation() {
    var validateCheckbox = document.getElementById("validateCheckbox");
    var doorNamesContainer = document.getElementById("doorNamesContainer");
    var submitButton = document.querySelector('button[type="submit"]');

    if (validateCheckbox.checked) {
        var numOfDoors = parseInt(document.getElementById("doors").value);

        // Clear previous content
        doorNamesContainer.innerHTML = '';

        for (var i = 0; i < numOfDoors; i++) {
            var inputLabel = document.createElement("label");
            inputLabel.textContent = "Door Name " + (i + 1);

            var inputField = document.createElement("input");
            inputField.type = "text";
            inputField.className = "userInput";
            inputField.placeholder = "Enter Door Name";
            inputField.name = "door_name_" + i;
            inputField.required = true;

            doorNamesContainer.appendChild(inputLabel);
            doorNamesContainer.appendChild(inputField);
            doorNamesContainer.appendChild(document.createElement("br"));
        }

        doorNamesContainer.style.display = "block";
        submitButton.removeAttribute('disabled');
        return true; // Move the return statement here
    } else {
        doorNamesContainer.style.display = "none";
        submitButton.setAttribute('disabled', 'true');
        return false; // Also return a value in the else branch if needed
    }
}
 </script>
 <script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '<?php echo e(csrf_token()); ?>' } });
</script>
 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/add_my_unit.blade.php ENDPATH**/ ?>