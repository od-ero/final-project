

<?php $__env->startSection('subtitle'); ?>
   Welcome
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
  Welcome
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
     <br> It will take around <?php echo e($totalTime); ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="/welcome/devices/health" class="btn btn-primary btn-lg" tabindex="-1" role="button">Yes</a>
      </div>
    </div>
  </div>
</div>
  <div class="row">
    <!-- First card -->
    <div class="col-md-5">
      <div class="card bg-danger text-center m-3" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Total Rooms</h5>
          <h1 class="card-text"><?php echo e($total_units); ?></h1>
          <a href="/rooms/index" class="block-anchor panel-footer text-center text-white">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    <!-- </div>
     Second card 
    <div class="col-md-5"> -->
      <div class="card bg-success text-center m-3" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title ">Total Registered Users</h5>
          <h1 class="card-text "><?php echo e($total_users); ?></h1>
          <a href="/users/index" class="block-anchor panel-footer text-center text-white">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminstration::layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/home/index.blade.php ENDPATH**/ ?>