@extends('adminstration::layouts.admin_master')
@section('subtitle')
 Devices
@endsection

@section('contentheader_title')
   Devices
@endsection

@section('content')
<div class="container">

                    <div class="container-fluid px-4">
                        <h2 class="mt-4 text-white">Doors</h2>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/welcome">Dashboard</a></li>
                            <li class="breadcrumb-item active">doors</li>
                        </ol>
                        <!-- <div class="card mb-4">
                             <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div> 
                        </div> -->
                        <div class="card mb-4">
                            <div class="card-header"><i class="fa-solid fa-door-open"></i>
                               
                                Doors
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Door</th>
                                            <th>Device Serial Number</th>
                                            <th>IP V4 Address</th>
                                            <th>Online State</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Door</th>
                                            <th>Device Serial Number</th>
                                            <th>IP V4 Address</th>
                                            <th>Online State</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    @foreach($doors as $door)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$door['door_name']}}</td>
                                            <td>{{$door['device_serial_number']}}</td>
                                            <td>{{$door['ip_address']}}</td>
                                            <td>{{$door['door_ip_status']}}</td>
                                            <td>
                                            <a href="/rooms/doors/edit/blade/{{base64_encode($door['door_id'])}}" class="btn btn-primary btn-lg" tabindex="-1" role="button">Update</a>
                                            </td>
                                            
                                        </tr>
                                        
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            <script>
                window.addEventListener('DOMContentLoaded', event => {
                // Simple-DataTables
                // https://github.com/fiduswriter/Simple-DataTables/wiki

                const datatablesSimple = document.getElementById('datatablesSimple');
                if (datatablesSimple) {
                    new simpleDatatables.DataTable(datatablesSimple);
                }
            });

            </script>
            @endsection