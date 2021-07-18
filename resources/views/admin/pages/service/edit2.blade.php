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
				
					<form action="{{route('services.update',$service->id)}}" method="post" id="add_data">
				  @csrf
				  @method('PUT')
						
									
									
									<div class="form-group">
										<label for="">Step No.</label>
										<input type="number" name="step_no" class="form-control" id="" value="{{$service->step_no}}" required>
									</div>
									<div class="form-group">
										<label for="">Step Title</label>
										<input type="text" name="step_title" class="form-control" id="" value="{{$service->step_title}}" required >
									</div>
									<div class="form-group">
										<label for="">Step Link</label>
										<input type="text" name="step_link" class="form-control" id="" value="{{$service->step_link}}" required>
									</div>
									<div class="form-group">
										<label for="">Step Description</label>
										<textarea name="step_description" id="" cols="30" rows="10" class="form-control" required>{{$service->step_description}}</textarea>
									</div>
									<select name="status" id="status" class="form-control" required>
										<option value="0" @if($service->status==0) selected @endif>Unpublish</option>
										<option value="1" @if($service->status==0) selected @endif>Publish</option>
									</select>
					
								<br>
								<input type="submit" class="btn btn-success" value="Update">
								
					</form>
					

			<!-- /.box-header -->
			
			<!-- /.box-body -->
			
	</div>
</div>
		<!-- /.box -->
	</div>
</div>

@endsection
@section('scripts')

@endsection
