@extends('front_end.layouts.master')
@section('title','|Product')
@section('stylesheet')
	<style>
	.nav-tabs{
		border: none;
	}
	.bit-custom-text-field{
		border-radius: 20px;
		background: #F3F6FD;
	}
</style>
@endsection
@section('content')
	<div class="container">

		@if(Session::has('flash_message_error'))

			<!-- /.box-header -->
			<div class="box-body">
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

					{!! session('flash_message_error') !!}
				</div>
			@endif
			@if(Session::has('success_submit'))

				<!-- /.box-header -->
				<div class="box-body">
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Alert!</h4>
						{!! session('success_submit') !!}
					</div>
				@endif

				<form action="{{url('/checkout')}}" method="post">
					{{csrf_field()}}
					<div class="row">
						<div class="col-md-6">
							<h3>Bill To</h3><br>

							<div class="form-group">
								<label for="">Billing Name</label>
								<input type="text" class="form-control bit-custom-text-field" id="billing_name" name="billing_name" value="{{$userDetails->first_name}}" required>
							</div>
							<div class="form-group">
								<label for="">Billing Address</label>
								<input type="text" class="form-control bit-custom-text-field" id="billing_address" name="billing_address" value="{{$userDetails->address}}" required>
							</div>
							<div class="form-group">
								<label for="">Billing City</label>
								<input type="text" class="form-control bit-custom-text-field" id="billing_city" name="billing_city" value="{{$userDetails->city}}" required>
							</div>
							<div class="form-group">
								<label for="">Billing State</label>
								<input type="text" class="form-control bit-custom-text-field" id="billing_state" name="billing_state" value="{{$userDetails->states}}" required>
							</div>
							<div class="form-group">
								<label for="">Billing Postcode</label>
								<input type="text" class="form-control bit-custom-text-field" id="billing_zipcode" name="billing_postcode" value="{{$userDetails->zip_code}}" required>
							</div>
							<div class="form-group">
								<label for="">Billing Mobile</label>
								<input type="text" class="form-control bit-custom-text-field" id="billing_mobile" name="billing_mobile" value="{{$userDetails->cell_phone}}" required>
							</div>
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="billToship">
								<label class="form-check-label" for="billToship">Shipping address same as billing address</label>
							</div>
						</div>
						<div class="col-md-6">
							<h3>Shipping To</h3><br>
							<div class="form-group">
								<label for="">Shipping Name</label>
								<input type="text" class="form-control bit-custom-text-field" id="shipping_name" name="shipping_name" required>
							</div>
							<div class="form-group">
								<label for="">Shipping Address</label>
								<input type="text" class="form-control bit-custom-text-field" id="shipping_address" name="shipping_address" required>
							</div>
							<div class="form-group">
								<label for="">Shipping City</label>
								<input type="text" class="form-control bit-custom-text-field" id="shipping_city" name="shipping_city" required>
							</div>
							<div class="form-group">
								<label for="">Shipping State</label>
								<input type="text" class="form-control bit-custom-text-field" id="shipping_state" name="shipping_state" required>
							</div>
							<div class="form-group">
								<label for="">Shipping Postcode</label>
								<input type="text" class="form-control bit-custom-text-field" id="shipping_postcode" name="shipping_postcode" required>
							</div>
							<div class="form-group">
								<label for="">Shipping Mobile</label>
								<input type="text" class="form-control bit-custom-text-field" id="shipping_mobile" name="shipping_mobile" required>
							</div>
						</div>
					</div>
					<input type="submit" class="btn btn-success push-right" value="Checkout">
				</form>
			</div>
		@endsection
		@section('scripts')
			<script>
			// bill to shiping
			$(document).ready(function() {
				$('#billToship').on('click',function(){
					if(this.checked){
						$('#shipping_name').val($('#billing_name').val());
						$('#shipping_address').val($('#billing_address').val());
						$('#shipping_city').val($('#billing_city').val());
						$('#shipping_state').val($('#billing_state').val());
						$('#shipping_postcode').val($('#billing_zipcode').val());
						$('#shipping_mobile').val($('#billing_mobile').val());
					}else{
						$('#shipping_name').val('');
						$('#shipping_address').val('');
						$('#shipping_city').val('');
						$('#shipping_state').val('');
						$('#shipping_postcode').val('');
						$('#shipping_mobile').val('');
					}
				});
			});
		</script>
	@endsection
