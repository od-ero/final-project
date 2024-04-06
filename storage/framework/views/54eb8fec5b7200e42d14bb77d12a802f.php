
<?php $__env->startSection('subtitle'); ?>
Add A Room
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
   Add A Room
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 
        <div class="bg-primary" id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add A Room</h3></div>
                                    <div class="card-body">
                                    <!-- id="add_unit" onsubmit="return validateForm()"  method="post" action="<?php echo e(url('/rooms/create')); ?>" -->
                                        <form name="add_unit" id="add_unit" onsubmit="return validateForm()" method="post" action="<?php echo e(url('/rooms/create')); ?>" >
                                        <input class="form-control" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                                        <input  class="form-controlt" id="owner_id" type="hidden"  name="owner_id">
                                        <div class="row mb-3">
                                        <p><i>
                                            Kindly enter either of the owners name or Phone number and search to select the user
                                         </i></p>
                                                <div class="col-md-5">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="name" name="name" value="<?php echo e(old('name')); ?>" type="text" placeholder="Enter first or second name" />
                                                        <label for="name">Owner's Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="phone" type="tel" placeholder="Search by phone number" />
                                                        <label for="phone">Owner's Phone Number</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                <button class="btn btn-outline-secondary" type="button" id="searchButton">search</button>
                                                </div>
                                            </div> 
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="dropdown-menu" id="searchResults" style="display: none;">
        
                                                    </ul>    
                                                </div>
                                                <div class="col-md-3">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input  class="form-control" type="text" placeholder="Enter Premises Name" name="premises_name" id="premises_name" required>
                                                        <label for="inputFirstName">Premises Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" type="text" placeholder=" Enter Unit Name" name="unit_name" id="unit_name" required />
                                                        <label for="unit_name">Room Name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input  class="form-control" type="text" placeholder="Enter longitude" name="longitude" id="longitude" required>
                                                        <label for="inputFirstName">Longitude</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" type="text" placeholder="Enter Latitude" name="latitude" id="latitude" required />
                                                        <label for="unit_name">Latitude</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input  class="form-control" type="number" placeholder="Enter Number Of Doors" name="doors" id="doors" min="1" required>
                                                        <label for="inputFirstName">Number Of Doors</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" id="validateCheckbox" type="checkbox" onclick="loadToast()" onchange="toggleValidation()" required/>
                                                        <label class="form-check-label" for="validateCheckbox">Kindly Check The Box To Enter the Doors Names</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3 mb-md-0">
                                            <div id="doorNamesContainer"></div>
                                                
                                            </div>
                                            <div class="mt-4 mb-0 text-center">
                                            <button type="submit" class="btn btn-primary"> Create</button>
                                            <a href="<?php echo e(URL::previous()); ?>" class="btn btn-secondary">Cancel</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    <script type="text/javascript">
  $(document).ready(function() {
    $('#searchButton').click(function() {
      // Get the values from the input fields
      var searchTerm1 = $('#name').val();
      var searchTerm2 = $('#phone').val();
console.log('button clicked');
      // Call the search method in the controller using Ajax
      $.ajax({
        type: 'GET',
        url: '/admin/user/search', // Replace with your actual search endpoint
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
            inputField.className = "form-control";
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        
         <?php $__env->stopSection(); ?>       


<?php echo $__env->make('adminstration::layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/rooms/add_unit.blade.php ENDPATH**/ ?>