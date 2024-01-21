<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
{{--<script src="{{ url (mix('/js/organization-module/app.js')) }}" type="text/javascript"></script>--}}



<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->

      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
      <script src="{{asset('js/employee-module/app.js')}}" type="text/javascript"></script>
      <script src="{{ asset('js/jquery.line.js') }}" type="text/javascript"></script>
      <script src="{{ asset('js/jquery-explr-1.4.js') }}" type="text/javascript"></script>
      <script src="{{ asset('js/jquery.hortree.min.js') }}" type="text/javascript"></script>
      <script src="{{asset('js/datatables.min.js')}}"></script>
      <script src="{{asset('js/jquery-ui.min.js')}}"></script>
      <script src="{{asset('js/animatedModal.min.js')}}"></script>
      <script src="{{asset('js/materialize.min.js')}}"></script>
      <script src="{{asset('js/izimodal.min.js')}}"></script>
      <script src="{{asset('js/anime.min.js')}}"></script>
      <script src="{{asset('js/toastr.min.js')}}"></script>
      <script src="{{asset('js/moment.min.js')}}"></script>
      <script src="{{asset('js/fullcalendar.min.js')}}"></script>
      <script src="{{asset('js/chart.min.js')}}"></script>
      <script src="{{asset('js/highcharts.js')}}"></script>
      {{-- <script src="{{asset('js/highcharts.data.js')}}"></script>
      <script src="{{asset('js/highcharts.exporting.js')}}"></script>
      <script src="{{asset('js/highcharts.accessibility.js')}}"></script> --}}
      <script src="{{asset('js/JavaScript.js')}}"></script>
      <script src="{{asset('js/loader.js')}}"></script>
      <script src="{{asset('js/chosen.min.js')}}"></script>
      <script src="{{asset('js/main.js')}}"></script>
      <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
      <script src="{{asset('js/jszip.min.js')}}"></script>
      <script src="{{asset('js/pdfmake.min.js')}}"></script>
      <script src="{{asset('js/vfs_fonts.js')}}"></script>
      <script src="{{asset('js/buttons.html5.min.js')}}"></script>
      <script src="{{asset('js/daterangepicker.min.js')}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
      <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/moment.min.js'></script>
<script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/jquery.min.js'></script>
<script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min
.js'></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     
      {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></> --}}
      
      
      <script>
                  @if(Session::has('message'))
              console.log('here');
          var type = "{{ Session::get('alert-type', 'info') }}";
          switch(type){
              case 'info':
                  toastr.info("{{ Session::get('message') }}");
                  break;
      
              case 'warning':
                  toastr.warning("{{ Session::get('message') }}");
                  break;
      
              case 'success':
                  toastr.success("{{ Session::get('message') }}");
                  break;
      
              case 'error':
                  toastr.error("{{ Session::get('message') }}");
                  break;
          }
          @endif
      </script>
      
      <script>
          function preview(which) {
              file = document.getElementById(which).files[0];
              file_url = URL.createObjectURL(file);
              $('#'+which+'-preview').attr('src', file_url);
          }
      
          $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
      
      
      
      </script>
      
      <script>
          function validateFormData(form, event, options) {
      
              for (var element in form.elements) {
                  if (form[element] != 'undefined' && form[element] != null) {
                      if (form[element].nodeName === "INPUT" || form[element].nodeName === "TEXTAREA" || form[element].nodeName === "SELECT") {
                          var field = form[element];
                          if(field.required==true){
                              if (field.validity.valid) {
      
                              }
                              else {
                                  event.preventDefault();
                                  var fx = "wobble",
                                      $modal = $(form).closest('.iziModal');
      
                                  if (!$modal.hasClass(fx)) {
                                      $modal.addClass(fx);
                                      setTimeout(function () {
                                          $modal.removeClass(fx);
                                      }, 1500);
                                  }
                                  return false;
      
                              }
                          }
                      }
                  }
      
              }
              return true;
          }
          //Remove class dirty from unfilled fields on focus-Application wide
          $('input', 'select').on('focus', function () {
              $(this).removeClass('dirty');
          });
          $(document).ready(function () {
              $('#calendar').fullCalendar({
                  themeSystem:'bootstrap3',
                  theme:'journal',
                  events:'/trainings',
                  header: {
                      left: 'prev,next,today',
                      center: 'title',
                      right: 'month,agendaWeek,agendaDay,listMonth'
                  },
                  navLinks: true,
                  textColor:'white',
                  loading:calendarLoading,
                  eventClick:eventClicked
              });
          });
          function calendarLoading(isLoading, view) {
              if(isLoading==true){
                  document.getElementById('loading_spinner').style.display = 'flex'
              }
              else if(isLoading==false){
                  document.getElementById('loading_spinner').style.display = 'none'
              }
          }
          function eventClicked(event, jsEvent, view) {
              $('#training_sessions').html('');
              $('#training_name').html(event.session.training.name);
              $('#training_start_date').html(event.session.training.start_date);
              $('#training_end_date').html(event.session.training.end_date);
              $('#training_available_space').html(event.session.training.available_space);
              $('#training_amount').html(event.session.training.amount);
                  var html="<tr>";
                  html+='<td>'+event.session.name+'</td>';
                  html+='<td>'+event.session.date+'</td>';
                  html+='<td>'+event.session.starting_time+'</td>';
                  html+='<td>'+event.session.closing_time+'</td>';
                  html+='</tr>';
      
      
                  $('#training_sessions').append(html);
      
      
      
              $('#view_training').iziModal('open');
      
          }
      
          $(document).ready(function() {
              $('#employees-datatable').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: '{!! route('employees.data') !!}',
                  columns: [
                      {
                          data:'id', name:'id',
                          data: 'first_name', name: 'first_name',
                          data: 'last_name', name: 'last_name',
                          data: 'phone', name: 'phone',
                          data: 'identification_no', name: 'identification_no'
                      },
                  ]
              });
      
      
              $('[data-toggle="tooltip"]').tooltip();
      
      
              //    End iziModal Initialization
      
              @stack('jquery-scripts')
      
              /* ======================================
               ========Instantiating iziModal============
               =======================================*/
      
              $(".modal-custom").iziModal({
                  overlayClose: false,
                  overlayColor: 'rgba(0, 0, 0, 0.6)'
              });
              $(".modal-custom").on('click', 'header a', function(event) {
                  event.preventDefault();
                  var index = $(this).index();
                  $(this).addClass('active').siblings('a').removeClass('active');
                  $(this).parents("div").find("section").eq(index).removeClass('hide').siblings('section').addClass('hide');
      
                  if( $(this).index() === 0 ){
                      $("#modal-custom .iziModal-content .icon-close").css('background', '#ddd');
                  } else {
                      $("#modal-custom .iziModal-content .icon-close").attr('style', '');
                  }
              });
      
          });
          $( function() {
              $( ".accordion" ).accordion();
          } );
      
      </script>
      