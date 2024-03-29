
@extends('adminstration::layouts.admin_master')
@section('subtitle')
   Welcome
@endsection

@section('contentheader_title')
  Welcome
@endsection

@section('content')
<div class="container">
  <div class="row">
    <!-- First card -->
    <div class="col-md-5">
      <div class="card bg-danger text-center m-3" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Total Rooms</h5>
          <h1 class="card-text">{{$total_units}}</h1>
          <a href="/rooms/index" class="block-anchor panel-footer text-center text-white">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    <!-- </div>
     Second card 
    <div class="col-md-5"> -->
      <div class="card bg-success text-center m-3" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title ">Total Registered Users</h5>
          <h1 class="card-text ">{{$total_users}}</h1>
          <a href="/users/index" class="block-anchor panel-footer text-center text-white">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
    <!-- Chart container -->
    <div class="col-md-7">
      <div id="chartContainer" style="width: 100%;"></div>
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
@endsection
