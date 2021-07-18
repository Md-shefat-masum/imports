@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="box">
			<div class="box-header with-border">

				@if (Session::has('success'))
					<div class="alert alert-info">{{ Session::get('success') }}</div>
				@endif
				@if (Session::has('error'))
					<div class="alert alert-danger">{{ Session::get('error') }}</div>
				@endif


          	<form action="{{route('blog.update',$blog->id)}}" method="POST" enctype="multipart/form-data">
                	@csrf
                	@method('PUT')

                	<input type="hidden" name="auther_id" value="{{ Auth::user()->id }} ">

                	<div class="form-group">
                		<label for=""> Title</label>
                		<input type="text" name="title" class="form-control"  value="{{$blog->title}}">
                	</div>
                	<div class="form-group">
                		<label for=""> Details</label>
                		<textarea name="details" id="details" cols="30" rows="10" class="form-control">{{$blog->details}}</textarea>
                	</div>
                	<div class="form-group">
                		<label for=""> Category</label>

						<select class="form-control" name="category">
							@php
								$categories = DB::table('blog_category')->where('status', 1)->orderBy('cat_name', 'asc')->get();
							@endphp
							@foreach ($categories as $category)
								<option value="{{ $category->id }}" {{ ($blog->category == $category->id ) ? 'selected' : '' }}>{{ $category->cat_name }}</option>
							@endforeach
						</select>
                	</div>

					<div class="form-group">
						<label for="">Sub Category</label>
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

					@if (Auth::user()->group_id == 1)
						@php
							$user_groups = DB::table('user_group')->orderBy('name', 'asc')->get();
						@endphp
						<div class="form-group">
							<label for=""> Type</label>
							<select name="type" id="" class="form-control" required>
								@foreach ($user_groups as $user_group)
									<option value="{{ strtolower($user_group->name) }}" {{ (strtolower($user_group->name) == strtolower($blog->type)) ? 'selected' : '' }}>{{ $user_group->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">
							<label for=""> Status</label>
							<select name="status" id="" class="form-control" required>
								<option value="0" @if($blog->status==0) selected @endif >Unpublish</option>
								<option value="1" @if($blog->status==1) selected @endif>Publish</option>
							</select>
						</div>
					@endif
                	<div class="form-group">
                		<label for=""> File</label>
                		<input type="file" name="image" class="form-control">
                	</div>
					<br>
					<input type="submit" class="btn btn-success" value="Update">
               </form>


		</div>
		<!-- /.box -->
	</div>
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
