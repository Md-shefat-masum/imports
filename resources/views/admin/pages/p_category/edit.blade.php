@extends('admin.layouts.master')
@section('title','|p_category')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{route('p_category.update',$cat->id)}}" id="add_data"
			enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Product Category</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{url('/pages/p_category')}}" class="btn"><i class="fa fa-reply"
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
						<label class="col-sm-3 col-form-label">Product Category</label>
						<div class="col-sm-8">
							<input type="text" name="cat_name" class="form-control" value="{{$cat->cat_name}}" required>
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Sub Category</label>
						<div class="col-sm-8">
							<select name="sub_cat" id="" class="form-control" required>
								<option value="">Select Sub Category</option>
								@foreach($subCategory as $c)
								<option value="{{$c->id}}" @if($c->id==$cat->sub_cat) selected @endif>{{$c->name}}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Category Description</label>
						<div class="col-sm-8">
							<textarea name="cat_description" id="my-editor" cols="30" rows="10" class="form-control"
								required>{{$cat->	cat_description}}</textarea>
							<script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}"></script>
							<script>
								var options = {
														  width: "100%",
													  };
													  CKEDITOR.replace('my-editor', options);
							</script>
						</div>
					</div>

					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label"></label>
						<div class="col-sm-8">
							<select name="status" id="status" class="form-control" required>
								<option value="0" @if($cat->status==0) selected @endif>Unpublish</option>
								<option value="1" @if($cat->status==1)selected @endif>Publish</option>
							</select>
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