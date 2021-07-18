@foreach($gadgetcats as $ct)
@php


$products=DB::table('products')->select('id','cat_id','sub_cat_id','p_name','price','bundle_price','image','status')->orderBy('id',
'DESC')->where('cat_id',$ct->cat_id)->get();
// dd($products);
@endphp


<div class="product_area deals_product_style3 view-btn">

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-6">
                        <div class="product_header">
                            <div class="section_title">
                                <h2>Gadgets That Make Your Life Easy</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <a class="button" href="{{url('/product')}}">View All</a>
                    </div>
                </div>
                <div class="product_area">
                    <div class="product_carousel product_style product_column4 owl-carousel">
                        @foreach (array_chunk($products->toArray(), 2) as $group)
                        <div class="product_items">
                            @foreach ($group as $item)
                            <?php
                        $val=$item->image; $v=json_decode($val); ?>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="/porduct_details/{{$item->id}}"><img
                                                src="{{URL::to('/')}}/images/product/{{$v['0']}}" alt=""
                                                style="height: 297px;" /></a>

                                        <div class="label_product"></div>
                                        <div class="action_links">
                                            <ul>
                                                <li class="wishlist">
                                                    <a class="add_towishlist" type="submit" title="Add to Wishlist">
                                                        <input type="hidden" value="{{$item->id}}" />
                                                        <i class="ion-android-favorite-outline"></i>
                                                    </a>
                                                </li>
                                                <li class="quick_button">
                                                    <a href="/porduct_details/{{$item->id}}" title="View"><i
                                                            class="ion-ios-search-strong"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_content grid_content">
                                        <div class="product_content_inner">
                                            <h4 class="product_name product_name_two">
                                                <a href="/porduct_details/{{$item->id}}">{{$item->p_name}}</a></h4>
                                            <div class="product_rating">

                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">Unit Price: $
                                                    {{number_format($item->price)}}</span>
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
                                                            if(DB::table('all_bids')->where('product_id',$item->id)->whereBetween('created_at',[$start_time,$end_time])->orderBy('id',"DESC")->exists()){
                                                            $bidPrice = DB::table('all_bids')
                                                            ->where('product_id',$item->id)
                                                            ->whereBetween('created_at',[$start_time,$end_time])
                                                            ->orderBy('id',"DESC")
                                                            ->first();
                                                            // dd($all_bids);
                                                            }else{
                                                            $bidPrice = new App\AllBid;
                                                            }
                                                            // dd($bidPrice->your_bid);
                                                            //
                                                            $bidPrice=DB::table('all_bids')->where('product_id',$item->id)->orderBy("id",'DESC')->first();
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
                        </div>
                        @endforeach
                    </div>
                </div>
                <!--product area end-->
            </div>
            </figure>
        </div>
    </div>
</div>


@endforeach
</div>