@extends('admin.layouts.master')
@section('title','| Contact ')
@section('stylesheet')
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		@if(Session::has('success'))

		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> Alert!</h4>
			{{ Session::get('success') }}
		</div>

		@endif
		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
						<h3><i class="fa fa-gg-circle"></i> All Contact</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="" class="btn" data-toggle="modal" data-target="#bd-example-modal-lg"><i
								class="fa fa-plus-circle"></i> Add
							Contact</a>

						<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg">
							<form action="{{route('contact.store')}}" method="post" id="add_data"
								enctype="multipart/form-data">
								@csrf
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header modal-header-color">
											<h5 class="modal-title">Add Contact</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>

										</div>
										<div class="modal-body text-left">

											<div class="form-group">
												<label for="">Title</label>
												<input type="text" name="title" class="form-control" required>
											</div>

											<div class="form-group">
												<label for="">Phone 1</label>
												<input type="text" name="phone1" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="">Phone 2</label>
												<input type="text" name="phone2" class="form-control">
											</div>

											<div class="form-group">
												<label for="">Address 1</label>
												<textarea name="address1" id="my-editor2" cols="30" rows="10"
													class="form-control"></textarea>
												<script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}">
												</script>
												<script>
													var options = {
														  width: "100%",
													  };
													  CKEDITOR.replace('my-editor2', options);
												</script>
											</div>

											<div class="form-group">
												<label for="">Address 2</label>
												<textarea name="address2" id="my-editor" cols="30" rows="10"
													class="form-control"></textarea>
												<script src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}">
												</script>
												<script>
													var options = {
														  width: "100%",
													  };
													  CKEDITOR.replace('my-editor', options);
												</script>
											</div>

											<div class="form-group">
												<label for="">Email 1</label>
												<input type="email" name="email1" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="">Email 2</label>
												<input type="email" name="email2" class="form-control">
											</div>
											<div class="form-group">
												<label for="">Website 1</label>
												<input type="text" name="website1" class="form-control">
											</div>
											<div class="form-group">
												<label for="">Website 2</label>
												<input type="text" name="website2" class="form-control">
											</div>
										</div>
										<div class="modal-footer">

											<button type="submit" class="btn btn-secondary modal-close-btn"
												data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary modal-delete-btn">Save
												changes</button>
										</div>
									</div>
									<!-- /.modal-content -->

								</div>
							</form>
							<!-- /.modal-dialog -->
						</div>
					</div>
				</div>
			</div>
			<div id="printableTable" class="card-body table-responsive">
				<table cellspacing="0" bordercolor="gray" id="allTable"
					class=" table table-bordered custom_table custom_table_btn">
					<thead>
						<tr>

							<th style="">#</th>
							<th>Title</th>
							<th>Phone 1</th>
							<th>Phone 2</th>
							<th>Address 1</th>
							<th>Address 2</th>
							<th>Email 1</th>
							<th>Email 2</th>
							<th>Website 1</th>
							<th>Website 2</th>


							<th>Create At</th>

							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; ?>
						@foreach($contact as $data)
						<?php $i++; ?>

						<tr>
							<td>{{$i}}</td>
							<td>{{$data->title}}</td>
							<td>{{$data->phone1}}</td>
							<td>{{$data->phone2}}</td>
							<td>{!!$data->address1!!}</td>
							<td>{!!$data->address2!!}</td>
							<td>{{$data->email1}}</td>
							<td>{{$data->email2}}</td>
							<td>{{$data->website1}}</td>
							<td>{{$data->website2}}</td>

							<td>{{date('M j,Y h:ia',strtotime($data->create_at))}}</td>


							<td>
								<div class="btn-group btn-group-sm btn-color-ceate">

									<a href="{{route('contact.edit',$data->id)}}"
										class="btn btn-info view-btn">Edit</a>
									<a class="btn btn-danger delete-btn">
										<form action="{{url('pages/contact',$data->id)}}}" method="POST">
											@method('DELETE')
											{{csrf_field()}} <button class="" style="
											background: none;
											border: none;
											color: #ffffff;
											text-align: center;
											
										">Delete</button>
										</form>
									</a>
								</div>
							</td>
						</tr>

						@endforeach
					</tbody>
				</table>
				<div id="editor"></div>
				<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
			</div>
			<div class="card-footer header-part">
				<button onclick="generatePDF()" class="btn btn-sm btn-danger">PDF</button>
				<button onclick="$('table').tblToExcel();" class="btn btn-sm btn-success">EXCEL</button>
				<button id="csv" class="btn btn-sm btn-info">CSV</button>
				<button id="json" class="btn btn-sm btn-warning">JSON</button>
				<button onclick="printDiv()" class="btn btn-sm btn-primary">PRINT</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
$(".btn-success").click(function(){
var html = $(".clone").html();
$(".increment").after(html);
});
$("body").on("click",".btn-danger",function(){
$(this).parents(".control-group").remove();
});
});
</script>
@endsection