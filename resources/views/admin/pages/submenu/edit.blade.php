@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<form method="post" action="{{route('submenus.update',$submenu->id)}}" id="add_data" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			{{-- <input type="hidden" name="id" value="{{$data->id}}"> --}}
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update SubMenu</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{url('/pages/submenus')}}" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>
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
						<label class="col-sm-3 col-form-label">SubMenu Name:</label>
						<div class="col-sm-8">
							<select name="menu_id" id="" class="form-control" required>
											
								@foreach($menu as $m)
								<option value="{{$m->id}}" @if($m->id==$submenu->menu_id) selected @endif>{{$m->menu}}</option>
								@endforeach
								
								
							</select>
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Submenu:</label>
						<div class="col-sm-8">
							<input type="text" name="submenu" class="form-control" id="=" value="{{$submenu->submenu}}" required>
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Submenu Slug:</label>
						<div class="col-sm-8">
							<input type="text" name="link" class="form-control" id="" value="{{$submenu->link}}" >
						</div>
					</div>

					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label"></label>
						<div class="col-sm-8">
							<select name="status" id="status" class="form-control">
								<option value="0" @if($submenu->status==0) selected @endif>Unpublish</option>
								<option value="1"  @if($submenu->status==1) selected @endif>Publish</option>
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
