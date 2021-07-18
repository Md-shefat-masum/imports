@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<form action="{{ route('partners.update', $partner->id) }}" method="post" id="add_data"
			enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<div class="card">
				<div class="card-header header-part">
					<div class="row">
						<div class="col-md-6 card_header_title">
							<h3><i class="fa fa-gg-circle"></i> Update Your Partners</h3>
						</div>
						<div class="col-md-6 text-right card_header_btn">
							<a href="{{url('/pages/partners')}}" class="btn"><i class="fa fa-reply"
									aria-hidden="true"></i>
								Back</a>
						</div>
					</div>
				</div>
				<div class="card-body">




					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Title</label>
						<div class="col-sm-8">
							<input type="text" name="title" class="form-control" id="title"
								value="{{ $partner->title }}">
						</div>
					</div>
					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Description</label>
						<div class="col-sm-8">
							<input type="text" name="description" class="form-control" id="description"
								value="{{ $partner->description }}">
						</div>
					</div>

					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label">Logo</label>
						<div class="col-sm-8">
							<input type="file" name="image" class="form-control" id="image">
						</div>
					</div>

					<div class="form-group row custom_form">
						<label class="col-sm-3 col-form-label"></label>
						<div class="col-sm-8">
							<select name="status" id="status" class="form-control">
								<option value="1" {{ ($partner->status == 1) ? 'selected' : '' }}>Publish
								</option>
								<option value="0" {{ ($partner->status == 0) ? 'selected' : '' }}>Unpublish
								</option>
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