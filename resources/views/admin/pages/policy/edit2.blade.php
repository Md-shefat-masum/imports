@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		
		<div class="box">
			<h2 class="text-center">Update Your Menu</h2>
			<div class="box-header with-border">
				
				
				<!-- modal start -->
				
					<form action="{{route('policy.update',$policy->id)}}" method="post" id="add_data">
				  @csrf
				  @method('PUT')
						
									
									<div class="form-group">
										<label for="">Title</label>
										<input type="text" name="title" class="form-control" id="menu" value="{{$policy->title}}">
									</div>
									<div class="form-group">
										<label for="">Description</label>
										<textarea name="description" id="" cols="30" rows="10" class="form-control summernote">{!! $policy->description !!}}</textarea>
									</div>
									<div class="form-group">
										<label for="">Link</label>
										<input type="text" name="link" class="form-control" id="slug" value="{{$policy->link}}">
									</div>
									<div class="form-group">
										<label for="">Image</label>
										<input type="file" name="image" class="form-control" id="slug">
									</div>
									<div class="form-group">
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
