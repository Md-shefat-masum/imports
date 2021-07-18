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
				
					<form action="{{route('units.update',$unit->id)}}" method="post" id="add_data">
				  @csrf
				  @method('PUT')
						
									
									
									<div class="form-group">
										<label for="">unit Name</label>
										<input type="text" name="unit" class="form-control" id="unit" value="{{$unit->unit}}" required>
									</div>
									
									<select name="status" id="status" class="form-control" required>	
											<option value="0" @if($unit->status==0) selected @endif>Unpublish</option>
											<option value="1" @if($unit->status==1) selected @endif>Publish</option>
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

@endsection
