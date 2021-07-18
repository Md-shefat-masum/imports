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

		<form method="post" action="{{route('blog.update',$blog->id)}}" id="add_data"
			enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Your Post</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{url('/pages/blog')}}" class="btn"><i class="fa fa-reply"
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

				
                	<input type="hidden" name="auther_id" value="{{ Auth::user()->id }} ">

                	<div class="form-group row custom_form">
                		<label class="col-sm-3 col-form-label"> Title</label>
						<div class="col-sm-8">
                		<input type="text" name="title" class="form-control"  value="{{$blog->title}}">
                	</div>
                	</div>
                	<div class="form-group row custom_form">
                		<label class="col-sm-3 col-form-label"> Details</label>
						<div class="col-sm-8">
						<textarea name="details" id="my-editor" cols="30" rows="10" class="form-control">{{$blog->details}}</textarea>
						<script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}">
						</script>
						<script>
							var options = {
								  width: "100%",
							  };
							  CKEDITOR.replace('my-editor', options);
						</script>
                	</div>
                	</div>
                	<div class="form-group row custom_form">
                		<label class="col-sm-3 col-form-label"> Category</label>
						<div class="col-sm-8">

						<select class="form-control" name="category">
							@php
								$categories = DB::table('blog_category')->where('status', 1)->orderBy('cat_name', 'asc')->get();
							@endphp
							@foreach ($categories as $category)
								<option value="{{ $category->id }}" {{ ($blog->category == $category->id ) ? 'selected' : '' }}>{{ $category->cat_name }}</option>
							@endforeach
						</select>
                	</div>
                	</div>

					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Sub Category</label>
						<div class="col-sm-8">
						<select class="form-control" name="sub_category">
							@php
								$sub_cats = DB::table('blog_sub_cat')->where('status', 1)->orderBy('sub_cat_name', 'asc')->get();
							@endphp
								<option value=" ">-- Select Option --</option>
							@foreach ($sub_cats as $sub_cat)
								<option value="{{ $sub_cat->id }}" {{ ($blog->sub_category == $sub_cat->id ) ? 'selected' : '' }}>{{ $sub_cat->sub_cat_name }}</option>
							@endforeach
						</select>
					</div>
					</div>

					@if (Auth::user()->group_id == 1)
						@php
							$user_groups = DB::table('user_group')->orderBy('name', 'asc')->get();
						@endphp
						<div class="form-group row custom_form">
							<label class="col-sm-3 col-form-label"> Type</label>
						<div class="col-sm-8">
							<select name="type" id="" class="form-control" required>
								@foreach ($user_groups as $user_group)
									<option value="{{ strtolower($user_group->name) }}" {{ (strtolower($user_group->name) == strtolower($blog->type)) ? 'selected' : '' }}>{{ $user_group->name }}</option>
								@endforeach
							</select>
						</div>
						</div>

						<div class="form-group row custom_form">
							<label class="col-sm-3 col-form-label"> Status</label>
						<div class="col-sm-8">
							<select name="status" id="" class="form-control" required>
								<option value="0" @if($blog->status==0) selected @endif >Unpublish</option>
								<option value="1" @if($blog->status==1) selected @endif>Publish</option>
							</select>
						</div>
						</div>
					@endif
                	<div class="form-group row custom_form">
                		<label class="col-sm-3 col-form-label"> File</label>
						<div class="col-sm-8">
                		<input type="file" name="image" class="form-control">
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
@section('scripts')
	<script type="text/javascript">


		$(document).ready(function() {
				// Summernote Editor
				$('#details').summernote({
					 height: 200,
				});
		});

	</script>
@endsection
@endsection
