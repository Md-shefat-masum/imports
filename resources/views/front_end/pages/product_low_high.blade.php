@forelse ($product as $p)
@if ($p->status != '0')


<div class="col-lg-3 col-md-4 col-12 ">
	<article class="single_product">
		<div class="current-auction-title">
			@if($p->status==2)
			<h4 style="padding: 3px 0px 0px 12px; margin-bottom: 0px;">Countdown
				Finished
			</h4>
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
						src="{{URL::to('/')}}/images/product/{{$v['0']}}" alt=""></a>

				<div class="label_product">

				</div>
				<div class="action_links">
					<ul>
						<li class="wishlist"><a href="#" title="Add to Wishlist"><i
									class="ion-android-favorite-outline"></i></a></li>
						<li class="compare"><a href="#" title="Add to Compare"><i
									class="ion-ios-settings-strong"></i></a></li>
						<li class="quick_button"><a href="#" data-toggle="modal" data-target="#modal_box"
								title="quick view"><i class="ion-ios-search-strong"></i></a></li>
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
					<input type="hidden" name="product_id" value="{{$p->id}}" id="product_id">
					<input type="hidden" name="product_name" value="{{$p->p_name}}" id="product_name">
					<input type="hidden" name="price" value="{{$p->bundle_price}}" id="price">
					<input type="hidden" name="quantity" value="1" id="quantity">
					<div class="add_to_cart">
						@if($p->status==2)
						<input type="submit" disabled class="btn btn-primary custom-btn" value="Sold Out">
						@else
						<input type="submit" class="btn btn-primary custom-btn" value="Submit a Bid">
						@endif
					</div>
			</div>
			<div class="product_content list_content">
				<h4 class="product_name">
					<a href="/porduct_details/{{$p->id}}">{{$p->p_name}}</a>
				</h4>
				<div class="product_rating">
					<ul>
						<li><a href="#"><i class="ion-android-star-outline"></i></a>
						</li>
						<li><a href="#"><i class="ion-android-star-outline"></i></a>
						</li>
						<li><a href="#"><i class="ion-android-star-outline"></i></a>
						</li>
						<li><a href="#"><i class="ion-android-star-outline"></i></a>
						</li>
						<li><a href="#"><i class="ion-android-star-outline"></i></a>
						</li>
					</ul>
				</div>
				<div class="price_box">

					<span class="current_price">$ {{number_format($p->price)}}</span>
				</div>
				<div class="product_desc">
					<p>{!!html_entity_decode($p->p_description)!!}</p>
				</div>
				<div class="add_to_cart">
					@if($p->status==2)
					<input type="submit" disabled class="btn btn-primary custom-btn" value="Sold Out">
					@else
					<input type="submit" class="btn btn-primary custom-btn" value="Submit a Bid">
					@endif
				</div>
				</form>
				<div class="action_links">
					<ul>
						<li class="wishlist"><a href="#" title="Add to Wishlist"><i
									class="ion-android-favorite-outline"></i> Add to
								Wishlist</a>
						</li>
						<li class="compare"><a href="#" title="Add to Compare"><i class="ion-ios-settings-strong"></i>
								Compare</a>
						</li>
						<li class="quick_button"><a href="#" data-toggle="modal" data-target="#modal_box"
								title="quick view"><i class="ion-ios-search-strong"></i> quick view</a>
						</li>
					</ul>
				</div>
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
