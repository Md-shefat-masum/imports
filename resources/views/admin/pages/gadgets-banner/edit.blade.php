@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{route('gadgets_banner_update')}}" id="add_data" enctype="multipart/form-data">
			@csrf

			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Gadgets Banner</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
						<a href="{{route('gadgets_banner')}}" class="btn"><i class="fa fa-reply"
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


					<input type="hidden" name="id" value="{{$data->id}}">

					

					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Image</label>
						<div class="col-sm-5">
						<input type="file" name="image" class="form-control">
					</div>
						<div class="col-sm-3">
							<img src="{{ asset('images/slider/'.$data->image) }}" style="height: 100px;"
							alt="">
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
