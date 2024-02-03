@extends('layouts.app-master')
@section('subtitle')
   My Units
@endsection

@section('contentheader_title')
  My Units
@endsection

@section('content')
   
@auth      



<p>Welcome to {{$unit['premises_name'] . ', ' . $unit['unit_name']}} </p>
<?php $unit_id = base64_encode($unit['id']); ?>

<input type="text" id="encoded_permission_id" value="{{$encoded_permission_id}}" hidden>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  href="#" >Save changes</button>
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
        <th>Action</th>
    </tr>

   </thead>
</table>
<script type="text/javascript">
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
                data: 'status',
                name: 'status',
            },
            {
                data: 'status',
                name: 'status',
                render: function (data, type, row) {
                    var initialStatus = row.status;
                    var buttonColor = (initialStatus === 'Locked') ? '#04AA6D' : 'red';
                    var buttonText = (initialStatus === 'Locked') ? 'Unlock' : 'Lock';
                    var encoded_permission_id = document.getElementById("encoded_permission_id").value;
                   console.log(encoded_permission_id);
                    return '<button class="btn data-toggle="modal" data-target="#exampleModalCenter" "style="background-color: ' + buttonColor + '; color: white;">' 
                    // +
                    // '<a href="/home/myunits/action/' + btoa(row.id) + '/' + encoded_permission_id + '/' + btoa(row.status) + '" style="text-decoration: none; color: inherit;">' +
                    // buttonText +
                    // '</a>'
                    '</button>';

                   
                }
            }
        ]
    });
});
</script>


@endauth
@endsection