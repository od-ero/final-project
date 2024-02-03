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
    data: null,
    name: 'combined_name',
    render: function (data, type, row) {
        // Combine premises_name and unit_name with a comma
        var combinedName = row.premises_name + ', ' + row.unit_name;

        // Create a link with the combined name
        var link = '<a href="/selected/unit/' + btoa(row.id) + '">' + combinedName + '</a>';

        return link;
    }
},
                
                {
                    data: 'start_date',
                    name: 'start_date',
                    render: function (data, type, row) {
                        // Parse the date using Carbon
                        var formattedDate = moment(data).format('ddd, MMM DD, YYYY h:mm A');
                        
                        // Return the formatted date as a link
                        return '<a href="/selected/unit/' + btoa(row.id) + '">' + formattedDate + '</a>';
                    }
                }
                ,
                {
                    data: 'end_date',
                    name: 'end_date',
                    render: function (data, type, row) {
                        var formattedDate = moment(data).format('ddd, MMM DD, YYYY h:mm A');
                        return '<a href="/selected/unit/' + btoa(row.id) + '">' + formattedDate + '</a>';
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

    
    

