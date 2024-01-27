@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('register.perform') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <img class="mb-4" src="{!! url('images/unikey.png') !!}" alt="" width="72" height="57">
        
        <h1 class="h3 mb-3 fw-normal">Register</h1>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="fname" value="{{ old('fname') }}" placeholder="First Name" required="required" autofocus>
            <label for="floatingEmail">First Name</label>
            @if ($errors->has('fname'))
                <span class="text-danger text-left">{{ $errors->first('fname') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="lname" value="{{ old('lname') }}" placeholder="Last Name" required="required" autofocus>
            <label for="floatingEmail">Last Name</label>
            @if ($errors->has('lname'))
                <span class="text-danger text-left">{{ $errors->first('lname') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="tel" class="form-control" name="phone" value="{{ old('email') }}" placeholder="0798765432" required="required" autofocus>
            <label for="floatingEmail">Phone Number</label>
            @if ($errors->has('phone'))
                <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
            @endif
        </div>
        <div class="form-group form-floating mb-3">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com" required="required" autofocus>
            <label for="floatingEmail">Email address</label>
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
            <label for="floatingConfirmPassword">Confirm Password</label>
            @if ($errors->has('password_confirmation'))
                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        <div class="form-group form-floating mb-3">
        <br>  <p>Already have an account?<a href="/login">login</a></p>
        </div>

      
        
        @include('auth.partials.copy')
    </form>
@endsection
