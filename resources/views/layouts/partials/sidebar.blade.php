<!-- Left side column. contains the logo and sidebar -->
@php
    use Illuminate\Support\Facades\DB;
@endphp
<?php
$supervisee = \App\Models\Employment::where('supervisor_id', Sentinel::getUser()->employee_id)
    ->orWhereExists(function ($query) {
        $query->select(DB::raw(1))
            ->from('workflow_approvals')
            ->whereRaw('workflow_approvals.send_to = ' . Sentinel::getUser()->employee_id);
    })
    ->exists();
      $employeeTypeCasual = \App\Models\Employee::where('employee_type', 'CASUAL')
    ->where('id', Sentinel::getUser()->employee_id)
    ->exists();
   // dd($employeeType);
?>

<aside class="main-sidebar sidebar-overlay" style="position: fixed;background-image: url({{asset('img/sidebar_bg.jpg')}})">
    <hr style="margin:10px 5px 5px 20px; position: relative; ">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            @if ($user=Sentinel::check())
                <div class="user-panel" style="margin-left: 10px;">
                    <div class="pull-left image">
                        @if(empty($user->profile_pic))
                            <img src=" {{ asset('img/avatar2.png') }}" class="img-circle" alt="Your Logo"/>
                        @else
                             <img src="{{ asset('profile-pics/'. $user->profile_pic) }}" class="img-circle" alt="Your Logo"/>
                         @endif
                    </div>
                    <div class="pull-left info" style="margin: -10px;">
                        <p><a href="{{route('employee.profile')}}" style="color: white!important;">{{ $user->first_name }}</a></p>
                        <a href="{{route('employee.profile')}}" style=" color: white!important; font-size: 14px"> <span>Self Help Portal</span></a>
                    </div>
                </div>
            @endif<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar sidebar-overlay" style="position: fixed;background-image: url({{asset('img/sidebar_bg.jpg')}})">
    <hr style="margin:10px 5px 5px 20px; position: relative; ">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            @if ($user=Sentinel::check())
            <div class="user-panel">
                <div class="info text-center" style="margin: -10px;">
                    <p>
                        {{\App\Models\Organization::find(Sentinel::getUser()->organization_id)->name}}
                    </p>
                </div>
            </div>
            @endif
            <hr style="margin:10px 5px 5px 20px; position: relative; ">

            <!-- search form (Optional) -->

            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">

                <!-- Optionally, you can add icons to the links -->
                <li class="{{Route::current()->getName() == 'dashboard'?'active':''}}"><a href="{{ route('employee.dashboard') }}"><i class='ti-dashboard'></i> <span>Dashboard</span></a></li>
                {{-- <li><a href="{{route('employee.profile')}}" ><i class='ti-user'></i> <span>Profile</span></a></li> --}}


                <li class="{{Route::current()->getName() == 'leaves_history' || Route::current()->getName() == 'leaves_applications'?'active treeview':'treeview'}}">
                    <a  onclick="$('#showitems2').slideToggle();"  href="#"><i class='fa fa-calendar-check-o'></i> <span>Leave Management</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems2'>
                        <li><a href="{{route('leaves_applications') }}"><i class='fa fa-plus'></i> <span>Leave Applications</span></a></li>
                        <li><a href="{{route('leaves_history') }}"><i class='fa fa-plus'></i> <span>Leave History</span></a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a  onclick="$('#showitems3').slideToggle();"  href="#"><i class='ti-ink-pen'></i> <span>Performance Reviews</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems3'>
                        <li><a href="{{route('upcomingReviews') }}"><i class='fa fa-plus'></i> <span>Upcoming Reviews</span></a></li>
                        <li><a href="{{route('employeePast_reviews') }}"><i class='fa fa-plus'></i> <span>Past Reviews</span></a></li>
                    </ul>
                </li>

                <li class="treeview"  @if ($supervisee) style="display: block;" @else style="display: none;" @endif>
                    <a  onclick="$('#showitems5').slideToggle();"  href="#"><i class='ti-direction-alt'></i> <span>Performance Apprisals</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems5'>
                        <li><a href="{{route('myApprisals') }}"><i class='fa fa-plus'></i> <span>Apprisals</span></a></li>
                    </ul>
                </li>

                <li class="{{Route::current()->getName() == 'my_attendance' || Route::current()->getName() == 'my_overtime'?'active treeview':'treeview'}}">
                    <a  onclick="$('#showitems4').slideToggle();"  href="#"><i class='fa fa-history'></i> <span>Time & Attendance</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems4'>
                        <li><a href="{{route('my_attendance') }}"><i class='fa fa-plus'></i> <span>My Attendance</span></a></li>
                    </ul>
                </li>

                {{-- <li class="treeview">
                    <a  onclick="$('#showitems5').slideToggle();"  href="#"><i class='ti-direction-alt'></i> <span>Applications</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems5'>
                        <li><a href="{{route('employee.workflows.overtime.index') }}"><i class='fa fa-plus'></i> <span>Requisitions</span></a></li>
                        <li><a href="{{route('employee.workflows.overtime.index') }}"><i class='fa fa-plus'></i> <span>Separations</span></a></li>
                        <li><a href="{{route('employee.workflows.overtime.index') }}"><i class='fa fa-plus'></i> <span>Salary Advance</span></a></li>
                    </ul>
                </li> --}}

                <li class="treeview">
                    <a  onclick="$('#showitems6').slideToggle();"  href="#"><i class='fa fa-calendar'></i> <span>Payroll</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems6'>
                        <li><a href="{{route('viewMypayslip') }}"><i class='fa fa-plus'></i> <span>Payslips</span></a></li>
                        <li><a href="{{route('p9') }}"><i class='fa fa-plus'></i> <span>P9</span></a></li>
                        <li @if ( $employeeTypeCasual) style="display: none;" @else style="display: block;" @endif ><a href="{{route('employeeSalaryAdvance') }}"><i class='fa fa-plus'></i> <span>Salary Advance</span></a></li>
                    </ul>
                </li>

               
    <!-- Content of the division -->


                <li class="treeview" @if ($supervisee) style="display: block;" @else style="display: none;" @endif>
                    <a  onclick="$('#showitems7').slideToggle();"  href="#"><i class='fa fa-newspaper-o'></i> <span>Approval Requests</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems7'>
                        <li><a href="{{route('approvals.leaves.request') }}"><i class='fa fa-plus'></i> <span>Leave Approvals</span></a></li>
                        <li><a href="{{route('my_attendance_approval_requests') }}"><i class='fa fa-plus'></i> <span>Attendance Approvals</span></a></li>
                        <li><a href="/salary_advance/approvals/requests"><i class='fa fa-plus'></i> <span>Salary Advance Approval</span></a></li>
                        {{-- <li><a href="{{route('employee.workflows.overtime.index') }}"><i class='fa fa-plus'></i> <span>P9</span></a></li> --}}
                    </ul>
                </li>

                {{-- <li class="treeview">
                    <a onclick="$('#showitems').slideToggle();" href="#"><i class='ti-ink-pen'></i> <span>Tasks</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems'>

                        @if(Sentinel::getUser()->hasAccess(['workflow.approve', 'workflow.view', 'workflow.update']))
                        <li><a href="{{route('employee.approvals.leaves.index') }}"><i class='fa fa-qrcode'></i> <span>Leave Approvals</span></a></li>
                        @endif
                            @if(Sentinel::getUser()->hasAccess(['overtime.*']))
                            <li><a href="{{route('employee.tasks.overtime.index') }}"><i class='fa fa-plus'></i> <span>Overtimes</span></a></li>


                        @endif
                            @if(Sentinel::getUser()->hasAccess(['requisition.approve']))
                                <li><a href="{{route('employee.tasks.requisition.index') }}"><i class='fa fa-paper-plane'></i> <span>Requisition Approvals</span></a></li>
                        @endif
                            @if(Sentinel::getUser()->hasAccess(['separation.approve']))
                                <li><a href="{{route('employee.separation.index') }}"><i class='fa fa-user-times'></i> <span>Separation Tasks</span></a></li>
                            @endif
                            @if(Sentinel::getUser()->hasAccess(['separation.approve']))
                                <li><a href="{{route('employee.performance.review.index') }}"><i class='fa fa-plus'></i> <span>Performance Review</span></a></li>
                            @endif


                            <li><a href="{{ route('workflows.index') }}"><i class='fa fa-list'></i> <span>All Divisions</span></a></li>
                    </ul>
                </li> --}}

                {{--<li class="treeview">--}}
                    {{--<a href="#"><i class='ti-layout-grid3-alt'></i> <span>Departments</span><i class="fa fa-angle-left pull-right"></i></a>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--<li><a href="{{route('departments.add') }}"><i class='fa fa-plus'></i> <span>Add Department</span></a></li>--}}
                        {{--<li><a href="{{ route('departments.index') }}"><i class='fa fa-list'></i> <span>All Departments</span></a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="treeview">--}}
                    {{--<a href="#"><i class='ti-layout-grid4-alt'></i> <span>Sections</span><i class="fa fa-angle-left pull-right"></i></a>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--<li><a href="{{route('sections.add') }}"><i class='fa fa-plus'></i> <span>Add Section</span></a></li>--}}
                        {{--<li><a href="{{ route('sections.index') }}"><i class='fa fa-list'></i> <span>All Section</span></a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
            <hr style="margin:10px 5px 5px 20px; position: relative; ">

            <!-- search form (Optional) -->

            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">

                <!-- Optionally, you can add icons to the links -->
                <li class="{{Route::current()->getName() == 'dashboard'?'active':''}}"><a href="{{ route('employee.dashboard') }}"><i class='ti-dashboard'></i> <span>Dashboard</span></a></li>
                {{-- <li><a href="{{route('employee.profile')}}" ><i class='ti-user'></i> <span>Profile</span></a></li> --}}


                <li class="{{Route::current()->getName() == 'leaves_history' || Route::current()->getName() == 'leaves_applications'?'active treeview':'treeview'}}">
                    <a  onclick="$('#showitems2').slideToggle();"  href="#"><i class='fa fa-calendar-check-o'></i> <span>Leave Management</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems2'>
                        <li><a href="{{route('leaves_applications') }}"><i class='fa fa-plus'></i> <span>Leave Applications</span></a></li>
                        <li><a href="{{route('leaves_history') }}"><i class='fa fa-plus'></i> <span>Leave History</span></a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a  onclick="$('#showitems3').slideToggle();"  href="#"><i class='ti-ink-pen'></i> <span>Performance Reviews</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems3'>
                        <li><a href="{{route('employee.workflows.overtime.index') }}"><i class='fa fa-plus'></i> <span>Upcoming Reviews</span></a></li>
                        <li><a href="{{route('employee.workflows.overtime.index') }}"><i class='fa fa-plus'></i> <span>Past Reviews</span></a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a  onclick="$('#showitems5').slideToggle();"  href="#"><i class='ti-direction-alt'></i> <span>Performance Apprisals</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems5'>
                        <li><a href="{{route('myApprisals') }}"><i class='fa fa-plus'></i> <span>Apprisals</span></a></li>
                    </ul>
                </li>

                <li class="{{Route::current()->getName() == 'my_attendance' || Route::current()->getName() == 'my_overtime'?'active treeview':'treeview'}}">
                    <a  onclick="$('#showitems4').slideToggle();"  href="#"><i class='fa fa-history'></i> <span>Time & Attendance</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems4'>
                        <li><a href="{{route('my_attendance') }}"><i class='fa fa-plus'></i> <span>My Attendance</span></a></li>
                    </ul>
                </li>

                {{-- <li class="treeview">
                    <a  onclick="$('#showitems5').slideToggle();"  href="#"><i class='ti-direction-alt'></i> <span>Applications</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems5'>
                        <li><a href="{{route('employee.workflows.overtime.index') }}"><i class='fa fa-plus'></i> <span>Requisitions</span></a></li>
                        <li><a href="{{route('employee.workflows.overtime.index') }}"><i class='fa fa-plus'></i> <span>Separations</span></a></li>
                        <li><a href="{{route('employee.workflows.overtime.index') }}"><i class='fa fa-plus'></i> <span>Salary Advance</span></a></li>
                    </ul>
                </li> --}}

                <li class="treeview">
                    <a  onclick="$('#showitems6').slideToggle();"  href="#"><i class='fa fa-calendar'></i> <span>Payroll</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems6'>
                        <li><a href="{{route('viewMypayslip') }}"><i class='fa fa-plus'></i> <span>Payslips</span></a></li>
                        <li><a href="{{route('p9') }}"><i class='fa fa-plus'></i> <span>P9</span></a></li>
                      {{--<li><a href="{{route('employeeSalaryAdvance') }}"><i class='fa fa-plus'></i> <span>Salary Advance</span></a></li>-->--}}
                    </ul>
                </li>

                <li class="treeview">
                    <a  onclick="$('#showitems7').slideToggle();"  href="#"><i class='fa fa-newspaper-o'></i> <span>Approval Requests</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems7'>
                        <li><a href="{{route('employee.workflows.overtime.index') }}"><i class='fa fa-plus'></i> <span>Leave Approvals</span></a></li>
                        <li><a href="{{route('employee.workflows.overtime.index') }}"><i class='fa fa-plus'></i> <span>Attendance Approvals</span></a></li>
                        <li><a href="{{route('employee.workflows.overtime.index') }}"><i class='fa fa-plus'></i> <span>Overtime</span></a></li>
                        {{-- <li><a href="{{route('employee.workflows.overtime.index') }}"><i class='fa fa-plus'></i> <span>P9</span></a></li> --}}
                    </ul>
                </li>
                {{-- <li class="treeview">
                    <a onclick="$('#showitems').slideToggle();" href="#"><i class='ti-ink-pen'></i> <span>Tasks</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu" id='showitems'>

                        @if(Sentinel::getUser()->hasAccess(['workflow.approve', 'workflow.view', 'workflow.update']))
                        <li><a href="{{route('employee.approvals.leaves.index') }}"><i class='fa fa-qrcode'></i> <span>Leave Approvals</span></a></li>
                        @endif
                            @if(Sentinel::getUser()->hasAccess(['overtime.*']))
                            <li><a href="{{route('employee.tasks.overtime.index') }}"><i class='fa fa-plus'></i> <span>Overtimes</span></a></li>


                        @endif
                            @if(Sentinel::getUser()->hasAccess(['requisition.approve']))
                                <li><a href="{{route('employee.tasks.requisition.index') }}"><i class='fa fa-paper-plane'></i> <span>Requisition Approvals</span></a></li>
                        @endif
                            @if(Sentinel::getUser()->hasAccess(['separation.approve']))
                                <li><a href="{{route('employee.separation.index') }}"><i class='fa fa-user-times'></i> <span>Separation Tasks</span></a></li>
                            @endif
                            @if(Sentinel::getUser()->hasAccess(['separation.approve']))
                                <li><a href="{{route('employee.performance.review.index') }}"><i class='fa fa-plus'></i> <span>Performance Review</span></a></li>
                            @endif


                            <li><a href="{{ route('workflows.index') }}"><i class='fa fa-list'></i> <span>All Divisions</span></a></li>
                    </ul>
                </li> --}}

                {{--<li class="treeview">--}}
                    {{--<a href="#"><i class='ti-layout-grid3-alt'></i> <span>Departments</span><i class="fa fa-angle-left pull-right"></i></a>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--<li><a href="{{route('departments.add') }}"><i class='fa fa-plus'></i> <span>Add Department</span></a></li>--}}
                        {{--<li><a href="{{ route('departments.index') }}"><i class='fa fa-list'></i> <span>All Departments</span></a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="treeview">--}}
                    {{--<a href="#"><i class='ti-layout-grid4-alt'></i> <span>Sections</span><i class="fa fa-angle-left pull-right"></i></a>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--<li><a href="{{route('sections.add') }}"><i class='fa fa-plus'></i> <span>Add Section</span></a></li>--}}
                        {{--<li><a href="{{ route('sections.index') }}"><i class='fa fa-list'></i> <span>All Section</span></a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>