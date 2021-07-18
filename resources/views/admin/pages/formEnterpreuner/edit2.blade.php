@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-6 col-md-offset-3">

		<div class="box">
			<h2 class="text-center">Update Your Enterpreuner Form</h2>
			<div class="box-header with-border">


				<!-- modal start -->

					<form action="{{route('enterprenor-forum.update',$contact->id)}}" method="post" id="add_data">
						 @csrf
						@method('PUT')


							<div class="form-group">
								<label for="">Enterpreuner Item</label>
								<textarea name="enterpreuner_item" id="enterpreuner_item" cols="30" rows="5" class="form-control">{{$contact->enterpreuner_item}}</textarea>
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
	$(document).ready(function() {
		$(".btn-success").click(function(){
			var html = $(".clone").html();
			$(".increment").after(html);
		});
		$("body").on("click",".btn-danger",function(){
			$(this).parents(".control-group").remove();
		});
	});
	// Summernote Editor
	$('#enterpreuner_item').summernote({
		height: 200,
	});
	</script>
@endsection
