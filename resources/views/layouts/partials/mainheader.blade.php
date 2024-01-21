<!-- Main Header -->
<header class="main-header" style="background-color:transparent">

    <!-- Logo -->
    <a style="background-color: #9ED939;  position: fixed;" href="{{ route('employee.dashboard') }}"  class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span style="color: darkslategray; font-family: 'Julius Sans One', Sans-Serif;" >HR101</span> <span style="color: white;font-family: 'Julius Sans One', Sans-Serif;"> | {{\App\Models\Organization::find(Sentinel::getUser()->organization_id)->name}}</span>

    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color:transparent; color: black">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle  menu-open-button" style="font-size: 18px;padding: 8px 13px;"
           data-toggle="offcanvas">


            {{--<span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>--}}
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu" >
            <ul class="nav navbar-nav dashboard-menu" style="background-color:transparent">
                <li >
                    <div style="width:276px;">
                        <form action="#" method="get" class="topbar-form ">
{{--                             <div class="input-group">
                                <input type="text" name="q" class="form-control"
                                       placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
                                <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div> --}}
                        </form>
                        <!-- Menu toggle button -->

                    </div>


                </li><!-- /.messages-menu -->

                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">0</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have no new messages</li>
                        <li>
                            <ul class="menu">
                            </ul><!-- /.menu -->
                        </li>
                    </ul>
                </li>
                @php
                    $notifications=\App\Models\Notification::where([
                        'user_id'=> \Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->id,
                        'status'=>'UNREAD'])->get();
                @endphp

                <li class="dropdown notifications-menu {{$notifications->count()>0?'wobble-timed':''}}">


                <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">{{$notifications->count()}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{ $notifications->count()}} unread notifications</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->

                            <ul class="menu">
                                @foreach($notifications as $notification)
                                    <li><!-- start message -->
                                        <a href="#" onclick="@php $notification->status='READ';$notification->save()@endphp">
                                            <div class="pull-left">
                                                <!-- User Image -->
                                @if(empty($user->profile_pic))
                                <img width="10px" src=" {{ asset('img/avatar2.png') }}" class="img-circle" alt="User Image"/>
                                @else
                                 <img width="10px" src="{{ asset('profile-pics/'.$user->profile_pic) }}" class="img-circle" alt="User Image"/>
                                 @endif
                                                
                                            </div>
                                            <!-- Message title and timestamp -->
                                            <h6>
                                                {{$notification->title}}
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h6>
                                            <!-- The message -->
                                            <p>{{ $notification->message}}</p>
                                        </a>
                                    </li><!-- end message -->
                                @endforeach
                            </ul><!-- /.menu -->
                        </li>
                        {{--<li class="footer"><a href="#">{{ trans('adminlte_lang::message.viewall') }}</a></li>--}}
                    </ul>
                </li>
                <!-- Tasks Menu -->
                <li class="dropdown tasks-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">0</span>
                    </a>

                </li>
                @if ($user=Sentinel::check())
                    <li class="dropdown user user-menu" id="user_menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->

                                @if(empty($user->profile_pic))
                                    <img src=" {{ asset('img/avatar2.png') }}" class="user-image" alt="User Image"/>
                                @else
                                     <img src="{{ asset('profile-pics/'.$user->profile_pic) }}" 
                                     class="user-image" alt="User Image"/>
                                 @endif
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ $user->first_name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu --> 
                              
                            <li class="user-header">
                                <p>
                                   <small>change profile pic</small>  
                                </p>
                                @if(empty($user->profile_pic))
                                <img src=" {{ asset('img/avatar2.png') }}" class="img-circle" alt="User Image"/>
                                @else
                                 <img src="{{ asset('profile-pics/'.$user->profile_pic) }}" class="img-circle" alt="User Image"/>
                                 @endif
                                <form id="userprofile" 
                                action="{{route('employee.upload.profile.image')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                    <input type="file" name="upload_image" class="inputfile" 
                                        style="opacity:0;position: absolute;left: 77px;top: 43px;
                                        padding: 18px;background-color: #123;width: 124px;
                                        border: 3px solid #fff;height: 109px;padding-left: 15px;
                                        padding-top: 82px;cursor: pointer;"
                                        onmouseenter="this.style.opacity=0.1;" 
                                        onmouseleave="this.style.opacity=0;" accept="image/*"
                                        onchange=" 
                                        if (!this.value) {
                                          alert('You Selected no Picture!');  
                                        }else{
                                            alert('Uploading Pic....');
                                            document.getElementById('userprofile').submit();
                                        }

                                        ">
                                </form>


                                <p>
                                    
                                    <small>{{ $user->first_name }}  {{ $user->last_name }} </small>
                                </p><br>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
{{--                                 <div class="pull-left">
                                    <a href="{{ url('/user/profile') }}"
                                       class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
                                </div> --}}
                                <div class="pull-right">
                                    <a href="{{ route('employee.logout') }}" class="btn btn-default btn-flat" id="logout"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ trans('adminlte_lang::message.signout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="submit" value="logout" style="display: none;">
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
            @else
                <!-- User Account Menu -->

            @endif

            <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="{{route('employee.profile')}}" ><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>