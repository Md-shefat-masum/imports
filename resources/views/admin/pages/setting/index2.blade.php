@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-12 ">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Setting
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                Add Site Settings
              </button>
				</h3>
				<!-- modal start -->

				<div class="modal modal-success fade" id="modal-success">
          <div class="modal-dialog">
          	<form action="{{route('setting.store')}}" method="post">
          		{{csrf_field()}}
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Web Site Setting</h4>
              </div>
              <div class="modal-body">

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

                		<textarea name="c_address" id="" cols="30" rows="10" class="form-control"></textarea>
                	</div>
                	<div class="form-group">
                		<label for="">Company Description</label>
                		<textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
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
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
            </form>
          </div>

          <!-- /.modal-dialog -->
        </div>
				<!-- modal end -->
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="table-responsive">		
					<table class="table table-bordered">
					<tr>
						<th style="">#</th>
						<th>Company Name</th>
						<th>Company Logo</th>
						<th>Company Discription</th>
						<th>Company Address</th>
						<th>Company Phone</th>
						<th>Company Social link</th>
						<th>Action</th>
					</tr>

					<tr>
						<td>1.</td>
						<td>Ouction</td>
						<td>logo</td>
						<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis, facilis.</td>
						<td>Dhaka,Bangladesh</td>
						<td>019154544</td>
						<td>FB</td>
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-info">Action</button>
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#">View</a></li>
									<li><a href="#">Edit</a></li>
									<li><a href="#">Delete</a></li>
									<li><a href="#">Publish</a></li>
									<li><a href="#">Unpublish</a></li>

								</ul>
							</div>
						</td>
					</tr>
				</table>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix">
				<ul class="pagination pagination-sm no-margin pull-right">
					<li><a href="#">&laquo;</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">&raquo;</a></li>
				</ul>
			</div>
		</div>
		<!-- /.box -->
	</div>
</div>
@section('scripts')
@endsection
@endsection
