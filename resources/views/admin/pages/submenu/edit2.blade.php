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
				
					<form action="{{route('submenus.update',$submenu->id)}}" method="post" id="add_data">
				  @csrf
				  @method('PUT')
						
								<div class="modal-body">
									
									
									<div class="form-group">
										<label for="">Menu Name</label>
										<select name="menu_id" id="" class="form-control" required>
											
											@foreach($menu as $m)
											<option value="{{$m->id}}" @if($m->id==$submenu->menu_id) selected @endif>{{$m->menu}}</option>
											@endforeach
											
											
										</select>
									</div>
									<div class="form-group">
										<label for="">Submenu</label>
										<input type="text" name="submenu" class="form-control" id="=" value="{{$submenu->submenu}}" required>
									</div>
									<div class="form-group">
										<label for="">Submenu Slug</label>
										<input type="text" name="link" class="form-control" id="" value="{{$submenu->link}}" >
									</div>
									<select name="status" id="status" class="form-control">
										<option value="0" @if($submenu->status==0) selected @endif>Unpublish</option>
										<option value="1"  @if($submenu->status==1) selected @endif>Publish</option>
									</select>
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
