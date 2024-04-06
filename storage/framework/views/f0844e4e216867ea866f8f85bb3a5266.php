
<?php $__env->startSection('subtitle'); ?>
 Update   Access Permission
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    Update Access Permission
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   
     
<form name="add_permission" id="add_permission" method="post" action="<?php echo e(url('/permissions/edit/guests/permissions/' .$encoded_permission_id. '/' .base64_encode($selected_permission['id']))); ?>">


  
    <fieldset>
  
   <legend>Update Access Priviledges To <b class="text-uppercase"> <?php echo e($unit['premises_name'] . ', ' . $unit['unit_name']); ?></b> </legend>
    <p>Please Fill In This Form To Update Access Priviledges.</p>

   
    <hr>
    
    <input class="userInput" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
    <input  class="userInput" id="owner_id" type="hidden"  name="user_id">
    <label for="fname"><b>User</b></label>
    <p><i>
      Kindly enter either of the Users name and and phone number and search to select the user
    </i></p>
   
    <div class="row userxxInput">
        <div class="col-5">
            <div class="form-floating mt-3 mb-3">
                <input type="text" class=".inputUserInput form-control" id="name" name="name" value="<?php echo e($selected_permission['fname'] .' '. $selected_permission['lname']); ?>" placeholder=" " required="required" autofocus>
                <label for="name">Name</label>
            </div>
        </div>

        <div class="col-5">
            <div class="form-floating mt-3 mb-3">
                <input type="tel" class=".inputUserInput form-control" id="phone" name="phone" value="<?php echo e($selected_permission['phone']); ?>" placeholder=" " required="required" autofocus>
                <label for="phone">Phone number</label>
            </div>
        </div>

        <div class="col-2 mt-4 mb-3">
            <button class="btn btn-outline-secondary" type="button" id="searchButton">search</button>
        </div>
        
        </div>
        <ul class="dropdown-menu" id="searchResults" style="display: none;">
    <!-- Display search results here -->
</ul>
        <div class="u">
            <label for="permission_group_id"><i>Permision Name</i></label>
            <select  name="permission_group_id" id="permission_group_id" required class="form-control userInput">
              <option value="<?php echo e($selected_permission['permission_group_id']); ?>"><?php echo e($selected_permission['permission_group_name']); ?></option>
              <?php $__currentLoopData = $permission_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($permission_group->id); ?>"> <?php echo e($permission_group->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
       </div> 
    <label for="door"><i>Select the the doors to be affected by the permissions</i></label>
    <div class="userCheck userInput">
        <?php $__currentLoopData = $doors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $door): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check">
                <label class="form-check-label" for="door_id_<?php echo e($index + 1); ?>">
                    <?php echo e($door->door_name); ?>

                </label>
                <input class="form-check-input" type="checkbox" name="door_id_<?php echo e($index + 1); ?>" value="<?php echo e($door->id); ?>" id="door_id_<?php echo e($index + 1); ?>"
                      <?php if(in_array($door->id, $selectedDoors)): ?> checked <?php endif; ?>>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
      <label for="start_date"><b>Start Date</b></label>
    <input class="userInput" type="datetime-local" placeholder="Please Enter the check in time" name="start_date" id="start_date" value="<?php echo e($selected_permission['start_date']); ?>" required>

    <label for="end_date"><b>End Date</b></label>
    <input class="userInput" type="datetime-local" placeholder="Please Enter the check out time" name="end_date" id="end_date" value="<?php echo e($selected_permission['end_date']); ?>" required>
   

    <hr>

    <div class="text-center">
  <button type="submit" class="btn btn-success mx-3">Edit Priviledges</button>
  <a href="<?php echo e(URL::previous()); ?>" class="btn btn-secondary">Cancel</a>
    </div>


    <!-- next elements -->
  </fieldset>
</div>
</form>  
<style>
    .use_existing, .create_new {
      display: none;
    }

    .visible {
      display: block;
    }
  </style>
    <script>
    $(document).ready(function () {
      $('input[type=radio][name=permission_group]').change(function() {
        var selectedClass = $(this).val();

        // Hide all classes
        $('.use_existing, .create_new').removeClass('visible');

        // Show the selected class
        $('.' + selectedClass).addClass('visible');
      });
    });
  </script> 
<script>
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
<script>
    $(document).ready(function () {
      $('input[type=radio][name=permission_group]').change(function() {
        var selectedClass = $(this).val();

        // Hide all classes
        $('.use_existing, .create_new').removeClass('visible');

        // Disable elements within the invisible class
        $('.use_existing *').prop('disabled', true);
        $('.create_new *').prop('disabled', true);

        // Show the selected class
        $('.' + selectedClass).addClass('visible');

        // Enable elements within the visible class
        $('.' + selectedClass + ' *').prop('disabled', false);
      });
    });
  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/permissions/editMyPermissions.blade.php ENDPATH**/ ?>