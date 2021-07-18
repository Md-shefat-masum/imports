
				@foreach ($group as $item)
				<?php
				$val=$item->image;
				$v=json_decode($val);
			
				?>
				<article class="single_product">
					<figure>
						<div class="product_thumb">
							<a class="primary_img" href="/porduct_details/{{$item->id}}"><img
									src="{{URL::to('/')}}/images/product/{{$v['0']}}" alt=""></a>

							<div class="label_product">

							</div>
							<div class="action_links">
								<ul>
									<li class="wishlist">

										<a class="add_towishlist" type="submit" title="Add to Wishlist">
											<input type="hidden" value="{{$item->id}}">
											<i class="ion-android-favorite-outline"></i></a>
									</li>

									<li class="quick_button"><a href="/porduct_details/{{$item->id}}"
											title="View"><i class="ion-ios-search-strong"></i></a>
									</li>
								</ul>
							</div>
						</div>
						<div class="product_content">
							<div class="product_content_inner">
								<h4 class="product_name"><a
										href="/porduct_details/{{$item->id}}">{{$item->p_name}}</a></h4>

								<div class="price_box">
									<span class="old_price">$65.00</span>
									<span class="current_price">$60.00</span>
								</div>
							</div>
							<form action="{{url('add-cart')}}" method="POST">
								{{ csrf_field() }}
								<input type="hidden" name="product_id" value="{{$item->id}}"
									id="product_id">
								<input type="hidden" name="product_name" value="{{$item->p_name}}"
									id="product_name">
								<input type="hidden" name="price" value="{{$item->bundle_price}}"
									id="price">
								<input type="hidden" name="quantity" value="1" id="quantity">
								<div class="add_to_cart">
									@if($item->status==2)
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
				@endforeach
