@extends('adminstration::layouts.admin_master')
@section('subtitle')
   Login
@endsection

@section('contentheader_title')
   Login
@endsection

@section('content')
<div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Unikey Admin Login</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="{{ route('adminLogin.perform') }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="login_identifier" value="{{ old('login_identifier') }}" required/>
                                                <label for="inputEmail">Email address</label>
                                                @if ($errors->has('login_identifier'))
                                                    <span class="text-danger text-left">{{ $errors->first('login_identifier') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" value="{{ old('password') }}" required/>
                                                <label for="inputPassword">Password</label>
                                                @if ($errors->has('password'))
                                                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <!-- <a class="small" href="password.html">Forgot Password?</a> -->
                                                <button class=" btn btn-lg btn-primary" type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; {{ENV('APP_NAME')}} {{date('Y')}}</div>
                            <!-- <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div> -->
                        </div>
                    </div>
                </footer>
            </div>
        </div>
 @endsection      