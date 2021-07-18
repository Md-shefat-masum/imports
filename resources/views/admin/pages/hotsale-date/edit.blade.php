@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		@if(Session::has('success'))

		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Alert!</h4>
			<p>Successfully Updated</p>
		</div>

		@endif
		<form method="post" action="{{route('hotsale_date_update')}}" id="add_data" enctype="multipart/form-data">
			@csrf
			{{-- @method('PUT') --}}
			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Hot Sale Date</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{route('hotsale_date')}}" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>
								Back</a>
						</div>
					</div>
				</div>
				<div class="card-body">



					<input type="hidden" name="id" value="{{$data->id}}">
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Hot Sale Date</label>
						<div class="col-sm-8">
							<input type="date" name="date" class="form-control" id="unit" value="{{$data->date}}"
								required>
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