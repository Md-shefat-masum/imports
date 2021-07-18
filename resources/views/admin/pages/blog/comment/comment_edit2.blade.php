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


          	<form action="{{route('commentSectionUpdate', $comment->id)}}" method="POST" enctype="multipart/form-data">
                	@csrf
                	@method('PUT')

                	<div class="form-group">
                		<label for=""> Details</label>
                		<textarea name="comment" id="comment" cols="30" rows="10" class="form-control">{{$comment->comment}}</textarea>
                	</div>

                	<div class="form-group">
                		<label for=""> Status</label>
                		<select name="status" id="" class="form-control" required>
						<option value="0" @if($comment->status==0) selected @endif >Unpublish</option>
						<option value="1" @if($comment->status==1) selected @endif>Publish</option>

                		</select>
                	</div>
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
				$('#comment').summernote({
					 height: 200,
				});
		});

	</script>
@endsection
@endsection
