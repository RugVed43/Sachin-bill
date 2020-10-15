<script src="{{ url('public/ui/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
<script src="{{ url('public/ui/js/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ url('public/ui/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ url('public/ui/js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ url('public/ui/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="{{ url('public/ui/js/jquery.validate.min.js') }}"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="{{ url('public/ui/js/moment.min.js') }}"></script>
<!--  Charts Plugin -->
{{--
<script src="{{ url('public/ui/js/chartist.min.js') }}"></script>
--}}
<!--  Plugin for the Wizard -->
<script src="{{ url('public/ui/js/jquery.bootstrap-wizard.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ url('public/ui/js/bootstrap-notify.js') }}"></script>
<!--   Sharrre Library    -->
{{--
<script src="{{ url('public/ui/js/jquery.sharrre.js') }}"></script>
--}}
<!-- DateTimePicker Plugin -->
<script src="{{ url('public/ui/js/bootstrap-datetimepicker.js') }}"></script>
<!-- Vector Map plugin -->
{{--
<script src="{{ url('public/ui/js/jquery-jvectormap.js') }}"></script>
--}}
<!-- Sliders Plugin -->
<script src="{{ url('public/ui/js/nouislider.min.js') }}"></script>
<!--  Google Maps Plugin    -->
{{--
<script src="https://maps.googleapis.com/maps/api/js"></script>
--}}
<!-- Select Plugin -->
{{--
<script src="{{ url('public/ui/js/jquery.select-bootstrap.js') }}"></script>
--}}
<!--  DataTables.net Plugin    -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript"
  src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.16/b-1.5.0/b-colvis-1.5.0/b-flash-1.5.0/b-html5-1.5.0/b-print-1.5.0/cr-1.4.1/fh-3.1.3/r-2.2.1/sc-1.4.3/sl-1.2.4/datatables.min.js">
</script>

<!-- Sweet Alert 2 plugin -->
<script src="{{ url('public/ui/js/sweetalert2.js') }}"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ url('public/ui/js/jasny-bootstrap.min.js') }}"></script>
<!--  Full Calendar Plugin    -->
<script src="{{ url('public/ui/js/fullcalendar.min.js') }}"></script>
<!-- TagsInput Plugin -->
<script src="{{ url('public/ui/js/jquery.tagsinput.js') }}"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{ url('public/ui/js/material-dashboard.js') }}"></script>
<script src="{{ url('public/antos-plugins/laravel-datatables-ajaxify.js') }}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
{{--
<script src="{{ url('public/ui/js/demo.js') }}"></script>
--}}
{{-- var temp = $('#'+$.fn.dataTable.tables()[0].id).DataTable(); --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script>
  $(document).ready(function() {
    window.app_url = "{{ url('/') }}" + "/";
    window.api_url = "{{ url('/api') }}" + "/";
    $page = $(".full-page");
    image_src = $page.data("image");

    if (image_src !== undefined) {
      image_container =
        '<div class="full-page-background" style="background-image: url(' +
        image_src +
        ') "/>';
      $page.append(image_container);
    }

    window.datetimepicker =$(".datetimepicker").datetimepicker({
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        today: "fa fa-screenshot",
        clear: "fa fa-trash",
        close: "fa fa-remove",
        inline: true
      }
    });

    $(".datepicker").datetimepicker({
      format: "DD-MM-YYYY",
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        today: "fa fa-screenshot",
        clear: "fa fa-trash",
        close: "fa fa-remove",
        inline: true
      }
    });

    $(".timepicker").datetimepicker({
      //          format: 'H:mm',    // use this format if you want the 24hours timepicker
      format: "h:mm A", //use this format if you want the 12hours timpiecker with AM/PM toggle
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        today: "fa fa-screenshot",
        clear: "fa fa-trash",
        close: "fa fa-remove",
        inline: true
      }
    });

    $(".select2")
      .select2({
        width: "100%",
        tags: [],
        tokenSeparators: [";"]
      })
      .on("select2-open", function() {
        // however much room you determine you need to prevent jumping
        var requireHeight = 600;
        var viewportBottom = $(window).scrollTop() + $(window).height();

        // figure out if we need to make changes
        if (viewportBottom < requireHeight) {
          // determine how much padding we should add (via marginBottom)
          var marginBottom = requireHeight - viewportBottom;

          // adding padding so we can scroll down
          $(".aLwrElmntOrCntntWrppr").css("marginBottom", marginBottom + "px");

          // animate to just above the select2, now with plenty of room below
          $("html, body").animate(
            {
              scrollTop: $("#mySelect2").offset().top - 10
            },
            1000
          );
        }
      });

    window.datatables = $(".datatables").DataTable({
      dom:
        '<"top"<"row"<"col-xs-2 col-sm-2 col-md-2 col-lg-2 btn-sm"l><"col-xs-6 col-sm-6 col-md-6 col-lg-6 "B><"col-xs-4 col-sm-4 col-md-4 col-lg-4 "f>><"clear">>rt<"bottom"<"col-xs-6 col-sm-6 col-md-6 col-lg-6 "i><"col-xs-6 col-sm-6 col-md-6 col-lg-6 "p><"clear">>',
      buttons: [
        {
          extend: "colvis",
          className: "btn btn-default buttons-collection buttons-colvis btn-sm",
          text: '<i class="fa fa-eye"></i>',
          titleAttr: "Column Visibility",
          exportOptions: {
            columns: ":visible"
          }
        },
        {
          extend: "copy",
          text: '<i class="fa fa-files-o"></i>',
          className: "btn btn-default buttons-copy buttons-html5 btn-sm",
          titleAttr: "COPY",
          exportOptions: {
            columns: ":visible"
          }
        },
        {
          extend: "csv",
          text: '<i class="fa fa-file-text-o"></i>',
          className: "btn btn-default buttons-csv buttons-html5 btn-sm",
          titleAttr: "CSV",
          exportOptions: {
            columns: ":visible"
          }
        },
        {
          extend: "excel",
          text: '<i class="fa fa-file-excel-o"></i>',
          className: "btn btn-default buttons-excel buttons-html5 btn-sm",
          titleAttr: "EXCEL",
          exportOptions: {
            columns: ":visible"
          }
        },
        {
          extend: "pdf",
          text: '<i class="fa fa-file-pdf-o"></i>',
          className: "btn btn-default buttons-pdf buttons-html5 btn-sm",
          titleAttr: "PDF",
          orientation: "landscape",
          pageSize: "A4",
          download: "open",
          exportOptions: {
            columns: ":visible"
          }
        },
        {
          extend: "print",
          text: '<i class="fa fa-print"></i>',
          className: "btn btn-default buttons-print btn-sm",
          titleAttr: "PRINT",
          exportOptions: {
            columns: ":visible"
          }
        }
      ],
      colReorder: true,
      pagingType: "full_numbers",
      lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
      responsive: false,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search records"
      }
    });
    $(".datatables tfoot th").each(function() {
      var title = $(this).text();
      if (title == "Actions") {
        return;
      }
      $(this).html(
        '<input type="text" class="form-control" placeholder="&#x1F50D; ' +
          title +
          '" style="width:100%"/>'
      );
      $(this).css("width", "50px");
    });
    window.datatables.columns().every(function() {
      var that = this;

      $("input", this.footer()).on("keyup change", function() {
        if (that.search() !== this.value) {
          that.search(this.value).draw();
        }
      });
    });
    // SAMPLE CODE
    /*	
	    $('#mytable').ajaxifyTable({
        url: "http://localhost/sandbox/l5/antos-laravel/public/api/apiuser",
        cols: [{
            db: "username",
            td: "User Name",
            html: '<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="material-icons">dvr</i></a>',
        }, {
            db: "fname",
            td: "Name"
        }, {
            db: "actions",
            td: "Actions",
            actions: [
                'edit',
            ]
        }, ],
    });
*/
    /*
    $('#regularForm').on('click', function(event) {
        event.preventDefault();
        console.log(
            $(document).processForm({
                tag: $('#processForm'),
                url: "http://localhost/sandbox/l5/antos-laravel/public/api/apiuser",
                // fileurl: "http://localhost/sandbox/l5/antos-laravel/public/api/fileman",
            })
            );
    });;


*/
    /*
    $('#upload_files').on('click', function(event) {
        event.preventDefault();
        console.log('hi');

        // fileForm
        $(document).fileForm({
            url: "http://localhost/sandbox/l5/antos-laravel/public/api/fileman",
            debug: true,
            headers: {
                folder: "upload",
                model: "User",
                mid: 1,
            },
            tag: $('#upload_this')
        });
        // dataForm
        $(document).dataForm({
            url: "http://localhost/sandbox/l5/antos-laravel/public/api/apiuser",
            data: {
                username:"anto",
                password:"anto",
            },
            
            debug: true,
        })
});;
*/
  });
</script>
@yield('scripts')