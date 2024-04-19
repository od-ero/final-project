<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" crossorigin="anonymous"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet">

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<!-- Moment.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- Font Awesome -->
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

<!-- jQuery Validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<!-- jQuery DataTables -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<!-- jQuery Simple DataTables -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

<!-- jQuery CanvasJS -->
<script type="text/javascript" src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
 

<script>
       var message = "<?php echo e(Session::get('message')); ?>";
    if (message) {
            var type = "<?php echo e(Session::get('alert-type', 'info')); ?>"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 300000;
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
            }}
    </script>
    <script>
    function getLocation() {
    var checkbox = document.getElementById("currentLocationCheckbox");
    var latitudeInput = document.getElementById("latitude");
    var longitudeInput = document.getElementById("longitude");

    if (checkbox.checked) {
        // Check if Geolocation is supported by the browser
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    // Success callback
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    // Update the input fields with obtained coordinates
                    latitudeInput.value = latitude;
                    longitudeInput.value = longitude;
                },
                function(error) {
                    // Error callback
                    //console.error("Error getting geolocation:", error);
                    toastr['error']('Ooops!! Error getting your current location please try again');
                    //alert(error.message);
                   // alert("Error getting geolocation. Please try again.");
                    checkbox.checked = false; // Uncheck the checkbox
                }
            );
        } else {
            // Geolocation not supported by the browser
           // console.error("Geolocation is not supported by this browser.");
           toastr['error']('Ooops!! Your browser does not support location services');
           // alert("Geolocation is not supported by this browser.");
            checkbox.checked = false; // Uncheck the checkbox
        }
    } else {
        // If checkbox is unchecked, clear the input fields
        latitudeInput.value = "";
        longitudeInput.value = "";
    }
}
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#userSearchButton').click(function() {
      // Get the values from the input fields
      var searchTerm1 = $('#name').val();
      var searchTerm2 = $('#phone').val();
    
      if(searchTerm1 || searchTerm2){
        $.ajax({
        type: 'GET',
        url: '/admin/user/search', // Replace with your actual search endpoint
        data: { term1: searchTerm1, term2: searchTerm2 },
        success: function(data) {
        //     if(data){
        //  alert(data);}
        //  else{
        //     alert('no data'); 
        //  }
          // Update the search results in the dropdown menu
          displaySearchResults(data);
        }
      });
    }else{
        toastr['error']('Ooops!! Kindly enter either a name or a phone number');
      
      }
    });
      
      // Call the search method in the controller using Ajax
     

    // Handle item selection in the search results
    $('#searchResults').on('click', '.search-item', function() {
    var selectedValue = $(this).data('id');
    var selectedDisplayName = $(this).text();
    var displayPhone = $(this).data('phone'); 

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
            $searchResults.append('<li class="dropdown-item search-item bg-primary text-white" data-id="' + result.id + '" data-phone="' + result.displayPhone + '">' + result.displayName + '</li>');

        });
        $searchResults.show();  // Show the dropdown if there are results
    } else {
        toastr['error']('Ooops!! The user with the given details does not exist');
    }
}

  });

</script>
   
   <?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/layouts/partials/scripts.blade.php ENDPATH**/ ?>