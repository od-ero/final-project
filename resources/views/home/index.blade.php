@extends('layouts.app-master')
@section('subtitle')
   Dashboard
@endsection

@section('contentheader_title')
  Dashboard
@endsection
@section('content')
    <div class="bg-light p-5 rounded">
       
        @auth
<legend>Dashboard</legend>

<p>My Units</p>
<table class="table table-striped table-responsive" id="units">
<thead>
      <tr>
        <th style="width:5%">ID</th>
        <th style="width:35%">Name</th>
        <th>Role</th>
        <th>Start Date</th>
        <th>End Date</th>
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
                emptyTable: "We are Sorry, No Unit has been assigned for you yet, kindly contact your host for assistance"
            },
            ajax: "{{route('home.index.data') }}",
            columns: [
               
                {
    data: 'id',
    name: 'id',
    render: function (data, type, row, meta) {
        var incrementedValue = meta.row + 1;
        return '<a href="/selected/unit/' + btoa(row.id) + '">' + incrementedValue + '</a>';
    }
},
                {
                    data: 'premises_name',
                    name: 'premises_name',
                    render: function (data, type, row) {
                        return '<a href="/selected/unit/' + btoa(row.id) + '">' + data + '</a>';
                    }
                },
                {
                    data: 'role_name',
                    name: 'role_name',
                    render: function (data, type, row) {
                        return '<a href="/selected/unit/' + btoa(row.id) + '">' + data + '</a>';
                    }
                },
                {
                    data: 'start_date',
                    name: 'start_date',
                    render: function (data, type, row) {
                        return '<a href="/selected/unit/' + btoa(row.id) + '">' + data + '</a>';
                    }
                },
                {
                    data: 'end_date',
                    name: 'end_date',
                    render: function (data, type, row) {
                        return '<a href="/selected/unit/' + btoa(row.id) + '">' + data + '</a>';
                    }
                }
            ]
        });
    });
</script>




        @endauth

        @guest
    
        <h1>Unikey</h1>
        <p class="lead">Your Premise at your pocket.</p>
        
        @endguest
    </div>
    
    @endsection

    
    

