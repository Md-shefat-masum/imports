@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{route('policy.update',$policy->id)}}" id="add_data" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Service</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{url('/pages/policy')}}" class="btn"><i class="fa fa-reply"
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
							<input type="text" name="title" class="form-control" id="menu" value="{{$policy->title}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Description</label>
						<div class="col-sm-8">
							<textarea name="description" id="my-editor" cols="30" rows="10"
								class="form-control">{!!$policy->description!!}</textarea>
							<script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}"></script>
							<script>
								var options = {
															width: "100%",
														};
														CKEDITOR.replace('my-editor', options);
							</script>
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Link</label>
						<div class="col-sm-8">
							<input type="text" name="link" class="form-control" id="slug" value="{{$policy->link}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Image</label>
						<div class="col-sm-8">
							<input type="file" name="image" class="form-control" id="slug">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label"></label>
						<div class="col-sm-8">
							<select name="status" id="status" class="form-control">
								<option value="{{$policy->status}}">
									@if($policy->status==0)
									{{"Unpulish"}}
									@else
									{{"Publish"}}
									@endif
								</option>
								<option>----------------</option>
								<option value="0">Unpublish</option>
								<option value="1">Publish</option>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
	$(document).ready(function() {
            $('.summernote').summernote();
        });
           $(document).ready(function() {
            //initialize summernote
            $('.summernote').summernote();
 
            //assign the variable passed from controller to a JavaScript variable.
            var content = {!! json_encode($policy->description) !!};
 
            //set the content to summernote using `code` attribute.
            $('.summernote').summernote('code', description);
        });
</script>
@endsection