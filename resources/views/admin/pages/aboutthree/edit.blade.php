@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">

	<div class="col-md-12">
		@if (Session::has('success'))
		<div class="alert alert-info">{{ Session::get('success') }}</div>
		@endif
		@if (Session::has('error'))
		<div class="alert alert-danger">{{ Session::get('error') }}</div>
		@endif

		<form action="{{route('aboutThree.update',$aboutThree->id)}}" method="post" enctype="multipart/form-data">
			{{csrf_field()}}
			@method('PUT')
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Your About</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{url('/pages/aboutOne')}}" class="btn"><i class="fa fa-reply"
									aria-hidden="true"></i>
								Back</a>
						</div>
					</div>
				</div>
				<div class="card-body">




					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Title</label>
						<div class="col-sm-8">
						<input type="text" class="form-control" name="title" value="{{$aboutThree->title}}">
					</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Project Name</label>
						<div class="col-sm-8">
						<input type="text" class="form-control" name="project_name" value="{{$aboutThree->project_name}}">
					</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Project Details</label>
						<div class="col-sm-8">
						<textarea name="details" id="my-editor" cols="30" rows="10" class="form-control">{{$aboutThree->details}}</textarea>
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
						<label class="col-sm-3 col-form-label">Image</label>
						<div class="col-sm-8">
						<input type="file" class="form-control" name="image">
					</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Status</label>
						<div class="col-sm-8">
						<select name="status" id="status" class="form-control">
									<option value="{{$aboutThree->status}}">
										@if($aboutThree->status==0)
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

@endsection
