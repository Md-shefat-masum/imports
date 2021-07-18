@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{route('tes.update',$tes->id)}}" id="add_data" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Testimonials</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{url('/pages/tes')}}" class="btn"><i class="fa fa-reply"
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
						<label class="col-sm-3 col-form-label">Name:</label>
						<div class="col-sm-8">
							<input type="text" name="name" class="form-control" value="{{$tes->name}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Designation:</label>
						<div class="col-sm-8">
							<input type="text" name="designation" class="form-control" value="{{$tes->designation}}">
						</div>
					</div>

					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Comments:</label>
						<div class="col-sm-8">
							<textarea name="comments" id="my-editor" cols="30" rows="10"
								class="form-control"> {{$tes->comments}}</textarea>
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
						<label class="col-sm-3 col-form-label" for="">Link</label>
						<div class="col-sm-8">
							<input type="text" name="link" class="form-control" value="{{$tes->link}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label"></label>
						<div class="col-sm-8">
							<select name="status" id="" class="form-control">
								<option value="{{$tes->status}}">
									@if($tes->status==0)
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
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label" for="">Upload Image</label>
						<div class="col-sm-8">
							<input type="file" name="image" class="form-control">
						</div>
					</div>
				</div>

			</div>
			<div class="card-footer header-part text-center">
				<button type="submit" class="btn btn-info">Update</button>
			</div>
	</div>
	</form>
</div>


@endsection