
@extends('adminstration::layouts.admin_master')
@section('subtitle')
   Welcome
@endsection

@section('contentheader_title')
  Welcome
@endsection

@section('content')
<div class="container">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
      Are You Sure you want to scan for devices health? 
     <br> It will take around {{$totalTime}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="backendRequestButton" onclick="redirectToAction()" class="btn btn-primary btn-lg">Yes</button>
        <!-- <a href="/welcome/devices/health" class="btn btn-primary btn-lg" tabindex="-1" onclick="showLoadingToast()" role="button">Yes</a> -->
      </div>
    </div>
  </div>
</div>
  <div class="row">
    <!-- First card -->
    <div class="col-md-5">
      <div class="card bg-white text-center m-3" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Total Rooms</h5>
          <h1 class="card-text">{{$total_units}}</h1>
          <a href="/rooms/index" class="block-anchor panel-footer text-center ">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    <!-- </div>
     Second card 
    <div class="col-md-5"> -->
      <div class="card bg-white text-center m-3" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title ">Total Registered Users</h5>
          <h1 class="card-text ">{{$total_users}}</h1>
          <a href="/users/index" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>

      <div class="m-3" style="width: 18rem;">
        <button class="btn btn-outline-light btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">Scan Devices Health </button>
      </div>
    </div>
    <!-- Chart container -->
    <div class="col-md-7">
      <div id="chartContainer" class="m-3"></div>
    </div>
  </div>
</div>
<script>
window.onload = function () {
    // Function to fetch data from Laravel backend
    function fetchData() {
        $.ajax({
            url: '/welcome/data', // Replace 'your-backend-url' with your Laravel backend endpoint
            type: 'GET',
            success: function(response) {
                // Parse response and populate dataPoints arrays
                var dataPointsOnline = [];
                var dataPointsOffline = [];
                var dataPointsInactive = [];
                var dataPointsUnitName = [];

                response.forEach(function(item) {
                    dataPointsOnline.push({ y: item.count_online, label: item.premises_name });
                    dataPointsOffline.push({ y: item.count_offline, label: item.premises_name });
                    dataPointsInactive.push({ y: item.count_inactive, label: item.premises_name });
                    dataPointsUnitName.push({ y: item.unit_name });
                });

                var options = {
                    animationEnabled: true,
                    theme: "light2",
                    title:{
                        text: "Rooms and Device Status"
                    },
                    axisY2: {
                        prefix: "Room:",
                        lineThickness: 0                
                    },
                    toolTip: {
                        shared: true
                    },
                    legend:{
                        verticalAlign: "top",
                        horizontalAlign: "center"
                    },
                    data: [{
                        type: "stackedBar",
                        showInLegend: true,
                        name: "Devices Online",
                        color: "#14A44D",
                        axisYType: "secondary",
                        dataPoints: dataPointsOnline
                    }, {
                        type: "stackedBar",
                        showInLegend: true,
                        name: "Devices Offline",
                        color: "#DC4C64",
                        //indexLabel: "$#total",
                        axisYType: "secondary",
                        dataPoints: dataPointsOffline
                    }, {
                        type: "stackedBar",
                        showInLegend: true,
                        name: "Devices Inactive",
                        color:"#3B71CA",
                       // indexLabel: "$#total",
                        axisYType: "secondary",
                        dataPoints: dataPointsInactive
                    }]
                };

                $("#chartContainer").CanvasJSChart(options);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    }

    // Call the function to fetch data when the window loads
    fetchData();
}  

</script>
<!-- <script>
 function redirectToAction() {
        toastr.info('Loading...', {
            closeButton: false,
            progressBar: true,
            positionClass: 'toast-top-full-width',
            timeOut: 0, // Set timeOut to 0 so that the toastr stays until removed manually
            extendedTimeOut: 0 // Set extendedTimeOut to 0 so that the toastr stays until removed manually
        });
    }

    // This function removes the toastr notification when the server response is received
    function removeLoadingToast() {
        toastr.clear();
    }
    $.ajax({
    url: '/welcome/devices/health',
    method: 'GET',
    success: function(response) {
        // Handle the response
        removeLoadingToast(); // Remove the toastr notification
    },
    error: function(xhr, status, error) {
        // Handle the error
        removeLoadingToast(); // Remove the toastr notification if needed
    }
});



</script> -->
<script>
            async function redirectToAction() {
  let loadingToast;
    try {
        // Display loading message
        toastr.info('Loading...', {
            closeButton: false,
            progressBar: true,
            positionClass: 'toast-top-full-width',
            timeOut: 50000, // Set timeOut to 0 so that the toastr stays until removed manually
            extendedTimeOut: 50000 // Set extendedTimeOut to 0 so that the toastr stays until removed manually
        });
        
        const actionURL = '/welcome/devices/health' ;

        // Fetch data
        const res = await fetch(actionURL);
        const data = await res.json();

        // Display appropriate toastr message based on response
        if (data.alertType == 'success' || data.alertType === 'error' || data.alertType === 'success2') {
            toastr.clear(loadingToast);
            toastr[data.alertType](data.message);
            setTimeout(() => {
                location.reload();
            }, 5000);
        } else {
            throw new Error("Unknown alert type in response data");
        }
    } catch (error) {
        // Display error toast
        toastr.clear(loadingToast);
        toastr.error(error.message, {
            closeButton: true,
            positionClass: 'toast-top-full-width'
        });
        console.error('Ooops!! An error ocurred please conduct your adminstrator for assistance');
    }
}
</script>
@endsection
