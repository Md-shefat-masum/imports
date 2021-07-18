@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		
		<div class="box">
			<h2 class="text-center">Update Your Contact Info</h2>
			<div class="box-header with-border">
				
				
				<!-- modal start -->
				
					<form action="{{route('contact.update',$contact->id)}}" method="post" id="add_data">
				  @csrf
				  @method('PUT')
						
									
									<div class="form-group">
										<label for="">Title</label>
										<input type="text" name="title" class="form-control" id="menu" value="{{$contact->title}}">
									</div>
									
									<div class="form-group">
										<label for="">Phone 1</label>
										<input type="text" name="phone1" class="form-control" id="menu" value="{{$contact->phone1}}">
									</div>
									<div class="form-group">
										<label for="">Phone 2</label>
										<input type="text" name="phone2" class="form-control" id="menu" value="{{$contact->phone2}}">
									</div>
									<div class="form-group">
										<label for="">Address 1</label>
										<textarea name="address1" id="" cols="30" rows="10" class="form-control">{{$contact->address1}}</textarea>
									</div>
									<div class="form-group">
										<label for="">Address 2</label>
										<textarea name="address2" id="" cols="30" rows="10" class="form-control">{{$contact->address2}}</textarea>
									</div>
									<div class="form-group">
										<label for="">Email 1</label>
										<input type="text" name="email1" class="form-control" id="menu" value="{{$contact->email1}}">
									</div>
									<div class="form-group">
										<label for="">Email 2</label>
										<input type="text" name="email2" class="form-control" id="menu" value="{{$contact->email2}}">
									</div>
									<div class="form-group">
										<label for="">Website 1</label>
										<input type="text" name="website1" class="form-control" id="menu" value="{{$contact->website1}}">
									</div>
									<div class="form-group">
										<label for="">Website 2</label>
										<input type="text" name="website2" class="form-control" id="menu" value="{{$contact->website2}}">
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
