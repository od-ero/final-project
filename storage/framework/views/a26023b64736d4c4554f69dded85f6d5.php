
<?php $__env->startSection('subtitle'); ?>
  Entrace Logs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title'); ?>
    Entrace Logs
<?php $__env->stopSection(); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">
    <!-- Include DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <!-- Include DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
    <!-- Include JSZip -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <!-- Include pdfmake -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <!-- Include DataTables HTML5 export button -->
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <!-- Include DataTables print button -->
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>

<?php $__env->startSection('content'); ?>
<div class="container">

                    <div class="container-fluid px-4">
                        <h2 class="mt-4 text-white text-capitalize"><?php echo e($door_name); ?> Door Action Logs</h2>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/welcome">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                        <!-- <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div> -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-history me-1"></i>
                               Door Action Logs
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Persons Name</th>
                                            <th>Permissioners Name</th>
                                            <th>Action</th>
                                            <th>Date and Time</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Persons Name</th>
                                            <th>Permissioners Name</th>
                                            <th>Action</th>
                                            <th>Date and Time</th>
                                        </tr>
                                    </tfoot> -->
                                    <?php $__currentLoopData = $door_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $door_log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($door_log['fname'] .' '. $door_log['lname']); ?></td>
                                            <td><?php echo e($door_log['permissioner_fname'] .' '. $door_log['permissioner_lname']); ?></td>
                                            <td><?php echo e($door_log['status']); ?></td>
                                            <td ><?php echo e($door_log['created_at']); ?></td>
                                        </tr>
                                        
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- <script>
  window.addEventListener('DOMContentLoaded', event => {
    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
      new simpleDatatables.DataTable(datatablesSimple,{
        layout: {
          topStart: {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
          }
        }
      });
    }
  });
</script> -->

               
               <script>
                 new DataTable('#datatablesSimple', {
                         layout: {
                             topStart: {
                                 buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                             }
                        }
                    });
             </script> 
            <!-- <script>
        $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#datatablesSimple thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#datatablesSimple thead');

    var table = $('#datatablesSimple').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        buttons: [
            {
                extend: 'copy',
                text: 'Copy',
                customize: function(doc) {
                    doc.content.unshift({
                        image: 'https://example.com/path-to-your-logo.png',
                        width: 100, // Adjust width as needed
                        alignment: 'center'
                    });
                    doc.title = 'Custom Title for Copy';
                    doc.filename = 'custom_filename_copy';
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                customize: function(doc) {
                    doc.title = 'Custom Title for CSV';
                    doc.filename = 'custom_filename_csv';
                }
            },
            {
                extend: 'excel',
                text: 'Excel',
                customize: function(doc) {
                    doc.title = 'Custom Title for Excel';
                    doc.filename = 'custom_filename_excel';
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                customize: function(doc) {
                    doc.title = 'Custom Title for PDF';
                    doc.filename = 'custom_filename_pdf';
                }
            },
            {
                extend: 'print',
                text: 'Print',
                customize: function(doc) {
                    doc.title = 'Custom Title for Print';
                    doc.filename = 'custom_filename_print';
                }
            }
        ],
        initComplete: function () {
            var api = this.api();

            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');

                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();

                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    });
});

</script> -->
            <?php $__env->stopSection(); ?>
<?php echo $__env->make('adminstration::layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\LaravelAPI\Modules/Adminstration\resources/views/permissions/door_logs.blade.php ENDPATH**/ ?>