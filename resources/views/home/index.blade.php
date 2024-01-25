@extends('layouts.app-master')
@section('subtitle')
   Dashboard
@endsection

@section('contentheader_title')
  Dashboard
@endsection
@section('content')


    <div class="bg-light p-5 rounded">
        @auth
    

    

<legend>Dashboard</legend>

<p>My Units</p>
<table id="units">
    <tr>
        <th style="width:5%">ID</th>
        <th style="width:35%">Name</th>
        <th>Role</th>
        <th>Start Date</th>
        <th>End Date</th>
    </tr>

    <?php
    
    

    foreach ($myUnits as $key => $myUnit) {
      
        // Rest of your code for processing each $myUnit goes here
        // For example, you need to get $role_name, $start_date, and $end_date from $myUnit

        // Output the table row for each $myUnit
        ?>
       <tr>
    <td style="width:5%"><a href="/selected/unit/<?= base64_encode($myUnit['id']) ?>"><?= ++$key ?></a></td>
    <td style="width:35%"><a href="/selected/unit/<?=  base64_encode($myUnit['id']) ?>"><?= $myUnit['premises_name'] . ', ' . $myUnit['unit_name'] ?></a></td>
    <td><a href="/selected/unit/<?= base64_encode($myUnit['id']) ?>"><?= $myUnit['role_name'] ?></a></td>
    <td><a href="/selected/unit/<?= base64_encode($myUnit['id']) ?>"><?= $myUnit['start_date'] ?></a></td>
    <td><a href="/selected/unit/<?= base64_encode($myUnit['id']) ?>"><?= $myUnit['end_date'] ?></a></td>
</tr>

        <?php
    }
    ?>
</table>


 
</body>
</html>
        @endauth

        @guest
        <h1>Unikey</h1>
        <p class="lead">Your Premise at your pocket.</p>
        @endguest
    </div>
@endsection
