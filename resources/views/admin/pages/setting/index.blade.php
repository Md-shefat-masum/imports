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
			{{ Session::get('success') }}
		</div>

		@endif
		<div class="card">
			<div class="card-header header-part">
				<div class="row">
					<div class="col-md-6 card_header_title">
						<h3><i class="fa fa-gg-circle"></i> All Site Settings</h3>
					</div>
					<div class="col-md-6 text-right card_header_btn">
						<a href="" class="btn" data-toggle="modal" data-target="#bd-example-modal-lg"><i
								class="fa fa-plus-circle"></i> Add
							Site Settings</a>

						<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg">
							<form action="{{route('setting.store')}}" method="post">
								{{csrf_field()}}
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header modal-header-color">
											<h5 class="modal-title">Web Site Setting</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>

										</div>
										<div class="modal-body text-left">

											<div class="form-group">
												<label for="">Company Name</label>
												<input type="text" name="c_name" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="">Company Logo</label>
												<input type="file" name="c_logo" class="form-control" required>
											</div>
											<div class="form-group">
												<label for="">Company Address</label>

												<textarea name="c_address" id="my-editor" cols="30" rows="10"
													class="form-control"></textarea>
												<script
													src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}">
												</script>
												<script>
													var options = {
                                                               width: "100%",
                                                           };
                                                           CKEDITOR.replace('my-editor', options);
												</script>
											</div>
											<div class="form-group">
												<label for="">Company Description</label>
												<textarea name="" id="my-editor2" cols="30" rows="10"
													class="form-control"></textarea>
												<script
													src="{{asset('admin/assets/js/ckeditor/ckeditor.js')}}">
												</script>
												<script>
													var options = {
                                                            width: "100%",
                                                        };
                                                        CKEDITOR.replace('my-editor2', options);
												</script>
											</div>
											<div class="form-group">
												<label for="">Company Phone Number</label>
												<input type="text" name="c_phone" class="form-control">
											</div>
											<div class="form-group">
												<label for="">Company Email</label>
												<input type="email" name="c_email" class="form-control">
											</div>
											<div class="form-group">
												<label for="">Facebook Link</label>
												<input type="text" name="c_fb_link" class="form-control">
											</div>
											<div class="form-group">
												<label for="">Instragram Link</label>
												<input type="text" name="c_ins_link" class="form-control">
											</div>
											<div class="form-group">
												<label for="">Tweeter Link</label>
												<input type="text" name="c_tw_link" class="form-control">
											</div>
											<div class="form-group">
												<label for="">Google Plus Link</label>
												<input type="text" name="c_gPlus_link" class="form-control">
											</div>
											<div class="form-group">
												<label for="">Skype Link</label>
												<input type="text" name="c_skype_link" class="form-control">
											</div>
											<div class="form-group">
												<label for="">Flicker Link</label>
												<input type="text" name="c_flicker_link" class="form-control">
											</div>
											<div class="form-group">
												<label for="">Flicker Link</label>
												<input type="text" name="c_flicker_link" class="form-control">
											</div>
											<div class="form-group">
												<label for="">Location Embaded Link</label>
												<input type="text" name="c_location" class="form-control">
											</div>
											<div class="form-group">
												<label for="">Location Embaded Link</label>
												<input type="text" name="c_location" class="form-control">
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
							<th>Company Name</th>
							<th>Company Logo</th>
							<th>Company Discription</th>
							<th>Company Address</th>
							<th>Company Phone</th>
							<th>Company Social link</th>
							<th>Manage</th>
						</tr>
					</thead>
					<tbody>
						

						<tr>
							<td>1.</td>
							<td>Ouction</td>
							<td>logo</td>
							<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis, facilis.</td>
							<td>Dhaka,Bangladesh</td>
							<td>019154544</td>
							<td>FB</td>


							<td>
								<div class="btn-group btn-group-sm btn-color-ceate">

									<a href="#"
										class="btn btn-info view-btn">Edit</a>
										<a href="#" class="btn btn-success">View</a>
										<a href="#" class="btn btn-danger">Delete</a>
										<a href="#" class="btn btn-warning">Publish</a>
										<a href="#" class="btn btn-primary">Unpublish</a>
								</div>
							</td>
						</tr>

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
@section('scripts')
@endsection
@endsection