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
	<div class="row">
		<div class="col-md-8 offset-md-2">
			
			
			<ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Shipping Info
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Payment Method
					</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<form action="">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">First Name<sup>*</sup></label>
									<input type="text" class="form-control bit-custom-text-field" name="f_name" required="">
								</div>
								<div class="form-group">
									<label for="">Company</label>
									<input type="text" class="form-control bit-custom-text-field" name="company">
								</div>
								<div class="form-group">
									<label for="">Email <sup>*</sup></label>
									<input type="email" class="form-control bit-custom-text-field" name="company">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Last Name<sup>*</sup></label>
									<input type="text" class="form-control bit-custom-text-field" name="l_name" required="">
								</div>
								<div class="form-group">
									<label for="">City</label>
									<input type="text" class="form-control bit-custom-text-field" name="company">
								</div>
								<div class="form-group">
									<label for="">Phone <sup>*</sup></label>
									<input type="email" class="form-control bit-custom-text-field" name="company">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="">Address<sup>*</sup></label>
									<textarea name="address" id="" cols="30" rows="5" class="form-control bit-custom-text-field"></textarea>
								</div>
							</div>
						</div>
						<br>
						<input type="submit" class="btn btn-success custom-btn" value="Checkout">
					</form>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="row">
						<div class="col-md-8 offset-md-2">
							<ul class="list-group">
								<li class="list-group-item d-flex justify-content-between align-items-center">
									Cart Subtotal	


									<span class="badge badge-primary badge-pill">$58.00</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									Shipping	
									<span class="badge badge-primary badge-pill">Free Delivery</span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									Total
									<span class="badge badge-primary badge-pill">$58.00</span>
								</li>
								
  <div class="custom-control custom-checkbox mb-3">
    <input type="checkbox" class="custom-control-input" id="customControlValidation1" required>
    <label class="custom-control-label" for="customControlValidation1">Direct Bank Transfer
</label>
    </div>
  <div class="custom-control custom-checkbox mb-3">
    <input type="checkbox" class="custom-control-input" id="customControlValidation2" required>
    <label class="custom-control-label" for="customControlValidation2">Cheque Payment</label>
   
  </div>
  <div class="custom-control custom-checkbox mb-3">
    <input type="checkbox" class="custom-control-input" id="customControlValidation3" required>
    <label class="custom-control-label" for="customControlValidation3">
Paypal</label>
    <!-- <div class="invalid-feedback">Example invalid feedback text</div> -->
  </div>
     
  
								<input type="submit" class="btn btn-outline-success custom-btn" value="Place Order">
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
@endsection