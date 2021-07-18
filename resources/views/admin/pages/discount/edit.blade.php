@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{route('discount_update')}}" enctype="multipart/form-data">
			@csrf

			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Discount</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{route('discount')}}" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>
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


					<input type="hidden" name="id" value="{{$data->id}}">


					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Title:</label>
						<div class="col-sm-8">
							<input type="text" name="title" class="form-control" value="{{$data->title}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Category</label>
						<div class="col-sm-8">

							<select name="category" class="form-control">
								@php
								$sp=DB::table("discounts")->where('id',$data->category)->first();
								@endphp

								<option value="{{$data->category}}">{{$sp->cat_name ?? Null}}</option>
								@php
								$cat=App\HomeProductCategory::orderBy("id","DESC")->get();
								@endphp
								@foreach ($cat as $item)
								@php
								$spp=DB::table('product_categories')->where('id',$item->cat_id)->first();
								@endphp

								<option value="{{$item->cat_id}}">{{$spp->cat_name ?? Null}}
								</option>
								@endforeach

							</select>
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Discount</label>
						<div class="col-sm-8">
							<input type="number" name="discount" class="form-control" value="{{$data->discount}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Discount Start</label>
						<div class="col-sm-8">
							<input type="datetime-local" id="birthdaytime" name="discount_start" value="{{$data->discount_start}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Discount End</label>
						<div class="col-sm-8">
							<input type="datetime-local" id="birthdaytime" name="discount_end" value="{{$data->discount_end}}">
						</div>
					</div>

				

					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Details</label>
						<div class="col-sm-8">
							<textarea name="details" id="my-editor" cols="30" rows="5"
								class="form-control">{{$data->details}}</textarea>
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
						<label class="col-sm-3 col-form-label">Image</label>
						<div class="col-sm-5">
							<input type="file" name="image" class="form-control">
						</div>
						<div class="col-sm-3">
							<img src="{{ asset('images/slider/'.$data->image) }}" style="height: 100px;" alt="">
						</div>
					</div>


				</div>

			</div>
			<div class="card-footer header-part text-center">
				<button type="submit" class="btn btn-info">Update</button>
			</div>
	</div>
	</form>
</div>


@endsection
@section('scripts')

@endsection