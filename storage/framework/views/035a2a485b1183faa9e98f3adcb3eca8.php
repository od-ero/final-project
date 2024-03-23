

<?php $__env->startSection('subtitle'); ?>
   Welcome
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
  Welcome
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<body>
<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">

													<div class="stat-panel-number h1 "><?php 1?></div>
													<div class="stat-panel-title text-uppercase">Reg Users</div>
												</div>
											</div>
											<a href="reg-users.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
<div id="chartContainer" style="width: 50%;  " class="pull-rigth"></div>

</body>
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
                        //indexLabel: "$#total",
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

<?php echo $__env->make('adminstration::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/home/index.blade.php ENDPATH**/ ?>