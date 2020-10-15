<!-- jQuery 2.2.3 -->
<script src="{{ url('ui/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ url('ui/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> --}}
{{-- <script src="ui/plugins/morris/morris.min.js"></script> --}}
<!-- Sparkline -->
{{-- <script src="ui/plugins/sparkline/jquery.sparkline.min.js"></script> --}}
<!-- jvectormap -->
{{-- <script src="ui/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script> --}}
{{-- <script src="ui/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> --}}
<!-- jQuery Knob Chart -->
{{-- <script src="ui/plugins/knob/jquery.knob.js"></script> --}}
<!-- daterangepicker -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> --}}
{{-- <script src="ui/plugins/daterangepicker/daterangepicker.js"></script> --}}
<!-- datepicker -->
<script src="{{ url('ui/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
{{-- <script src="ui/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> --}}
<!-- Slimscroll -->
<script src="{{ url('ui/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('ui/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ url('ui/plugins/select2/select2.full.min.js') }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="ui/dist/js/pages/dashboard.js"></script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src="ui/dist/js/demo.js"></script> --}}
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/r-2.1.1/sc-1.4.2/se-1.2.2/datatables.min.js"></script>

<script src="{{ url('js/notify.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('ui/dist/js/app.min.js') }}"></script>

{{-- <script src="{{ url('materialui/dist/js/material.min.js') }}"></script>
<script src="{{ url('materialui/dist/js/ripples.min.js') }}"></script> --}}

<script  type="text/javascript">
$(document).ready(function() {
	$('.notifytest').notify("TEST",{ 
		position:"bottom left",
		arrowShow: true,
	});
	$(".select2").select2({
		tags:[],
		tokenSeparators: [";"],

	});
	$(".select2-selection").on("focus", function () {
		$(this).parent().parent().prev().select2("open");
	});
	$('.select2-search > input.select2-search__field').on('keyup', function(e) {
		if(e.keyCode === 13 || e.keyCode == 9) 
			addToList($(this).val());
	});
	$('.datatables tfoot th').each( function () {
		var title = $(this).text();
		if (title =="Actions") {
			return;
		}
		$(this).html( '<input type="text" placeholder="&#x1F50D; '+title+'" style="width:100%"/>' );
		$(this).css("width","50px");

	} );
	
	$('.datatables tbody td').each( function () {
		var count_td = $('.datatables tbody tr:first>td').length
		var td_width = 90 / count_td		
		console.log(td_width);
		$(this).css("width",td_width+"%");

	} );
	window.mydatatable = $('.datatables').DataTable({
		dom: 'lBfrtip',
		buttons: [
		'colvis',{
			extend: 'copy',
			exportOptions: {
				columns: ':visible'
			}
		},
		{
			extend: 'csv',
			exportOptions: {
				columns: ':visible'
			}
		},
		{
			extend: 'excel',
			exportOptions: {
				columns: ':visible'
			}
		},
		{
			extend: 'pdf',
			orientation: 'landscape',
			pageSize: 'A4',
			download: 'open',
			exportOptions: {
				columns: ':visible'
			}
		},
		{
			extend: 'print',
			exportOptions: {
				columns: ':visible'
			}
		},
		],
		colReorder: true
	});
	mydatatable.columns().every( function () {
		var that = this;

		$( 'input', this.footer() ).on( 'keyup change', function () {
			if ( that.search() !== this.value ) {
				that
				.search( this.value )
				.draw();
			}
		} );
	} );



});
</script>
@yield('scripts')

{{-- 

	Dropzone.options.myDropzone = {
		url: "{{ route('uploadlr') }}",
		headers: {  'X-CSRF-TOKEN': "{{ csrf_token() }}" , 'order-id': order_id },
		acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
		autoProcessQueue: false,
		uploadMultiple: true,
		parallelUploads: 1,
		init: function() {
			var myDropzone = this;
			url: "{{ route('uploadlr') }}",
			document.getElementById("submit_lr").addEventListener("click", function(e) {
				e.preventDefault();
				e.stopPropagation();
				myDropzone.processQueue();
			});
			this.on("addedfile", function(file) {
				var removeButton = Dropzone.createElement('<a class="dz-remove">Remove file</a>');
				var _this = this;
				lrno = file.caption == undefined ? "" : file.caption;
				courier = file.caption == undefined ? "" : file.caption;
				invoice = file.caption == undefined ? "" : file.caption;
				file._captionLRLabel = Dropzone.createElement("<p>LR Number:</p>")
				file._captionLRNo = Dropzone.createElement("<input id='"+file.filename+"' type='text' name='lr_no' value="+lrno+" >");
				file._captionCourierLabel = Dropzone.createElement("<p>Courier:</p>")
				file._captionCourierName = Dropzone.createElement("<input id='"+file.filename+"' type='text' name='courier' value="+courier+" >");
				file._captionInvoiceNoLabel = Dropzone.createElement("<p>Invoice Number:</p>")
				file._captionInvoiceNoName = Dropzone.createElement("<input id='"+file.filename+"' type='text' name='invoice' value="+invoice+" >");
				file.previewElement.appendChild(file._captionLRLabel);
				file.previewElement.appendChild(file._captionLRNo);
				file.previewElement.appendChild(file._captionCourierLabel);
				file.previewElement.appendChild(file._captionCourierName);
					// file.previewElement.appendChild(file._captionInvoiceNoLabel);
					// file.previewElement.appendChild(file._captionInvoiceNoName);
					removeButton.addEventListener("click", function(e) {
						e.preventDefault();
						e.stopPropagation();
						var fname = file.previewElement.querySelector('[data-dz-name]').innerHTML;
						var fileInfo = new Array();
						fileInfo['name']=fname;
						$.ajax({
							type: "POST",
							url: "{{ route('deletelr') }}",
							data: {file: fname, "_token": "{{ csrf_token() }}"},
							beforeSend: function () {
							},
							success: function (response) {
								if (response == 'success')
									alert('deleted');
							},
							error: function (data) {
								$('.error').text(data);
								console.log(data)
								// alert("error");
							}
						});
						_this.removeFile(file);
					});
					file.previewElement.appendChild(removeButton);
				});
this.on(
	"sending", function(file, xhr, formData){
		formData.append('lr_no',file._captionLRNo.value);
		formData.append('courier',file._captionCourierName.value);
		formData.append('invoice',file._captionInvoiceNoName.value);
	})
this.on("success", function(file,response) {
	console.log(response)
	mytable.row.add([ 
		'<input type="text" name="lr_no" id="inputLr_no" class="form-control" value="'+response.data.lr_no+'">',
		'<input type="text" name="courier" id="inputLr_no" class="form-control" value="'+response.data.courier+'">',
		'<input type="text" name="invoice_no" id="inputLr_no" class="form-control" value="'+response.data.invoice_no+'">',
		(response.invoice !== null) ?
		'<a href="'+response.invoice+'" target="_blank" class="btn btn-large btn-block btn-success">View Invoice</a>'
		:
		'<a href="#" target="_blank" class="btn btn-large btn-block btn-warning">NOT FOUND</a>'
		,
		'<a href="{{ url("/") }}/'+response.data.lr_receipt+'" target="_blank" class="btn btn-large btn-block btn-success">View LR</a>',
		'<a type="button" class="btn btn-warning editlr" data-lrid="'+response.data.id+'"><i class="fa fa-fw fa-pencil"></i></a><a type="button" class="btn btn-danger deletemylr" data-lrid="'+response.data.id+'"><i class="fa fa-fw fa-trash"></i></a>'
		]).draw();
	var i = myDropzone.getQueuedFiles().length;
	while (i > 0) {
		myDropzone.processQueue();
		i--;
	};
	file.previewElement.querySelector("[data-dz-name]").innerHTML  = response.filename;
});
}
}


 --}}