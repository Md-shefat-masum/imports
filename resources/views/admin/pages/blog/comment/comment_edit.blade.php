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

		<form action="{{route('commentSectionUpdate', $comment->id)}}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Comment</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{url('/pages/comment-section')}}" class="btn"><i class="fa fa-reply"
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
						<label class="col-sm-3 col-form-label"> Details</label>
						<div class="col-sm-8">
							<textarea name="comment" id="my-editor" cols="30" rows="10"
								class="form-control">{{$comment->comment}}</textarea>
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
						<label class="col-sm-3 col-form-label"> Status</label>
						<div class="col-sm-8">
							<select name="status" id="" class="form-control" required>
								<option value="0" @if($comment->status==0) selected @endif >Unpublish</option>
								<option value="1" @if($comment->status==1) selected @endif>Publish</option>

							</select>
						</div>
					</div>
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
				$('#comment').summernote({
					 height: 200,
				});
		});

</script>
@endsection
@endsection