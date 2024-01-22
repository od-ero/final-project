<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <style>
#units {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#units td, #units th {
  border: 1px solid #ddd;
  padding: 8px;
}

#units tr:nth-child(even){background-color: #f2f2f2;}

#units tr:hover {background-color: #ddd;}

#units th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

 
  /* You can add more specific styling for each button if needed */


.button {
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  border-radius: 10px;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  margin-right: 2%;
  transition-duration: 0.4s;
  cursor: pointer;
 
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #04AA6D;
}

.button1:hover {
  background-color: #04AA6D;
  color: white;
}

.button2 {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
}

.button2:hover {
  background-color: #008CBA;
  color: white;
}


</style>
</head>

<body>


<p>Welcome to {{$unit['premises_name'] . ', ' . $unit['unit_name']}} </p>

<div><button class="button button1">
    <a href="/units/create" style="text-decoration: none; color: inherit;">
       Add Unit
    </a>
</button>
 <button  class="button button1"> <a href="/units/create"> /units/create</a> Give Access</button>  <button  class="button button1"> Activate Button Access</button> <button  class="button button1"> View</button></div>

<table id="units">
    <tr>
        <th style="width:5%">ID</th>
        
        <th>Door</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php
    
    

    foreach ($myUnits as $key => $myUnit) {
      
        // Rest of your code for processing each $myUnit goes here
        // For example, you need to get $role_name, $start_date, and $end_date from $myUnit

        // Output the table row for each $myUnit
        ?>
       <tr>
    <td style="width:5%"><?= ++$key ?></td>
    <td><?= $myUnit['door_name'] ?></td>
    <td><?= $myUnit['status']  ?></td>
    <td>
    <?php
    // Assuming $myUnit['status'] contains the initial status from the database
    $initialStatus = $myUnit['status'];
    ?>

<button class="button button1" style="background-color: <?php echo ($initialStatus === 'close') ? 'green' : 'red'; ?>; color: white;">
    <a href="/home/myunits/action/<?php echo base64_encode($myUnit['id']); ?>" style="text-decoration: none; color: inherit;">
        <?php echo ($initialStatus === 'close') ? 'Open' : 'Close'; ?>
    </a>
</button>

  
</td>
   
</tr>

        <?php
    }
    ?>
</table>
<script>
     function populateOptions() {
        var dropdown = document.getElementById('statusDropdown');
        var initialStatus = '<?php echo $initialStatus; ?>';

        // Remove existing options
        while (dropdown.options.length > 0) {
            dropdown.remove(0);
        }

        // Add new options
        var openOption = document.createElement('option');
        openOption.value = 'open';
        openOption.text = 'Open';
        openOption.selected = (initialStatus === 'open');
        dropdown.add(openOption);

        var closeOption = document.createElement('option');
        closeOption.value = 'close';
        closeOption.text = 'Close';
        closeOption.selected = (initialStatus === 'close');
        dropdown.add(closeOption);
    }

    function redirectToView(id) {
    // Add logic to construct the URL based on the provided id
    var url = '/home/myunits/action/' + id;

    // Redirect to the constructed URL
    window.location.href = url;
}
</script>
</body>

</html>