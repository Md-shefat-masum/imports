@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{route('supplier-forum.update',$contact->id)}}" id="add_data"
			enctype="multipart/form-data">
			@csrf
			@method('PUT')
			{{-- <input type="hidden" name="id" value="{{$data->id}}"> --}}
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Supplier</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{url('/pages/supplier-forum')}}" class="btn"><i class="fa fa-reply"
									aria-hidden="true"></i>
								Back</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					@if(Session::has('success'))
					<script>
						swal({
							  title: "Successfully!",
							  text: "Updated Information.",
							  timer: 5000,
							  icon: "success",
						  });
  
					</script>
					@endif
					@if(Session::has('error'))
					<script>
						swal({
							  title: "Opps!",
							  text: "Updated Failed.",
							  timer: 5000,
							  icon: "warning",
						  });
  
					</script>
					@endif



					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Supplier Item</label>
						<div class="col-sm-8">
							<textarea name="suppliers_item" id="my-editor" cols="30" rows="5"
								class="form-control">{{$contact->suppliers_item}}</textarea>
							<script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}"></script>
							<script>
								var options = {
															width: "100%",
														};
														CKEDITOR.replace('my-editor', options);
							</script>
						</div>
					</div>

				</div>
				<div class="card-footer header-part text-center">
					<button type="submit" class="btn btn-info">Update</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$(".btn-success").click(function(){
			var html = $(".clone").html();
			$(".increment").after(html);
		});
		$("body").on("click",".btn-danger",function(){
			$(this).parents(".control-group").remove();
		});
	});
	// Summernote Editor
	$('#suppliers_item').summernote({
		height: 200,
	});
</script>
@endsection