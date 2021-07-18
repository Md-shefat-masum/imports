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
				
					<form action="{{route('megamenus.update',$menu->id)}}" method="post" id="add_data">
				  @csrf
				  @method('PUT')
						
									
									<div class="form-group">
										<label for="">Menu Name</label>
										<input type="text" name="menu" class="form-control" id="menu" value="{{$menu->menu}}">
									</div>
									<div class="form-group">
										<label for="">Menu Slug</label>
										<input type="text" name="slug" class="form-control" id="slug" value="{{$menu->slug}}">
									</div>
									<div class="form-group">
										<select name="status" id="status" class="form-control">
											<option value="0" @if($menu->status==0) selected @endif>Unpublish</option>
											<option value="1" @if($menu->status==0) selected @endif>Publish</option>
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
