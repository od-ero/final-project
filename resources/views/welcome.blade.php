<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unikey</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        body{
            font-family: "Segoe UI",sans-serif;
            background:#f4f7fb;
            overflow-x:hidden;
        }

        .hero{

            min-height:100vh;
            display:flex;
            align-items:center;
            background:
            radial-gradient(circle at top left,#0d6efd 0,#071a45 55%,#010818 100%);
            color:white;
            position:relative;
        }

        .hero::after{
            content:'';
            position:absolute;
            right:-120px;
            top:-120px;
            width:450px;
            height:450px;
            background:rgba(255,255,255,.06);
            border-radius:50%;
        }

        .hero h1{
            font-size:4rem;
            font-weight:700;
        }

        .hero p{
            font-size:1.25rem;
            opacity:.9;
        }

        .btn-main{
            padding:15px 35px;
            border-radius:50px;
            font-weight:bold;
        }

        .phone{

            background:white;
            border-radius:30px;
            padding:25px;
            box-shadow:0 30px 60px rgba(0,0,0,.25);

        }

        .lock-card{

            border:none;
            border-radius:20px;
            transition:.3s;
            box-shadow:0 10px 25px rgba(0,0,0,.08);

        }

        .lock-card:hover{

            transform:translateY(-8px);

        }

        .icon-box{

            width:70px;
            height:70px;
            display:flex;
            justify-content:center;
            align-items:center;
            border-radius:20px;
            background:#0d6efd;
            color:white;
            font-size:30px;

        }

        .section-title{

            font-size:40px;
            font-weight:bold;

        }

        .feature{

            padding:30px;

        }

        .timeline{

            background:white;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,.08);

        }

        footer{

            background:#08182f;
            color:#ddd;

        }

    </style>

</head>

<body>


<section class="hero">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<span class="badge bg-primary px-3 py-2 mb-3">
Enterprise Access Control
</span>

<h1>
Secure Every Door.<br>
Control Every Access.
</h1>

<p class="mt-4">

A centralized electronic lock platform that lets you remotely unlock units,
manage user permissions, create access schedules,
and monitor every activity in real time.

</p>

<div class="mt-5">

<a href="/login" class="btn btn-light btn-lg btn-main">
Get Started
</a>

<a href="#features" class="btn btn-outline-light btn-lg btn-main ms-3">
Learn More
</a>

</div>

</div>

<div class="col-lg-6">

<div class="phone">

<div class="d-flex justify-content-between">

<h5>Building A</h5>

<span class="badge bg-success">
Online
</span>

</div>

<hr>

<div class="list-group">

<div class="list-group-item d-flex justify-content-between">

Reception

<button class="btn btn-success">
<i class="bi bi-unlock"></i>
Unlock
</button>

</div>

<div class="list-group-item d-flex justify-content-between">

Server Room

<button class="btn btn-danger">
Locked
</button>

</div>

<div class="list-group-item d-flex justify-content-between">

Finance

<button class="btn btn-primary">
Scheduled
</button>

</div>

</div>

<div class="mt-4">

<div class="alert alert-info">

<i class="bi bi-calendar-check"></i>

Next Scheduled Access

<strong>08:00 AM - 05:00 PM</strong>

</div>

</div>

</div>

</div>

</div>

</div>

</section>


<section class="py-5 bg-light" id="features">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

Everything Needed To Secure Your Premises

</h2>

<p class="text-muted">

Built for offices, apartments, schools,
banks and enterprise facilities.

</p>

</div>

<div class="row g-4">

<div class="col-md-4">

<div class="lock-card feature">

<div class="icon-box mb-4">

<i class="bi bi-door-open"></i>

</div>

<h4>Remote Unlock</h4>

<p>

Open any authorized door instantly with one click
from anywhere.

</p>

</div>

</div>

<div class="col-md-4">

<div class="lock-card feature">

<div class="icon-box mb-4">

<i class="bi bi-clock-history"></i>

</div>

<h4>Access Scheduling</h4>

<p>

Allow users to access selected units only during
approved days and time periods.

</p>

</div>

</div>

<div class="col-md-4">

<div class="lock-card feature">

<div class="icon-box mb-4">

<i class="bi bi-shield-lock"></i>

</div>

<h4>Permission Control</h4>

<p>

Assign doors to departments,
roles or individual users.

</p>

</div>

</div>

<div class="col-md-4">

<div class="lock-card feature">

<div class="icon-box mb-4">

<i class="bi bi-building"></i>

</div>

<h4>Multi Building Support</h4>

<p>

Manage hundreds of buildings,
floors and units from one dashboard.

</p>

</div>

</div>

<div class="col-md-4">

<div class="lock-card feature">

<div class="icon-box mb-4">

<i class="bi bi-graph-up-arrow"></i>

</div>

<h4>Audit Logs</h4>

<p>

Track every unlock attempt,
user login and permission change.

</p>

</div>

</div>

<div class="col-md-4">

<div class="lock-card feature">

<div class="icon-box mb-4">

<i class="bi bi-phone"></i>

</div>

<h4>Responsive</h4>

<p>

Access your system from desktop,
tablet or mobile devices.

</p>

</div>

</div>

</div>

</div>

</section>


<section class="py-5">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<h2 class="section-title">

Smart Access Scheduling

</h2>

<p class="text-muted">

Create schedules that automatically determine when a user
is allowed to access specific units. Permissions activate
and expire without manual intervention.

</p>

<ul class="list-group timeline">

<li class="list-group-item">
✔ Monday–Friday Office Access
</li>

<li class="list-group-item">
✔ Weekend Restrictions
</li>

<li class="list-group-item">
✔ Holiday Overrides
</li>

<li class="list-group-item">
✔ Automatic Expiry
</li>

<li class="list-group-item">
✔ Emergency Unlock Options
</li>

</ul>

</div>

<div class="col-lg-6 text-center">

<i class="bi bi-calendar2-week-fill"
style="font-size:250px;color:#0d6efd;"></i>

</div>

</div>

</div>

</section>


<section class="py-5 text-center text-white"
style="background:#0d6efd;">

<div class="container">

<h2>

Ready To Modernize Your Access Control?

</h2>

<p>

Secure your buildings, simplify access management,
and monitor everything from one platform.

</p>

<a href="/login" class="btn btn-light btn-lg mt-3">

Launch Dashboard

</a>

</div>

</section>


<footer class="py-4">

<div class="container">

<div class="row">

<div class="col-md-6">

<h5>Unikey</h5>

<p>

Enterprise Electronic Lock & Access Management Platform

</p>

</div>

<div class="col-md-6 text-md-end">

© {{ date('Y') }}

All Rights Reserved.

</div>

</div>

</div>

</footer>

</body>
</html>