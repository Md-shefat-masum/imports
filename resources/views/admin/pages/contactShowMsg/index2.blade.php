@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
	<br><br>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="box">
				<div class="box-header with-border">

					<!-- modal start -->

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-bordered">
						<tr>
							<th style="">#</th>
							<th>Full Name</th>
							<th>Phone </th>
							<th>Email</th>
							<th>Message</th>
							<th>Sending Time</th>
							<th>Action</th>
						</tr>
						<?php $i=0; ?>
						@foreach($showContactMsg as $data)
							<?php $i++; ?>
							<tr>
								<td>{{$i}}</td>
								<td>{{$data->full_name}}</td>
								<td>{{$data->phone}}</td>
								<td>{{$data->email}}</td>
								<td>{{$data->message}}</td>

								<td>{{date('M j,Y h:ia',strtotime($data->created_at))}}</td>

								<td>
									<form action="{{ route('messageDelete', $data->id) }}" method="POST">
										{{csrf_field()}}
										@method('DELETE')
										<button type="submit" class="btn btn-danger">Remove</button>
									</form>
								</td>

							</tr>
						@endforeach


					</table>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer clearfix">
					<ul class="pagination pagination-sm no-margin pull-right">

					</ul>
				</div>
			</div>
			<!-- /.box -->
		</div>
	</div>

@endsection
@section('scripts')

@endsection
