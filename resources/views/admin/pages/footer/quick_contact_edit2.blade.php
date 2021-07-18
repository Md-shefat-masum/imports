@extends('admin.layouts.master')
@section('title','|menus')
@section('stylesheet')
@endsection
@section('content')
<br><br>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="box">
			<h2 class="text-center">Update Your Qucik Contact</h2>
			<div class="box-header with-border">
				<!-- modal start -->
				<form action="{{ route('updateQuickContact', $quickContact->id) }}" method="post" id="add_data">
            		  @csrf
            		  @method('PUT')


                      <div class="form-group">
                          <label for="">Phone</label>
                          <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone number" required value="{{ $quickContact->phone }}">
                      </div>

                      <div class="form-group">
                          <label for="">Email</label>
                          <input type="email" name="email" class="form-control" id="email" placeholder="Enter email address" required value="{{ $quickContact->email }}">
                      </div>

                      <div class="form-group">
                          <label for="">Address line 1</label>
                          <input type="text" name="address_first" class="form-control" id="address_first" placeholder="Enter street address" required value="{{ $quickContact->address_first }}">
                      </div>

                      <div class="form-group">
                          <label for="">Address line 2</label>
                          <input type="text" name="address_second" class="form-control" id="address_second" placeholder="Enter city address" required value="{{ $quickContact->address_second }}">
                      </div>

                      <div class="form-group">
                          <label for="">Address line 3</label>
                          <input type="text" name="address_third" class="form-control" id="address_third" placeholder="Enter country address" required value="{{ $quickContact->address_third }}">
                      </div>

                      <div class="form-group">
                          <label for="">Facebook</label>
                          <input type="text" name="facebook" class="form-control" id="facebook" placeholder="Enter facebook address" required value="{{ $quickContact->facebook }}">
                      </div>

                      <div class="form-group">
                          <label for="">Twitter</label>
                          <input type="text" name="twitter" class="form-control" id="twitter" placeholder="Enter twitter address" required value="{{ $quickContact->twitter }}">
                      </div>

                      <div class="form-group">
                          <label for="">Gmail</label>
                          <input type="text" name="gmail" class="form-control" id="gmail" placeholder="Enter gmail address" required value="{{ $quickContact->gmail }}">
                      </div>

                      <div class="form-group">
                          <label for="">Linkedin</label>
                          <input type="text" name="linkedin" class="form-control" id="linkedin" placeholder="Enter linkedin address" required value="{{ $quickContact->linkedin }}">
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
@endsection
@section('scripts')

@endsection
