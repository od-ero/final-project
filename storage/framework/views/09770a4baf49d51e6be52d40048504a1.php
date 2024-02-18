
<?php $__env->startSection('subtitle'); ?>
Add Unit
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
  Add Unit
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
        
<?php echo csrf_field(); ?>



<form name="add_unit" id="add_unit" onsubmit="return validateForm()"  method="post" action="<?php echo e(url('/units/create')); ?>">
  
  <fieldset>
    
    <legend >Add a unit:</legend>
    <p>Please fill in this form to Add A Unit.</p>
    
    <hr>
    <input class="userInput" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
    <input  class="userInput" id="owner_id" type="hidden"  name="owner_id">
    <label for="owner_id"><b>Owner Details</b></label>
    <p><i>
      Kindly enter either of the owners name and and Phone number and search to select the user
    </i></p>
   
    <div class="row userxxInput">
        <div class="col-5">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name')); ?>" placeholder=" " required="required" autofocus>
                <label for="name">Name</label>
            </div>
        </div>

        <div class="col-5">
            <div class="form-floating mb-3">
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" placeholder=" " required="required" autofocus>
                <label for="phone">Phone number</label>
            </div>
        </div>

        <div class="col-2">
            <button class="btn btn-outline-secondary" type="button" id="searchButton">search</button>
        </div>
        
        </div>
        <ul class="dropdown-menu" id="searchResults" style="display: none;">
    <!-- Display search results here -->
</ul>
   
  
    <label  for="lname"><b>Premises Name</b></label>
    <input  class="userInput" type="text" placeholder="Enter Premises Name" name="premises_name" id="premises_name" required>

    <label  for="unit_name"><b>Unit Name</b></label>
    <input  class="userInput" type="text" placeholder=" Enter Unit Name" name="unit_name" id="unit_name" required>
   
   
    <label for="longitude"><b>Longitude</b></label>
    <input class="userInput" type="text" placeholder="Enter longitude" name="longitude" id="longitude" required>

    <label  for="latitude"><b>Latitude</b></label>
    <input class="userInput" type="text" placeholder="Enter Latitude" name="latitude" id="latitude" required>

    
    <label for="doors"><b>Number Of Doors</b></label>
    <input class="userInput" type="number" placeholder="Enter Number Of Doors" name="doors" id="doors" min="1" required>

    <label for="validateCheckbox"><b>Kindly Check The Box To Enter the Doors Names</b></label>
    <input type="checkbox" id="validateCheckbox" onchange="toggleValidation()" required>

    <div id="doorNamesContainer"></div>
   

  <div class="text-center">
   <hr> 
  <a href="/link-to/whatever-address/" id="cancel" name="cancel" class="btn btn-primary mx-3">Cancel</a> <button type="submit" class="btn btn-success mx-3"> Register</button>  <button type="reset" class="btn btn-default pull-right">Cancel reset</button> <button id="cancel" name="cancel" class="btn btn-default" onclick="history.back()">Cancel onclick</button>
  </div>
  </div>
  <fieldset>
  
</form>  
<script type="text/javascript">
  $(document).ready(function() {
    $('#searchButton').click(function() {
      // Get the values from the input fields
      var searchTerm1 = $('#name').val();
      var searchTerm2 = $('#phone').val();

      // Call the search method in the controller using Ajax
      $.ajax({
        type: 'GET',
        url: '/user/search', // Replace with your actual search endpoint
        data: { term1: searchTerm1, term2: searchTerm2 },
        success: function(data) {
         
          // Update the search results in the dropdown menu
          displaySearchResults(data);
        }
      });
    });

    // Handle item selection in the search results
    $('#searchResults').on('click', '.search-item', function() {
    var selectedValue = $(this).data('id');
    var selectedDisplayName = $(this).text();
    var displayPhone = $(this).data('phone'); // Correct variable name

    // Update input fields with the selected values
    $('#name').val(selectedDisplayName);
    $('#owner_id').val(selectedValue);

    // Use the correct variable name here
    $('#phone').val(displayPhone);

    // Clear the search results dropdown
    $('#searchResults').empty();
});
    function displaySearchResults(results) {
   // console.log(results); // Log the results to the console

    var $searchResults = $('#searchResults');
    $searchResults.empty();

    if (results.length > 0) {
      console.log(results);
        results.forEach(function(result) {
            // Append list item directly without creating a jQuery object
            $searchResults.append('<li class="dropdown-item search-item" data-id="' + result.id + '" data-phone="' + result.displayPhone + '">' + result.displayName + '</li>');

        });
        $searchResults.show();  // Show the dropdown if there are results
    } else {
      $searchResults.append('<li class="dropdown-item">Ooopss!! Dis not match any user</li>');  // Hide the dropdown if there are no results
    }
}

  });

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