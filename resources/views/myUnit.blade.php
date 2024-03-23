@extends('layouts.app-master')
@section('subtitle')
   My Rooms
@endsection

@section('contentheader_title')
  My Room
@endsection

@section('content')
   
@auth      
<p>Welcome to <b class="text-uppercase"> {{$unit['premises_name'] . ', ' . $unit['unit_name']}}</b> </p>
<?php $unit_id = base64_encode($unit['id']); ?>

<input type="text" id="encoded_permission_id" value="{{$encoded_permission_id}}" hidden>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title bg-success" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- Replace '...' with the content you want in the modal body -->
        <h2>Are you sure you want to perform this operation?</h2>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <!-- onclick="redirectToAction(row_id, encoded_permission_id, status)" -->
        <button  class="btn btn-success" onclick="redirectToAction(row_id, encoded_permission_id, status)">Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- <div><button class="button button1">
    <a href="/units/create" style="text-decoration: none; color: inherit;">
       Add Unit
    </a>
</button>
<button class="button button1">
    <a href="/add/permissions/<?php echo $unit_id; ?>" style="text-decoration: none; color: inherit;">
       give permission
    </a>
</button>
<button class="button button1">
    <a href="/make/schedule/<?php echo $unit_id; ?>" style="text-decoration: none; color: inherit;">
      Activate button access
    </a>
</button>
</div> -->
<table class="table table-striped" id="units">
   <thead>
   
   <tr>
        <th style="width:5%">ID</th>
        <th>Door</th>
        <th>Status</th>
        <th>State</th>
        <th>Action</th>
    </tr>

   </thead>
</table>


<script type="text/javascript">

  let row_id;
  let status;
  let encoded_permission_id;

$(function () {
    $('#units').DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        ordering: true,
        searching: true,
        language: {
            emptyTable: "We are Sorry, No door has been assigned for you yet, kindly contact your host for assistance"
        },
        ajax: {
            url: '/selected/unit/data/{{$unit_id}}',  // Check if row is available in this context
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                render: function (data, type, row, meta) {
                    var incrementedValue = meta.row + 1;
                    return incrementedValue;
                }
            },
            {
                data: 'door_name',
                name: 'door_name',
            },
            {
                data: 'door_ip_status',
                name: 'door_ip_status',
                render: function (data, type, row, meta) {
                var color = '';
                if (data === 'Online') {
                    color = '14A44D';
                } else if (data === 'Offline') {
                    color = 'DC4C64';
                }else if (data === 'Inactive') {
                    color = '3B71CA';
                }
                else {color= '000000';}
                return '<div style="color: #' + color + '; font-size:14px;font-weight:900;padding: 4px; border-radius: 4px;width:50%; text-align: center;">' + data + '</div>';
                }
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'status',
                name: 'status',
                render: function (data, type, row) {
    var initialStatus = row.status;
    var row_id = row.id;
    var encoded_permission_id= document.getElementById("encoded_permission_id").value;
    var buttonColor = (initialStatus === 'Locked') ? '#04AA6D' : 'red';
    var buttonText = (initialStatus === 'Locked') ? 'Unlock' : 'Lock';

    // ...

    // Modal button with data-rowid attribute
    return '<button class="btn" style="background-color: ' + buttonColor + '; color: white;" data-toggle="modal" data-target="#exampleModalCenter" data-rowid="' + row_id + '" data-status="' + initialStatus + '" data-encoded_permission_id="' + encoded_permission_id + '">'
    + buttonText + 
    '</button>';
}



            }
        ]
    });
});
// Example function that uses row_id, encoded_permission_id, and status

$(document).on('click', '#units .btn', function() {
 
    row_id = $(this).data('rowid'); 
    status = $(this).data('status');
    encoded_permission_id = $(this).data('encoded_permission_id'); 
    

    
   // redirectToAction(row_id, encoded_permission_id, status);
});
async function redirectToAction(row_id, encoded_permission_id, status) {
    let latitude= 555;
    let longitude= -43;
    let loadingToast;

    try {
        // Display loading message
        toastr.info('Loading...', {
            closeButton: false,
            progressBar: true,
            positionClass: 'toast-top-full-width'
        });

        // Get user's geolocation
       // if ("geolocation" in navigator) {
           // const position = await new Promise((resolve, reject) => {
              //  navigator.geolocation.getCurrentPosition(resolve, reject);
          //  });
           // latitude = position.coords.latitude;
           // longitude = position.coords.longitude;
          //  console.log("Latitude: " + latitude);
          //  console.log("Longitude: " + longitude);
       // } else {
          //  throw new Error("Geolocation is not supported by your browser");
       // }

        // Construct action URL
        const actionURL = '/home/myunits/action/' + btoa(row_id) + '/' + encoded_permission_id + '/' + btoa(status) + '/' + btoa(latitude) + '/' + btoa(longitude);

        // Fetch data
        const res = await fetch(actionURL);
        const data = await res.json();

        // Display appropriate toastr message based on response
        toastr.clear(loadingToast);
        if (data.alertType == 'success' || data.alertType === 'error' || data.alertType === 'success2') {
            toastr[data.alertType](data.message);
            setTimeout(() => {
                location.reload();
            }, 5000);
        } else {
            throw new Error("Unknown alert type in response data");
        }
    } catch (error) {
        // Display error toast
        toastr.clear(loadingToast);
        toastr.error(error.message, {
            closeButton: true,
            positionClass: 'toast-top-full-width'
        });
        console.error(error);
    }

    // Close modal
    $('#exampleModalCenter').modal('hide');
}


//z
</script>
@endauth
@endsection