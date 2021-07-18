@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Mega Menu
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                Add Megamenu
              </button>
				</h3>
				<!-- modal start -->
				<div class="modal modal-success fade" id="modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Megamenu</h4>
              </div>
              <div class="modal-body">
                <form action="" method="get" accept-charset="utf-8">
                	<div class="form-group">
                		<label for="">Menu</label>
                		<select name="" id="" class="form-control">
                			<option value="">Home</option>
                			<option value="">About</option>
                		</select>
                	</div>
                	<div class="form-group">
                		<label for="">Submenu</label>
                		<input type="text" name="menu" class="form-control" required>
                	</div>
                	<div class="form-group">
                		<label for="">Link</label>
                		<input type="text" name="menu_link" class="form-control" required>
                	</div>

                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
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
						<th>Megamenu</th>
						<th>Submenu</th>
						<th>Menu Link</th>
						<th>Action</th>
					</tr>

					<tr>
						<td>1.</td>
						<td>Home</td>
						<td>row</td>
						<td>/</td>
						<td>

							<div class="btn-group">
								<button type="button" class="btn btn-info">Action</button>
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#">Edit</a></li>
									<li><a href="#">Delete</a></li>
									<li><a href="#">Publish</a></li>
									<li><a href="#">Unpublish</a></li>

								</ul>
							</div>
						</td>

					</tr>

					<tr>
						<td>2.</td>
						<td>About Us</td>
						<td>row</td>
						<td>/about</td>
						<td>

							<div class="btn-group">
								<button type="button" class="btn btn-info">Action</button>
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu" role="menu">
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
