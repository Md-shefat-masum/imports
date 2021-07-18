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

			@if(Session::has('category'))
			<div class="col-lg-9 col-md-12 text-center">
				<div class="alert alert-danger"><strong>No product found</strong></div>
			</div>
			@php
			$url = route('webproduct');
			Session::forget('category');
			header('Refresh: 8; URL='.$url);
			@endphp
			@endif

			<div class="col-lg-9 col-md-12">

				<div class="shop_toolbar_wrapper">

					<div class="shop_toolbar_btn">
						<button data-role="grid_4" type="button" class=" active btn-grid-4" data-toggle="tooltip"
							title="4"></button>
						<button data-role="grid_list" type="button" class="btn-list" data-toggle="tooltip"
							title="List"></button>
					</div>
					<div class="page_amount" style="margin: 0px 20px 0px 0px; display: inline-flex;">
					<p style="margin: 7px 10px 0px 0px;">Sortby:</p>

						<select class="form-control" name="select_price_range select_price_range_two" id="select_price_range" style="background:#1664c1; color: #ffffff;">
							<option>Please Select</option>
							<option value="low_to_high">Low to high</option>
							<option value="high_to_low">High to Low</option>
							<option value="a_to_z">A to z</option>
							<option value="z_to_a">Z to A</option>
						</select>

					</div>
				</div>


				{{-- @if(Session::has('category')) --}}

				<div class="row no-gutters shop_wrapper">


					@if(Session::has('category'))
					<!-- /.box-header -->
					<div class="box-body">
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Alert!</h4>
							Please check back later - We are constantly updating our catalog. --
						</div>
						@php
						$url = route('productAll');
						Session::forget('category');
						header('Refresh: 8; URL='.$url);
						@endphp
						@endif


						@foreach($products as $p)

						<?php
							  $val=$p->image;
								$v=json_decode($val,true);
							?>


						<div class="col-lg-3 col-md-4 col-12 ">

							<article class="single_product">
								<div class="current-auction-title">
									@if($p->status==2)
									<h4 style="padding: 3px 0px 0px 12px; margin-bottom: 0px;">Countdown Finished</h4>
									@else
									<h4 style="padding: 3px 0px 0px 12px; margin-bottom: 0px;">AVAILABLE</h4>
									@endif
								</div>
								<figure>
									<?php
									$val=$p['image'];
									$v=json_decode($val);

									?>
									<div class="product_thumb product_thumb_two">
										<a class="primary_img" href="/porduct_details/{{$p->id}}"><img
												src="{{URL::to('/')}}/images/product/{{$v[0]}}" alt=""></a>

										<div class="label_product">

										</div>
										<div class="action_links">
											<ul>
												<li class="wishlist"><a href="#" title="Add to Wishlist"><i
															class="ion-android-favorite-outline"></i></a></li>
												<li class="compare"><a href="#" title="Add to Compare"><i
															class="ion-ios-settings-strong"></i></a></li>
												<li class="quick_button"><a href="#" data-toggle="modal"
														data-target="#modal_box" title="quick view"><i
															class="ion-ios-search-strong"></i></a></li>
											</ul>
										</div>
									</div>

									<div class="product_content grid_content">
										<div class="product_content_inner">
											<h4 class="product_name product_name_two">
												<a href="/porduct_details/{{$p->id}}">{{$p->p_name}}</a>
											</h4>
											<div class="product_rating">
												<ul>
													<li><a href="#"><i class="ion-android-star-outline"></i></a></li>
													<li><a href="#"><i class="ion-android-star-outline"></i></a></li>
													<li><a href="#"><i class="ion-android-star-outline"></i></a></li>
													<li><a href="#"><i class="ion-android-star-outline"></i></a></li>
													<li><a href="#"><i class="ion-android-star-outline"></i></a></li>
												</ul>
											</div>
											<div class="price_box">
												{{-- <span class="old_price">$80.00</span> --}}
												<span class="current_price">$ {{number_format($p->price)}}</span>
											</div>
										</div>
										<div class="add_to_cart">
											<a href="#" title="Submit A Bid">Submit A Bid</a>
										</div>
									</div>
									<div class="product_content list_content">
										<h4 class="product_name"><a
												href="/porduct_details/{{$p->id}}">{{$p->p_name}}</a>
										</h4>
										<div class="product_rating">
											<ul>
												<li><a href="#"><i class="ion-android-star-outline"></i></a></li>
												<li><a href="#"><i class="ion-android-star-outline"></i></a></li>
												<li><a href="#"><i class="ion-android-star-outline"></i></a></li>
												<li><a href="#"><i class="ion-android-star-outline"></i></a></li>
												<li><a href="#"><i class="ion-android-star-outline"></i></a></li>
											</ul>
										</div>
										<div class="price_box">
											<span class="old_price">$80.00</span>
											<span class="current_price">$ {{$p->price}}</span>
										</div>
										<div class="product_desc">
											<p>{!!html_entity_decode($p->p_description)!!}</p>
										</div>
										<div class="add_to_cart">
											<a href="#" title="Submit A Bid">Submit A Bid</a>
										</div>
										<div class="action_links">
											<ul>
												<li class="wishlist"><a href="#" title="Add to Wishlist"><i
															class="ion-android-favorite-outline"></i> Add to
														Wishlist</a>
												</li>
												<li class="compare"><a href="#" title="Add to Compare"><i
															class="ion-ios-settings-strong"></i> Compare</a></li>
												<li class="quick_button"><a href="#" data-toggle="modal"
														data-target="#modal_box" title="quick view"><i
															class="ion-ios-search-strong"></i> quick view</a></li>
											</ul>
										</div>
									</div>
								</figure>
							</article>
						</div>
						@endforeach

					</div>
					<div class="shop_toolbar t_bottom">

						{{ $products->links() }}

					</div>



				</div>


			</div>
		</div>
	</div>
	@endsection
