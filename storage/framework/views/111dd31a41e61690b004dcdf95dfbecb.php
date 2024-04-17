

<?php if(auth()->guard()->check()): ?>
<?php $__env->startSection('subtitle'); ?>
    Schedules
<?php $__env->stopSection(); ?>
<style>
        /* Custom CSS to style the button */
        .btn-inline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    </style>
<?php $__env->startSection('contentheader_title'); ?>
    Schedules
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
   
<div class="container">
 <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="viewScheduleModal" tabindex="-1" aria-labelledby="viewScheduleModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewScheduleModal">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php if(isset($sshedule)): ?>
          <?php $__currentLoopData = $doorSchedulecounters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doorSchedulecounter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo e($doorSchedulecounter->id); ?>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Save changes</button>
      </div>
    </div>
  </div>
</div>   
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
                    <?php echo csrf_field(); ?>
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
                        <legend>Schedules</legend>
                        <a href="/make/schedule/<?php echo e($encoded_permission_id); ?>" class="btn btn-outline-success block">Make Schedule</a>
                    </div>
            </div>
        </div>
 
<table class="table table-striped table-responsive" id="units">
  
<input type="text" id='encoded_permission_id' value='<?php echo e($encoded_permission_id); ?>' hidden>

<thead>
      <tr>
        <th style="width:5%">ID</th>
        <th>Permissioner</th>
        <th>Start  Time</th>
        <th>End Time</th>
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
      emptyTable: "No button activation schedules"
    },
    ajax: {
      url: "/schedule/permissions/door/data/<?php echo e($encoded_permission_id); ?>",
      type: "GET",
      // data: function (d) {
      //   d.encodedPermissionId = document.getElementById('encoded_permission_id').value;
      //   // Pass additional data if needed
      //   // d.customParam = 'value';
      // }
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
        data: null,
        name: 'combined_name',
        render: function (data, type, row) {
          var combinedName = row.fname + ' ' + row.lname;
          var loggedInUserId = '<?php echo e($current_user_id); ?>';

          if (row.user_id == loggedInUserId) {
            combinedName = 'You';
          }

          return combinedName;
        }
      },
      {
                    data: 'start_date',
                    name: 'start_date',
                      render: function (data, type, row) {
                            // Parse the date using Carbon
                            var formattedDate = moment(data).format('ddd, MMM DD, YYYY h:mm A');
                            
                            // Return the formatted date as a link
                            return  formattedDate ;
                        }
                    
                },
                {
                    data: 'end_date',
                    name: 'end_date',
                      render: function (data, type, row) {
                          // Parse the date using Carbon
                          var formattedDate = moment(data).format('ddd, MMM DD, YYYY h:mm A');
                          
                          // Return the formatted date as a link
                          return  formattedDate ;
                      }
                } ,
      {
        data: 'id',
        name: 'id',
        render: function (data, type, row) {
          var rowId = row.id;
          var encodedPermissionId= document.getElementById("encoded_permission_id").value;
          var viewUrl = '/doors/schedules/view/'+ encodedPermissionId + '/' + btoa(rowId);
          var updateUrl = '/update/schedule/user/' + encodedPermissionId + '/' + btoa(rowId);

          // Construct HTML content with URLs using backticks (template literals)
          return `
            <div class="btn-group dropend">
            <a href="${viewUrl}" class="btn btn-success" role="button">View</a>
              
              <button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropright</span>
                More
              </button>
              <ul class="dropdown-menu">
                <div class="m-2 text-center">
                  <li class="mb-2"><a href="${updateUrl}" class="btn btn-success" role="button">Update</a></li>
                  <li>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="setUnitId(${rowId})">Revoke</button>
                  </li>
                </div>
              </ul>
            </div>
          `;
        }
      }
    ]
  });

  // Attach click event handler to all view buttons using a class selector
  $('#units tbody').on('click', '.view-schedule-btn', function () {
    var scheduleId = $(this).data('rowId');
console.log(scheduleId);
    // Fetch data from Laravel route using AJAX
    $.ajax({
      url: '/doors/schedules/view/' + scheduleId,
      method: 'GET',
      success: function (data) {
      //console.log(html(data.html))
        // Update modal content based on fetched data
        $('#viewScheduleModal .modal-body').html(data.html);
        $('#viewScheduleModal').modal('show'); // Show the modal
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error('Error fetching schedule data:', errorThrown);
        // Handle errors appropriately
      }
    });
  });
});
</script>

<script>
    function setUnitId(permissionId) {
        document.getElementById('unitIdInput').value = permissionId;
    }
</script>


<?php $__env->stopSection(); ?>
        <?php endif; ?>
    </div>
    
   

    
    


<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\resources\views/schedule/schedulePermissions.blade.php ENDPATH**/ ?>