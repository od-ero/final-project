

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Evans Odero">
    <meta name="generator" content="Hugo 0.87.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Unikey-@yield('subtitle') </title>
    <link rel="icon" href="{{ asset('images/unikey.png') }}" type="image/x-icon">

    
   <!-- Bootstrap CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">


<!-- Your custom CSS -->
<link href="{!! url('assets/css/all.css') !!}" rel="stylesheet" type="text/css">

  
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{!! url('assets/css/app.css') !!}" rel="stylesheet">
</head>

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="skin-blue sidebar-mini">
@section('scripts')
    @include('layouts.partials.scripts')
@show
<div >
    <div class="wrapper" style=" background-color: transparent">

    @include('layouts.partials.navbar')
   
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include('layouts.partials.contentheader')
       
        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
           
           
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


    @include('layouts.partials.footer')
    </div>
</div>
<div id="loading_spinner" style="position:fixed; top: 0; left:0; justify-content: center; display: none; background-color: rgb(0,0,0, 0.35);z-index: 9999; align-items: center; width: 100vw; height: 100vh">
    <div  class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>







</body>
</html>