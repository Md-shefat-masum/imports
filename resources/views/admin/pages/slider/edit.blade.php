@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{route('sliders.update',$slider->id)}}" id="add_data"
			enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Slider</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{url('/pages/sliders')}}" class="btn"><i class="fa fa-reply"
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
						<label class="col-sm-3 col-form-label">Title:</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="title" value="{{$slider->title}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Subtitle:</label>
						<div class="col-sm-8">
							<input type="text" name="subtitle" class="form-control" value="{{$slider->subtitle}}">
						</div>
					</div>

					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Description:</label>
						<div class="col-sm-8">
							<textarea name="description" id="my-editor" cols="30" rows="5" class="form-control">
									{{$slider->description}}
								</textarea>
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
							<input type="text" name="link" class="form-control" value="{{$slider->link}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label"></label>
						<div class="col-sm-8">
							<select name="status" id="status" class="form-control">
								<option value="0">Unpublish</option>
								<option value="1">Publish</option>
							</select>
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label" for="">Upload Image</label>
						<div class="col-sm-8">
							<input type="file" name="image" class="form-control" >
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
@section('scripts')

@endsection