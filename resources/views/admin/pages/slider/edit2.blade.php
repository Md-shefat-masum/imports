@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		
		<div class="box">
			<h2 class="text-center">Update Your Submenu</h2>
			<div class="box-header with-border">
				
				
				<!-- modal start -->
				
					<form action="{{route('sliders.update',$slider->id)}}" method="post" id="add_data"  enctype="multipart/form-data">
				  @csrf
				  @method('PUT')
						
							
									
									
									<div class="form-group">
										<label for="">Title</label>
										<input type="text" class="form-control" name="title" value="{{$slider->title}}">
									</div>
									<div class="form-group">
										<label for="">Subtitle</label>
										<input type="text" name="subtitle" class="form-control" value="{{$slider->subtitle}}" >
									</div>
									<div class="form-group">
										<label for="">Description</label>
										<textarea name="description" id="" cols="30" rows="5" class="form-control">
											{{$slider->description}}
										</textarea>
									</div>
									<div class="form-group">
										<label for="">Link</label>
										<input type="text" name="link" class="form-control" value="{{$slider->link}}">
									</div>
									<select name="status" id="status" class="form-control">
										<option value="0">Unpublish</option>
										<option value="1">Publish</option>
									</select>
								</div>
								<div class="form-group">
										<label for="">Upload Image</label>
										<input type="file" name="image" class="form-control" >
									</div>
							
						
								<br>
								<input type="submit" class="btn btn-info" value="Updtae">
							
					</form>
					
			</div>
			<!-- /.box-header -->
			
			<!-- /.box-body -->
			
		</div>
		<!-- /.box -->
	</div>
</div>

@endsection
@section('scripts')

@endsection
