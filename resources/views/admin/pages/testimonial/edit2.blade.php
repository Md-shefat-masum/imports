@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-12 ">
		<div class="box">
			@if(Session::has('success'))
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Alert!</h4>
			{{ Session::get('success') }}
		</div>
		
		@endif
			<div class="box-header with-border">
<form action="{{route('tes.update',$tes->id)}}" method="POST" enctype="multipart/form-data">
          	 	{{csrf_field()}}
          	 	@method("PUT")
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Testimonials</h4>
              </div>
              <div class="modal-body">
               
                	<div class="form-group">
                		<label for="">Name</label>
                		<input type="text" name="name" class="form-control" value="{{$tes->name}}">
                	</div>
                	<div class="form-group">
                		<label for="">Designation</label>
                		<input type="text" name="designation" class="form-control"  value="{{$tes->designation}}">
                	</div>
                	<div class="form-group">
                		<label for="">Comments</label>
                		<textarea name="comments" id="" cols="30" rows="10" class="form-control"> {{$tes->comments}}</textarea>
                	</div>
                	<div class="form-group">
                		<label for="">Link</label>
                		<input type="text" name="link" class="form-control"  value="{{$tes->link}}">
                	</div>
                	<div class="form-group">
                		<label for="">Status</label>
                		<select name="status" id="" class="form-control">
	                		<option value="{{$tes->status}}">
												@if($tes->status==0)
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
                	
                <div class="form-group">
                		<label for="">Upload Image</label>
                		<input type="file" name="image" class="form-control">
                	</div>
              </div>
              <button type="submit" class="btn btn-success">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection