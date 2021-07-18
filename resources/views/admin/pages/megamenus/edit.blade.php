@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{route('megamenus.update',$menu->id)}}" id="add_data" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			{{-- <input type="hidden" name="id" value="{{$data->id}}"> --}}
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update MegaMenu</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{url('/pages/megamenus')}}" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>
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
						<label class="col-sm-3 col-form-label">MegaMenu Name:</label>
						<div class="col-sm-8">
							<input type="text" name="menu" class="form-control" id="menu" value="{{$menu->menu}}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">MegaMenu Slug:</label>
						<div class="col-sm-8">
							<input type="text" name="slug" class="form-control" id="slug" value="{{$menu->slug}}">
						</div>
					</div>

					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label"></label>
						<div class="col-sm-8">
							<select name="status" id="status" class="form-control">
								<option value="0" @if($menu->status==0) selected @endif>Unpublish</option>
								<option value="1" @if($menu->status==0) selected @endif>Publish</option>
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
