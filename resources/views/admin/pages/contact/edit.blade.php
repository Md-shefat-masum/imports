@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{route('contact.update',$contact->id)}}" id="add_data"
			enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Your Contact Info</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{url('/pages/contact')}}" class="btn"><i class="fa fa-reply"
									aria-hidden="true"></i>
								Back</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					@if(Session::has('success'))
					<script>
						swal({
							  title: "Successfully!",
							  text: "Updated Information.",
							  timer: 5000,
							  icon: "success",
						  });
  
					</script>
					@endif
					@if(Session::has('error'))
					<script>
						swal({
							  title: "Opps!",
							  text: "Updated Failed.",
							  timer: 5000,
							  icon: "warning",
						  });
  
					</script>
					@endif


					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Title:</label>
						<div class="col-sm-8">
							<input type="text" name="title" class="form-control" id="menu" value="{{$contact->title}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Phone 1</label>
						<div class="col-sm-8">
							<input type="text" name="phone1" class="form-control" id="menu"
								value="{{$contact->phone1}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Phone 2</label>
						<div class="col-sm-8">
							<input type="text" name="phone2" class="form-control" id="menu"
								value="{{$contact->phone2}}">
						</div>
					</div>


					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Address 1</label>
						<div class="col-sm-8">
							<textarea name="address1" id="my-editor2" cols="30" rows="10"
								class="form-control">{{$contact->address1}}</textarea>
							<script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}">
							</script>
							<script>
								var options = {
								  width: "100%",
							  };
							  CKEDITOR.replace('my-editor2', options);
							</script>
						</div>
					</div>

					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Address 2</label>
						<div class="col-sm-8">
							<textarea name="address2" id="my-editor" cols="30" rows="10"
								class="form-control">{{$contact->address2}}</textarea>
							<script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}">
							</script>
							<script>
								var options = {
								  width: "100%",
							  };
							  CKEDITOR.replace('my-editor', options);
							</script>
						</div>
					</div>

					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Email 1</label>
						<div class="col-sm-8">
							<input type="text" name="email1" class="form-control" id="menu"
								value="{{$contact->email1}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Email 2</label>
						<div class="col-sm-8">
							<input type="text" name="email2" class="form-control" id="menu"
								value="{{$contact->email2}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Website 1</label>
						<div class="col-sm-8">
							<input type="text" name="website1" class="form-control" id="menu"
								value="{{$contact->website1}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Website 2</label>
						<div class="col-sm-8">
							<input type="text" name="website2" class="form-control" id="menu"
								value="{{$contact->website2}}">
						</div>
					</div>

				</div>
				<div class="card-footer header-part text-center">
					<button type="submit" class="btn btn-info">Update</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
@section('scripts')

@endsection