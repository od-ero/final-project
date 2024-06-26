
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
                                                        <input class="form-control" id="name" name="name" value="<?php echo e(old('name')); ?>" type="text" required placeholder="Enter first or second name" />
                                                        <label for="name">Owner's Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="phone" type="tel" placeholder="Search by phone number" required/>
                                                        <label for="phone">Owner's Phone Number</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                <button class="btn btn-outline-secondary" type="button" id="userSearchButton">search</button>
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
                                                <div class="col-md-12">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" id="currentLocationCheckbox" type="checkbox" onchange="getLocation()" />
                                                        <label class="form-check-label" for="currentLocationCheckbox">Use current location</label>
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
                                                        <input class="form-check-input" id="validateCheckbox" type="checkbox"  onchange="toggleValidation()" required/>
                                                        <label class="form-check-label" for="validateCheckbox">Kindly Check The Box To Enter the Doors Names</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3 mb-md-0">
                                            <div id="doorNamesContainer"></div>
                                                
                                            </div>
                                            <div class="mt-4 mb-0 text-center">
                                                <a href="<?php echo e(URL::previous()); ?>" class="btn btn-secondary">Back</a>
                                                <button type="submit" class="btn btn-primary"> Create</button>
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
    
<script>
    function toggleValidation() {
    var validateCheckbox = document.getElementById("validateCheckbox");
    var doorNamesContainer = document.getElementById("doorNamesContainer");
    var submitButton = document.querySelector('button[type="submit"]');

    if (validateCheckbox.checked) {
        var numOfDoors = parseInt(document.getElementById("doors").value);
       if(numOfDoors > 0){
        
        // Clear previous content
        doorNamesContainer.innerHTML = '';

        // Determine the number of rows needed
        var numRows = Math.ceil(numOfDoors / 2); // For pairs of doors in each row

        for (var i = 1; i <= numRows; i++) {
            var rowDiv = document.createElement("div");
            rowDiv.className = "row mb-3";

            // Create first column for odd-numbered door
            var colDiv1 = document.createElement("div");
            colDiv1.className = "col-md-6";

            if (2 * i - 1 <= numOfDoors) { // Check if there's an odd-numbered door to add
                var formFloatingDiv1 = document.createElement("div");
                formFloatingDiv1.className = "form-floating mb-3 mb-md-0";

                var inputField1 = document.createElement("input");
                inputField1.type = "text";
                inputField1.className = "form-control";
                inputField1.placeholder = "";
                inputField1.name = "door_name_" + (2 * i - 1);
                inputField1.id = "door_name_" + (2 * i - 1);
                inputField1.required = true;

                var label1 = document.createElement("label");
                label1.htmlFor = "door_name_" + (2 * i - 1);
                label1.textContent = "Door " + (2 * i - 1) + " Name";

                formFloatingDiv1.appendChild(inputField1);
                formFloatingDiv1.appendChild(label1);
                colDiv1.appendChild(formFloatingDiv1);
            }

            // Create second column for even-numbered door
            var colDiv2 = document.createElement("div");
            colDiv2.className = "col-md-6";

            if (2 * i <= numOfDoors) { // Check if there's an even-numbered door to add
                var formFloatingDiv2 = document.createElement("div");
                formFloatingDiv2.className = "form-floating";

                var inputField2 = document.createElement("input");
                inputField2.type = "text";
                inputField2.className = "form-control";
                inputField2.placeholder = "";
                inputField2.name = "door_name_" + (2 * i);
                inputField2.id = "door_name_" + (2 * i);
                inputField2.required = true;

                var label2 = document.createElement("label");
                label2.htmlFor = "door_name_" + (2 * i);
                label2.textContent = "Door " + (2 * i) + " Name";

                formFloatingDiv2.appendChild(inputField2);
                formFloatingDiv2.appendChild(label2);
                colDiv2.appendChild(formFloatingDiv2);
            }

            // Append columns to row
            rowDiv.appendChild(colDiv1);
            rowDiv.appendChild(colDiv2);

            // Append row to container
            doorNamesContainer.appendChild(rowDiv);
        }

        doorNamesContainer.style.display = "block";
        submitButton.removeAttribute('disabled');
        return true;

        }
            else{
                toastr['error']('Ooops kindly enter valid numbers of doors');
            }
    } else {
        doorNamesContainer.style.display = "none";
        submitButton.setAttribute('disabled', 'true');
        return false;


    }

}

</script>

<script type="text/javascript">

$.ajaxSetup({ headers: { 'csrftoken' : '<?php echo e(csrf_token()); ?>' } });

</script>

 <script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '<?php echo e(csrf_token()); ?>' } });
</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        
         <?php $__env->stopSection(); ?>       


<?php echo $__env->make('adminstration::layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/rooms/add_unit.blade.php ENDPATH**/ ?>