@extends('front_end.layouts.master')
@section('title','|Product')

@section('content')

@include('front_end.pages.ourJs')
<div class="breadcrumbs_area">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb_content">
					<ul>
						<li><a href="/">home</a></li>
						<li>Product</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="shop_area shop_reverse">
	<div class="container">

		<div class="row">
			@includeIf('front_end.layouts.sidebar')




			<div class="col-lg-9 col-md-12">

				<div class="shop_toolbar_wrapper" style="display: inherit!important;">
					<div class="row no-gutters">
						<div class="col-lg-4 col-md-12" style="margin: 2px 0px 0px 0px;">
							<div class="shop_toolbar_btn">
								<button data-role="grid_4" type="button" class=" active btn-grid-4"
									data-toggle="tooltip" title="4"></button>
								<button data-role="grid_list" type="button" class="btn-list" data-toggle="tooltip"
									title="List"></button>
							</div>
						</div>


						<div class="col-lg-4 col-md-12"></div>
						<div class="col-lg-1 col-md-12 text-left" style="margin: 7px 0px 0px 0px;">
							Order By:
						</div>
						<div class="col-lg-3 col-md-12 text-left">

							<select class="form-control" name="select_price_range select_price_range_two"
								id="select_price_range" style="background:#1664c1; color: #ffffff;">
								<option value="0">Please Select</option>

								<option value="low_to_high">Low to High</option>
								<option value="high_to_low">High to Low</option>
								<option value="a_to_z">A to Z</option>
								<option value="z_to_a">Z to A</option>
							</select>
						</div>




					</div>
				</div>

				<div id="product_loading">

					<div class="row no-gutters shop_wrapper" id="productlist">

						@if(Session::has('test'))
						<!-- /.box-header -->
						<div class="box-body">
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Alert!</h4>
								No Product Found - Please contact us via email : bizdev@freeworldimports.com with a list
								of
								the items that you require and we will source them on your behalf.
							</div>
							@php
							$url = route('productAll');
							Session::forget('test');
							header('Refresh: 8; URL='.$url);
							@endphp
							@endif
							@if(Session::has('category'))
							<!-- /.box-header -->
							<div class="box-body">
								<div class="alert alert-danger alert-dismissible">
									<button type="button" class="close" data-dismiss="alert"
										aria-hidden="true">&times;</button>
									<h4><i class="icon fa fa-ban"></i> Alert!</h4>
									Please check back later - We are constantly updating our catalog. --
								</div>
								@php
								$url = route('productAll');
								Session::forget('category');
								header('Refresh: 8; URL='.$url);
								@endphp
								@endif

								@php
								Session::forget('section');
								@endphp
								@forelse ($product as $p)
								@if ($p->status != '0')


								<div class="col-lg-3 col-md-4 col-12 ">

									<article class="single_product">

										<figure>
											<div class="current-auction-title">
												@if($p->status==2)
												<h4 style="padding: 3px 0px 0px 12px; margin-bottom: 0px;">Countdown
													Finished
												</h4>
												@else
												<h4 style="padding: 3px 0px 0px 12px; margin-bottom: 0px;">AVAILABLE
												</h4>
												@endif
											</div>
											<?php
							            	$val=$p['image'];
								            $v=json_decode($val);

								         ?>
											<div class="product_thumb product_thumb_two"
												style="height: 263px; padding: 10px 0px 0px 10px;">
												<a class="primary_img" href="/porduct_details/{{$p->id}}"><img
														src="{{URL::to('/')}}/images/product/{{$v['0']}}" alt=""></a>

												<div class="label_product">

												</div>
												<div class="action_links">
													<ul>
														<li class="wishlist">

															<a class="add_towishlist" type="submit"
																title="Add to Wishlist">
																<input type="hidden" value="{{$p->id}}">
																<i class="ion-android-favorite-outline"></i></a>
														</li>
														{{-- <li class="compare"><a href="#" title="Add to Compare"><i
																	class="ion-ios-settings-strong"></i></a></li> --}}
														<li class="quick_button"><a href="/porduct_details/{{$p->id}}"
																title="quick view"><i
																	class="ion-ios-search-strong"></i></a></li>
													</ul>
												</div>
											</div>

											<div class="product_content grid_content">
												<div class="product_content_inner">
													<h4 class="product_name product_name_two">
														<a href="/porduct_details/{{$p->id}}">{{$p->p_name}}</a></h4>
													<div class="product_rating">

													</div>
													<div class="price_box">
														<span class="old_price">Unit Price: $
															{{number_format($p->price)}}</span>
													</div>
													<div class="price_box">

														<span class="current_price" style="display: inline-flex;">Biding
															Price: $
															<span>
																<p>
																	@php
																	$start_time =
																	DB::table('bid_resets')->latest()->first()->reset_at;
																	$start_time =
																	Carbon\Carbon::parse($start_time)->subdays(1);
																	$end_time =
																	Carbon\Carbon::parse(DB::table('bid_resets')->latest()->first()->reset_at);
																	if(DB::table('all_bids')->where('product_id',$p->id)->whereBetween('created_at',[$start_time,$end_time])->orderBy('id',"DESC")->exists()){
																	$bidPrice = DB::table('all_bids')
																	->where('product_id',$p->id)
																	->whereBetween('created_at',[$start_time,$end_time])
																	->orderBy('id',"DESC")
																	->first();
																	// dd($all_bids);
																	}else{
																	$bidPrice = new App\AllBid;
																	}
																	// dd($bidPrice->your_bid);
																	//
																	$bidPrice=DB::table('all_bids')->where('product_id',$p->id)->orderBy("id",'DESC')->first();
																	@endphp
																	<span>
																		@if(isset($bidPrice->your_bid))
																		{{  number_format($bidPrice->your_bid != null ? $bidPrice->your_bid : 0)}}
																		@else
																		0
																		@endif
																	</span>
																</p>
															</span>
														</span>
													</div>
												</div>
												<form action="{{url('add-cart')}}" method="POST">
													{{ csrf_field() }}
													<input type="hidden" name="product_id" value="{{$p->id}}"
														id="product_id">
													<input type="hidden" name="product_name" value="{{$p->p_name}}"
														id="product_name">
													<input type="hidden" name="price" value="{{$p->bundle_price}}"
														id="price">
													<input type="hidden" name="quantity" value="1" id="quantity">
													<div class="add_to_cart">
														@if($p->status==2)
														<input type="submit" disabled class="btn btn-primary custom-btn"
															value="Sold Out">
														@else
														<input type="submit" class="btn btn-primary custom-btn"
															value="Submit a Bid">
														@endif
													</div>
											</div>
											<div class="product_content list_content">
												<h4 class="product_name">
													<a href="/porduct_details/{{$p->id}}">{{$p->p_name}}</a>
												</h4>

												<div class="price_box">

													<span class="current_price">$ {{number_format($p->price)}}</span>
												</div>
												<div class="product_desc">
													<p>{!!html_entity_decode($p->p_description)!!}</p>
												</div>
												<div class="add_to_cart">
													@if($p->status==2)
													<input type="submit" disabled class="btn btn-primary custom-btn"
														value="Sold Out">
													@else
													<input type="submit" class="btn btn-primary custom-btn"
														value="Submit a Bid">
													@endif
												</div>
												</form>

											</div>
										</figure>
									</article>
								</div>
								@else
								<h1></h1>
								@endif

								@empty
								<h1></h1>
								@endforelse

							</div>
							<div class="shop_toolbar t_bottom">

								{{ $product->links() }}

							</div>



						</div>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')

<script>
	$(function () {


})
</script>

<script>
	$('#BtnShow').click(function() {
    $('#myBtn').height('auto');
    $('#BtnShow').hide(0);
    $('#BtnHide').show(0);
});
$('#BtnHide').click(function() {
    $('#myBtn').height('200');
    $('#BtnShow').show(0);
    $('#BtnHide').hide(0);
});

</script>
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
<script>
	$( function() {

    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 700,
      values: [ 0, 3000 ],
      slide: function( event, ui ) {
        $( "#ammount_start" ).val( ui.values[ 0 ] );
        $( "#ammount_end" ).val(ui.values[ 1 ] );
        var ammount_start = $('#ammount_start').val();
        var ammount_end = $('#ammount_end').val();
      $.ajax({
                type: 'POST',
                url: '/product-price-range',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "ammount_start": ammount_start,
                    "ammount_end": ammount_end
                },
                success: function(data) {

                    // console.log(data);
                    $("#productlist").html('data');

                }
            })
      }
    });

  } );
</script>



@endsection
