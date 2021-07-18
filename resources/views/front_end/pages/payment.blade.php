@extends('front_end.layouts.master')
@section('title','|About')
@section('stylesheet')
@endsection
@section('content')
	<br><br>
	<div class="container">
		<div class="row">
			@if (session('message'))
				<div class="alert alert-success">
					{{ session('message') }}
				</div>
			@endif
			<div class="col-md-6 offset-md-3">
				<h3 class="text-center">Payment Method</h3> <br>
				<table class="table">
					<tbody>
						<tr>
							<td style="padding-left: 0;">Biding Amount</td>
							<td>
								@php
								$total = 0;
								$session_id=Session::get('session_id');
								$userCart = DB::table('carts')->where(['session_id'=>$session_id])->get();
								foreach($userCart as $cart)
								{
									$bid_info = DB::table('all_bids')->where('product_id',$cart->product_id)->select('bid_price','quantity','discount_price')->orderBy('id',"DESC")->first();
									// dd($bid_info);
									if(isset($bid_info->quantity))
									{
										$quantity = $bid_info->quantity;
										// $price = $bid_info->bid_price-$bid_info->discount_price;
										// $price = $bid_info->bid_price;
										$price = $bid_info->discount_price;


									} else {
										$quantity =1;
										$price = 0;
									}

									$total +=($price*$quantity);
									// dd($total);
								}

								@endphp
								${!! number_format($total,2) !!}
							</td>
						</tr>

					</tbody>
				</table><hr>

				<form action="{{url('place-order')}}" method="post">
					{{ csrf_field() }}

					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Shipping Amount</label>
						<div class="col-sm-8">
							<div class="custom-control custom-radio">
								<input type="radio" checked id="freeAmount" name="shipping_amount" class="custom-control-input" value="0">
								<label class="custom-control-label" for="freeAmount">Delivery Charges TBD</label>
							</div>
							<div class="custom-control custom-radio">
								<input type="radio" id="customRadioAmount" name="shipping_amount" class="custom-control-input" value="">
								<label class="custom-control-label" for="customRadioAmount"><input id="shippingAmount" type="text" name="shipping_amount" class="form-control" placeholder="Amount" > </label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">Payment Method</label>
						<div class="col-sm-8">
							<div class="custom-control custom-radio">
								<input type="radio" id="customRadio1" name="payment_type" class="custom-control-input" value="Direct Bank Transfer" required>
								<label class="custom-control-label" for="customRadio1">Direct Bank Transfer
								</label>
							</div>
							<div class="custom-control custom-radio">
								<input type="radio" id="customRadio2" name="payment_type" class="custom-control-input" value="Cheque Payments">
								<label class="custom-control-label" for="customRadio2">Cheque Payments</label>
							</div>
							<div class="custom-control custom-radio">
								<input type="radio" id="customRadio3" name="payment_type" class="custom-control-input track-order-change" value="vpos">
								<label class="custom-control-label" for="customRadio3">Virtual Point of Sale Operator (VPOS)</label>
							</div>
							<div class="custom-control custom-radio">
                                <input type="radio" id="customRadio4" name="payment_type" class="custom-control-input track-order-change" value="epaymaker">
                                <label class="custom-control-label" for="customRadio4">ePayMaker Online Payment</label>
                            </div>
						</div>
					</div>
					<br/>
					<div class="col-xs-12 panel-collapse collapse" id="firstAccordion">
						<div class="Custom-VPOS-form">
							<div class="form-group row">
								<label for="inputPassword" class="col-sm-4 col-form-label"></label>
								<div class="col-sm-8" style="padding-left: 33px;">
									<input type="checkbox" class="form-check-input" id="billToship">
									<label class="form-check-label" for="billToship">User address same as Vpos address</label>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword" class="col-sm-4 col-form-label">Full Name</label>
								<div class="col-sm-8">
									<input type="text" name="full_name" id="full_name" class="form-control" id="inputPassword">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword" class="col-sm-4 col-form-label">Telephone Number</label>
								<div class="col-sm-8">
									<input type="text" name="telephone" id="telephone" class="form-control" id="inputPassword">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword" class="col-sm-4 col-form-label">Email Address *</label>
								<div class="col-sm-8">
									<input type="email" name="email" id="email" class="form-control" id="inputPassword" >
								</div>
							</div>
							<div class="form-group row">
								<label for="inputPassword" class="col-sm-4 col-form-label">Comments *</label>
								<div class="col-sm-8">
									<textarea  name="comment" class="form-control" maxlength="1000" cols="25" rows="6" placeholder="This is the transaction that will be completed by a VPOS"></textarea>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group row">
						<button type="submit" class="btn btn-outline-info custom-btn">
							PLACE ORDER
						</button>
					</div>
				</form>

			</div>
		</div>
	</div>
@php
	$user = \Auth::user();
@endphp
	<input type="hidden" name="user_name" id="user_name" value="{{ $user->first_name }} {{ $user->last_name }}">
	<input type="hidden" name="user_email" id="user_email" value="{{ $user->email }}">
	<input type="hidden" name="user_cell_phone" id="user_cell_phone" value="{{ $user->cell_phone }}">
@endsection

@section('scripts')
	<script>
	function validateForm() {
		var payment_type = $('#payment_type').val();

		//if(payment_type=='vpos')
		if ($('#customRadio3').is(":checked"))
		{
			return true;
		} else  {
			//window.open("https://geniecashbox.com/pol/?cashbox=8002598076&paytype=check", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
			return true;
		}

	}

	$('input[name="payment_type"]').change( function() {

		if ($('#customRadio3').is(":checked")){

			$('#firstAccordion').show('show');

		} else {

			$('#firstAccordion').hide('hide');
		}
	});

	$(document).ready(function(){
		var name = $('#user_name').val();
		var email = $('#user_email').val();
		var phone = $('#user_cell_phone').val();

		$("#billToship").click(function(){
			if (this.checked) {
				$('#full_name').val(name);
				$('#telephone').val(phone);
				$('#email').val(email);
			}else {
				$('#full_name').val('');
				$('#telephone').val('');
				$('#email').val('');
			}
		});
	});

	</script>
@endsection
