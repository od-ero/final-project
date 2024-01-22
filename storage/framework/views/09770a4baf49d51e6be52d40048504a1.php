<?php echo csrf_field(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   
    <title>Unikey</title>
</head>
<body>
    <style>
* {box-sizing: border-box}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* Full-width input fields */
input, select {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input:focus, select:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit/register button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity:1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
<div class="container">

<div class="row">

<div class="panel panel-default">

<div class="panel-heading">

<h3>Products info </h3>

</div>

<div class="panel-body">

<div class="form-group">

<input type="text" class="form-controller" id="search" name="search"></input>

</div>

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>ID</th>

<th>Product Name</th>

<th>Description</th>

<th>Price</th>

</tr>

</thead>

<tbody>

</tbody>

</table>

</div>

</div>

</div>

</div>
<form name="register-form" id="register-form" onsubmit="return validateForm()"  method="post" action="<?php echo e(url('/units/create')); ?>">
  <div class="container">
    <h1>Add A Unit</h1>
    <p>Please fill in this form to Add A Unit.</p>
    <hr>
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
      
    <label for="lname"><b>Premises Name</b></label>
    <input type="text" placeholder="Enter Premises Name" name="premises_name" id="premises_name" required>

    <label for="unit_name"><b>Unit Name</b></label>
    <input type="text" placeholder=" Enter Unit Name" name="unit_name" id="unit_name" required>
   
   
    <label for="owner_id"><b>Owner Details</b></label>
    <input type="text" placeholder="" name="search" id="search" required>
    <table class="table table-bordered table-hover">

<thead>

<tr>

<th>ID</th>

<th>Product Name</th>

<th>Description</th>

<th>Price</th>

</tr>

</thead>

<tbody>

</tbody>

</table>
    <label for="longitude"><b>Longitude</b></label>
    <input type="text" placeholder="Enter longitude" name="longitude" id="longitude" required>

    <label for="latitude"><b>Latitude</b></label>
    <input type="text" placeholder="Enter Latitude" name="latitude" id="latitude" required>

    
    <label for="doors"><b>Number Of Doors</b></label>
    <input type="number" placeholder="Enter Number Of Doors" name="doors" id="doors" min="1" required>

    <label for="validateCheckbox"><b>Kindly Check The Box To Enter the Doors Names</b></label>
    <input type="checkbox" id="validateCheckbox" onchange="toggleValidation()" required>

    <div id="doorNamesContainer"></div>
    <hr>

  
    <button type="submit" class="registerbtn">Cancel</button> <button type="submit" class="registerbtn">Next</button>
  </div>

  
</form>  
</body>
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
<!--function toggleValidation() {
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
</script>-->
 
</html>

<?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/add_my_unit.blade.php ENDPATH**/ ?>