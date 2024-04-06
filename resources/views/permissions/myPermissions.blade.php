
@extends('layouts.app-master')
@auth
@section('subtitle')
    My Permissions
@endsection
<style>
        /* Custom CSS to style the button */
        .btn-inline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@section('contentheader_title')
    My Permissions
@endsection
@section('content')
   
<div class="container">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
      Are You Sure you want to revoke this Permission? 
      <form id="deleteForm" action="/permissions/selected/destroy" method="POST">
                    @csrf
                    <input type="hidden" name="permission_id" id="unitIdInput">
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteForm').submit()">Revoke</button>

      </div>
    </div>
  </div>
</div>

        <div class="row">
            <div class="col">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <legend>My Permissions</legend>
                        <a href="/add/permissions/{{ $encoded_permission_id }}" class="btn btn-outline-success block">Give Permission</a>
                    </div>
            </div>
        </div>
   
<input type="text" id="encoded_permission_id" value="{{$encoded_permission_id}}" hidden>

<table class="table table-striped table-responsive" id="units">
<thead>
      <tr>
        <th style="width:5%">ID</th>
        <th>Guest</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Permission Name</th>
        <th>Actions</th>
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
                emptyTable: "You have not assigned anyone permission"
            },
            ajax: "/permissions/guests/permission/data/{{$encoded_permission_id}}",
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
    data: null,
    name: 'combined_name',
    
    render: function (data, type, row) {
        // Combine premises_name and unit_name with a comma
        var combinedName = row.fname + '  ' + row.lname;

        return combinedName;
    }
    
},
                
                {
                    data: 'start_date',
                    name: 'start_date',
                    
                }
                ,
                {
                    data: 'end_date',
                    name: 'end_date',
                    
                },
                {
                    data: 'name',
                    name: 'name',
                } ,
                {
                data: 'id',
                name: 'id',
                render: function(data, type, row) {
                    var row_id = row.id;
                    var encoded_permission_id= document.getElementById("encoded_permission_id").value;
                    // Construct the URLs using row_id
                    var viewUrl = '/permissions/edit/mypermissions/' + btoa(row_id);
                    var updateUrl = '/permissions/edit/guests/permissions/' + encoded_permission_id + '/' + btoa(row_id);

                    // Return the HTML content with URLs including row_id
                    return `<div class="btn-group dropend">
                                <a href="${viewUrl}" class="btn btn-success btn-lg" tabindex="-1" role="button">View</a>
                                <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropright</span> More
                                </button>
                                <ul class="dropdown-menu">
                                    <div class="m-2 text-center">
                                        <li class="mb-2"><a href="${updateUrl}" class="btn btn-success" role="button">Update</a></li>
                                        <li>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setUnitId(${row_id})">Revoke</button>
                                        </li>
                                    </div>
                                </ul>
                            </div>`;
                }


            }

            ]
        });
    });
</script>
<script>
    function setUnitId(permissionId) {
        document.getElementById('unitIdInput').value = permissionId;
    }
</script>


@endsection
        @endauth
    </div>
    
   

    
    

