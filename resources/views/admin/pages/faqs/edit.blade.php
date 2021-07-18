@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{route('faqs.update',$faq->id)}}" id="add_data" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Your Faq Info</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{url('/pages/faqs')}}" class="btn"><i class="fa fa-reply"
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
						<label class="col-sm-3 col-form-label">Title</label>
						<div class="col-sm-8">
							<input type="text" name="title" class="form-control" id="slug" value="{{$faq->title}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Description</label>
						<div class="col-sm-8">
							<textarea name="description" id="my-editor2" cols="30" rows="10"
								class="form-control">{{$faq->description}}</textarea>
							<script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}">
							</script>
							<script>
								var options = {
							  width: "100%",
						  };
						  CKEDITOR.replace('my-editor2', options);
							</script>
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label"></label>
						<div class="col-sm-8">
							<select name="status" id="status" class="form-control">
								<option value="0" {{ ($faq->status==0) ? 'selected' : '' }}>Unpublish</option>
								<option value="1" {{ ($faq->status==1) ? 'selected' : '' }}>Publish</option>
							</select>
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
	$( document ).ready(function() {
		// Summernote Editor
		$('#description').summernote({
			height: 200,
		});
	});
</script>
@endsection