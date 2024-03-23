<!DOCTYPE HTML>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
window.onload = function () {
    // Function to fetch data from Laravel backend
    function fetchData() {
        $.ajax({
            url: '/chat/data', // Replace 'your-backend-url' with your Laravel backend endpoint
            type: 'GET',
            success: function(response) {
                // Parse response and populate dataPoints arrays
                var dataPointsButter = [];
                var dataPointsFlour = [];
                var dataPointsMilk = [];
                var dataPointsEggs = [];

                response.forEach(function(item) {
                    dataPointsButter.push({ y: item.cost_of_butter, label: item.country });
                    dataPointsFlour.push({ y: item.cost_of_flour, label: item.country });
                    dataPointsMilk.push({ y: item.cost_of_milk, label: item.country });
                    dataPointsEggs.push({ y: item.cost_of_eggs, label: item.country });
                });

                var options = {
                    animationEnabled: true,
                    theme: "light2",
                    title:{
                        text: "Cost Of Pancake Ingredients"
                    },
                    axisY2: {
                        prefix: "$",
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
                        name: "Butter (500gms)",
                        color: "#7E8F74",
                        axisYType: "secondary",
                        dataPoints: dataPointsButter
                    }, {
                        type: "stackedBar",
                        showInLegend: true,
                        name: "Flour (1kg)",
                        color: "#F0D6A7",
                        axisYType: "secondary",
                        dataPoints: dataPointsFlour
                    }, {
                        type: "stackedBar",
                        showInLegend: true,
                        name: "Milk (2l)",
                        color: "#EBB88A",
                        axisYType: "secondary",
                        dataPoints: dataPointsMilk
                    }, {
                        type: "stackedBar",
                        showInLegend: true,
                        name: "Eggs (20)",
                        color:"#DB9079",
                        indexLabel: "$#total",
                        axisYType: "secondary",
                        dataPoints: dataPointsEggs
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
</head>
<body>
<div id="chartContainer" style="width: 50%; "></div>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
</body>
</html>
