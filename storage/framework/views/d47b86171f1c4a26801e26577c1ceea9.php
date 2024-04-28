
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
       

       var message = "<?php echo e(Session::get('message')); ?>";
    if (message) {
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
            }}
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
        url: '/user/search', // Replace with your actual search endpoint
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
            $searchResults.append('<li class="dropdown-item search-item bg-success text-white" data-id="' + result.id + '" data-phone="' + result.displayPhone + '">' + result.displayName + '</li>');

        });
        $searchResults.show();  // Show the dropdown if there are results
    } else {
        toastr['error']('Ooops!! The user with the given details does not exist');
    }
}

  });

</script><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/layouts/partials/scripts.blade.php ENDPATH**/ ?>