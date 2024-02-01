@extends('layouts.auth-master')
@section('subtitle')
Login
@endsection
@section('content')
    <form method="post" action="{{ route('login.perform') }}">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <img class="mb-4" src="{!! url('images/unikey.png') !!}" alt="" width="72" height="57">
        
        <h1 class="h3 mb-3 fw-normal">Login</h1>

        @include('layouts.partials.messages')

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="login_identifier" value="{{ old('login_identifier') }}" placeholder="Email or Phone Number" required="required" autofocus>
            <label for="floatingInput">Email or Phone Number</label>
            @if ($errors->has('login_identifier'))
                <span class="text-danger text-left">{{ $errors->first('login_identifier') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group mb-3">
            <label for="remember">Remember me</label>
            <input type="checkbox" name="remember" value="1">
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        <div class="form-group mb-3">
        <br> <p>Don't have an account? <a href="register">Register</p>
        </div>

       
        
        @include('auth.partials.copy')
    </form>
@endsection
