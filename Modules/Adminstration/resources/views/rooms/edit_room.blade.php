@extends('adminstration::layouts.admin_master')
@section('subtitle')
    Update A Room
@endsection

@section('contentheader_title')
    Update A Room
@endsection

@section('content')
 
        <div class="bg-primary" id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update A Room Detail</h3></div>
                                    <div class="card-body">
                                    <!-- id="add_unit" onsubmit="return validateForm()"  method="post" action="{{url('/rooms/create')}}" -->
                                        <form name="add_unit" id="add_unit" onsubmit="return validateForm()"  method="post" action="{{url('/rooms/details/actions/update')}}" >
                                        <input class="form-control" type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input  class="form-controlt" value="{{$room_detail["owner_id"]}}" id="owner_id" type="hidden"  name="owner_id">
                                        <input  class="form-controlt" value="{{$room_detail["id"]}}" id="unit_id" type="hidden"  name="unit_id">
                                        <div class="row mb-3">
                                        <p><i>
                                            Kindly enter either of the owners name or Phone number and search to select the user
                                         </i></p>
                                                <div class="col-md-5">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="name" name="name" value="{{$room_detail['fname']. ' ' .$room_detail['lname']}}" value="{{ old('name') }}" type="text" placeholder="Enter first or second name" />
                                                        <label for="name">Owner's Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="phone" value="{{$room_detail['phone']}}" id="phone" type="tel" placeholder="Search by phone number" />
                                                        <label for="phone">Owner's Phone Number</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                <button class="btn btn-outline-secondary" type="button" id="#userSearchButton">search</button>
                                                </div>
                                            </div> 
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="dropdown-menu" id="searchResults" style="display: none;">
        
                                                    </ul>    
                                                </div>
                                                <div class="col-md-3">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input  class="form-control" type="text" placeholder="Enter Premises Name" name="premises_name" value="{{$room_detail['premises_name']}}" id="premises_name" required>
                                                        <label for="inputFirstName">Premises Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" type="text" placeholder=" Enter Unit Name" name="unit_name" value="{{$room_detail['unit_name']}}" id="unit_name" required />
                                                        <label for="unit_name">Room Name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input  class="form-control" type="text" placeholder="Enter longitude" name="longitude" value="{{$room_detail['longitude']}}" id="longitude" required>
                                                        <label for="inputFirstName">Longitude</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" type="text" placeholder="Enter Latitude" name="latitude" value="{{$room_detail['latitude']}}" id="latitude" required />
                                                        <label for="unit_name">Latitude</label>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" id="currentLocationCheckbox" type="checkbox" onchange="getLocation()" />
                                                        <label class="form-check-label" for="currentLocationCheckbox">Use current location</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4 mb-0 text-center">
                                                <a href="{{ URL::previous() }}" class="btn btn-secondary">Back</a>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                           </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    


<script type="text/javascript">

$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

</script>

 <script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        
         @endsection       

