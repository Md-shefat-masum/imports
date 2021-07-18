@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-6 col-md-offset-3">

		<div class="box">
			<h2 class="text-center">Update Your Feed</h2>
			<div class="box-header with-border">


				<!-- modal start -->

					<form action="{{ route('facebook', $feed->id) }}" method="post" id="add_data">
                		  @csrf
                		  @method('PUT')


						<div class="form-group">
							<label for="">Title</label>
							<input type="text" name="title" class="form-control" id="menu" value="{{ $feed->title }}">
						</div>
						<div class="form-group">
							<label for="">Feed Url</label>
							<input type="url" name="url" class="form-control" id="slug" value="{{ $feed->link }}">
							<p>Url must be embed</p>
						</div>
						<div class="form-group">
							<select name="status" id="status" class="form-control">
								<option value="1" {{ ($feed->status == 1) ? 'selected' : '' }}>Publish</option>
								<option value="0" {{ ($feed->status == 0) ? 'selected' : '' }}>Unpublish</option>
							</select>
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
