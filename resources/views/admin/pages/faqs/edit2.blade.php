@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
<div class="col-md-6 col-md-offset-3">

	<div class="box">
		<h2 class="text-center">Update Your Menu</h2>
		<div class="box-header with-border">


			<!-- modal start -->

				<form action="{{route('faqs.update',$faq->id)}}" method="post" id="add_data">
			  @csrf
			  @method('PUT')
								<div class="form-group">
									<label for="">Title</label>
									<input type="text" name="title" class="form-control" id="slug" value="{{$faq->title}}">
								</div>
								<div class="form-group">
									<label for="">Description</label>
									<textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$faq->description}}</textarea>
								</div>
								<div class="form-group">
									<select name="status" id="status" class="form-control">
										<option value="0" {{ ($faq->status==0) ? 'selected' : '' }}>Unpublish</option>
										<option value="1" {{ ($faq->status==1) ? 'selected' : '' }}>Publish</option>
									</select>
								</div>
								<br>
								<input type="submit" class="btn btn-info" value="Update">
				</form>
				<!-- /.modal-dialog -->
			</div>
			<!-- modal end -->
		</div>
		<!-- /.box-header -->

		<!-- /.box-body -->

	</div>
	<!-- /.box -->
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
