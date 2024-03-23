<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">
    <title>Unikey Admin -@yield('subtitle')</title>
    <link rel="icon" href="{{ asset('images/unikey.png') }}" type="image/x-icon">
  

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Vite CSS --}}
    {{-- {{ module_vite('build-adminstration', 'resources/assets/sass/app.scss') }} --}}
</head>

<body>
@section('scripts')
    @include('adminstration::layouts.partials.scripts')
@show
   
    <div >
    <div class="wrapper" style=" background-color: transparent">

    @include('adminstration::layouts.partials.sidebar')
   
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include('adminstration::layouts.partials.contentheader')
       
        <!-- Main content -->
        <section class="content bg-light p-md-5 p-sm-1 rounded">
            <!-- Your Page Content Here -->
            @yield('content')
           
           
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


    @include('adminstration::layouts.partials.footer')
    </div>
</div>
<div id="loading_spinner" style="position:fixed; top: 0; left:0; justify-content: center; display: none; background-color: rgb(0,0,0, 0.35);z-index: 9999; align-items: center; width: 100vw; height: 100vh">
    <div  class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>

    {{-- Vite JS --}}
    {{-- {{ module_vite('build-adminstration', 'resources/assets/js/app.js') }} --}}
</body>
