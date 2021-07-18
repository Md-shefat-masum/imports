
</div>
</div>
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>


{{-- export table --}}
<script src="{{asset('admin/assets/js/tableHTMLExport.js')}}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js')}}">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.37/jspdf.plugin.autotable.js')}}">
</script>
{{-- export table --}}
<script src="{{asset('admin/assets/js/popper.min.js')}}"></script>
<script src="{{asset('admin/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/assets/js/modernizr.min.js')}}"></script>
<script src="{{asset('admin/assets/js/detect.js')}}"></script>
{{-- <script src="{{asset('admin/assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.slimscroll.min.js')}}"></script> --}}
<script src="{{asset('admin/assets/js/vertical-menu.js')}}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js')}}"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js')}}" async></script> --}}
{{-- <script src="{{asset('admin/assets/plugins/dropzone/dist/dropzone.js')}}"></script> --}}
<script src="{{asset('admin/assets/plugins/switchery/switchery.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/apexcharts/irregular-data-series.js')}}"></script>
<script src="{{asset('admin/assets/plugins/slick/slick.min.js')}}"></script>
<script src="{{asset('admin/assets/js/custom/custom-dashboard.js')}}"></script>
<script src="{{asset('admin/assets/js/custom/custom-form-editor.js')}}"></script>

@stack('js')
<script src="{{asset('admin/assets/plugins/dropify/dist/js/dropify.min.js')}}"></script>
<script>
$(document).ready(function() {
		// Basic
		$('.dropify').dropify();

		// Translated
		$('.dropify-fr').dropify({
			messages: {
				default: 'Glissez-déposez un fichier ici ou cliquez',
				replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
				remove: 'Supprimer',
				error: 'Désolé, le fichier trop volumineux'
			}
		});

		// Used events
		var drEvent = $('#input-file-events').dropify();

		drEvent.on('dropify.beforeClear', function(event, element) {
			return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
		});

		drEvent.on('dropify.afterClear', function(event, element) {
			alert('File deleted');
		});

		drEvent.on('dropify.errors', function(event, element) {
			console.log('Has Errors');
		});

		var drDestroy = $('#input-file-to-destroy').dropify();
		drDestroy = drDestroy.data('dropify')
		$('#toggleDropify').on('click', function(e) {
			e.preventDefault();
			if (drDestroy.isDropified()) {
				drDestroy.destroy();
			} else {
				drDestroy.init();
			}
		})
	});
</script> 



<!-- Core js -->


<script src="{{asset('admin/assets/js/core.js')}}"></script>
<script src="{{asset('admin/assets/js/datatables.min.js')}}"></script>

<script src="{{asset('admin/assets/js/custom.js')}}"></script>
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
@yield('scripts')
<script src="{{asset('admin/assets/js/ajax.js')}}"></script>
<script>
$.ajaxSetup({
  headers: {
	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

</script>

</body>

</html>