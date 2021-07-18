<div class="container">
    <div class="row no-gutters">

        <div class="col-xl-9 col-lg-8 col-12 order-lg-2">

            <!--product area start-->
            <div class="product_area">
                <div class="row">
                    <div class="col-12">
                        <div class="product_header row">
                            <div class="section_title col-xl-auto col-12">
                                <h2>Hot Sale Items

                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="product_style row" id="hot_sale_item">
                    @php
                        $item = App\HotSaleProduct::orderBy('id', 'DESC')->where('hot_sale_status',1)->get();
                    @endphp
                    @foreach ($item as $data)
                        @php
                            $sp = DB::table('products')->where('id', $data->pro_id)->first();
                        @endphp
                        @if (isset($sp))
                            @php
                                $val = $sp->image;
                                $v = json_decode($val);
                            @endphp

                            <div class="product_items col-md-3 px-0">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="/porduct_details/{{$sp->id}}">
                                                <img src="{{ asset('images/product') }}/{{$v['0']}}" alt="" style="height: 245px;">
                                            </a>
                                            <div class="label_product">

                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="wishlist">
                                                        <a class="add_towishlist" type="submit" title="Add to Wishlist">
                                                            <input type="hidden" value="{{$sp->id}}" />
                                                            <i class="ion-android-favorite-outline"></i>
                                                        </a>
                                                    </li>

                                                    <li class="quick_button"><a href="/porduct_details/{{$sp->id}}"
                                                            title="quick view"><i class="ion-ios-search-strong"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="product_content grid_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name product_name_two">
                                                    <a href="/porduct_details/{{$sp->id}}">{{$sp->p_name}}</a></h4>
                                                <div class="product_rating">

                                                </div>
                                                <div class="price_box">
                                                    <span class="old_price">Unit Price: $
                                                        {{number_format($sp->price)}}</span>
                                                </div>
                                                <div class="price_box">

                                                    <span class="current_price" style="display: inline-flex;">Biding
                                                        Price: $
                                                        <span>
                                                            <p>
                                                                @php
                                                                    $start_time =  DB::table('bid_resets')->latest()->first()->reset_at;
                                                                    $start_time = Carbon\Carbon::parse($start_time)->subdays(1);
                                                                    $end_time = Carbon\Carbon::parse(DB::table('bid_resets')->latest()->first()->reset_at);
                                                                    if(DB::table('all_bids')->where('product_id',$sp->id)->whereBetween('created_at',[$start_time,$end_time])->orderBy('id',"DESC")->exists()){
                                                                        $bidPrice = DB::table('all_bids')
                                                                        ->where('product_id',$sp->id)
                                                                        ->whereBetween('created_at',[$start_time,$end_time])
                                                                        ->orderBy('id',"DESC")
                                                                        ->first();
                                                                    // dd($all_bids);
                                                                    }else{
                                                                        $bidPrice = new App\AllBid();
                                                                    }
                                                                    // dd($bidPrice->your_bid);
                                                                    //
                                                                    // $bidPrice=DB::table('all_bids')->where('product_id',$sp->id)->orderBy("id",'DESC')->first();
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
                                                <input type="hidden" name="product_id" value="{{$sp->id}}"
                                                    id="product_id">
                                                <input type="hidden" name="product_name" value="{{$sp->p_name}}"
                                                    id="product_name">
                                                <input type="hidden" name="price" value="{{$sp->bundle_price}}"
                                                    id="price">
                                                <input type="hidden" name="quantity" value="1" id="quantity">
                                                <div class="add_to_cart">
                                                    @if($sp->status==2)
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

                        @endif

                    @endforeach
                </div> --}}

                <div class="product_style row no-gutters position-relative"  id="hot_sale_item">
                    <div class="col-12 position-relative preloader_body section_preload_block">
                        <div class="preloader_box"></div>
                    </div>

                    <div v-if="loaded" class="section_preload_hide col-12 row no-gutters">
                        <div class="col-12">
                            <div class="custom_paginate">
                                <pagination :show-disabled="true" :data="data" :limit="-1" @pagination-change-page="getResults">
                                    <span slot="prev-nav">&lt; Previous</span>
                                    <span slot="next-nav">Next &gt;</span>
                                </pagination>
                            </div>
                        </div>

                        <div class="product_items col-xs-1 col-sm-4 col-lg-3 col-md-3 col-xl-2" v-for="item in data.data">
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" :href="'/porduct_details/'+item.related_product.id">
                                            <img :src="'/images/product/'+item.related_product.related_image[0]" alt="" style="height: 245px;">
                                        </a>
                                        <div class="label_product">

                                        </div>
                                        <div class="action_links">
                                            <ul>
                                                <li class="wishlist">
                                                    <a class="add_towishlist" type="submit" title="Add to Wishlist">
                                                        <input type="hidden" :value="item.related_product.id" />
                                                        <i class="ion-android-favorite-outline"></i>
                                                    </a>
                                                </li>

                                                <li class="quick_button"><a :href="'/porduct_details/'+item.related_product.id"
                                                        title="quick view"><i class="ion-ios-search-strong"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product_content grid_content">
                                        <div class="product_content_inner">
                                            <h4 class="product_name product_name_two">
                                                <a :href="'/porduct_details/'+item.id">@{{item.related_product.p_name}}</a></h4>
                                            <div class="product_rating">

                                            </div>
                                            <div class="price_box">
                                                <span class="old_price">
                                                    Unit Price: $@{{item.related_product.number_price}}
                                                </span>
                                            </div>
                                            <div class="price_box">

                                                <span class="current_price" style="display: inline-flex;">Biding
                                                    Price: $
                                                    <span>
                                                        <p>
                                                            <span>
                                                                @{{item.related_product.bid_price_your_bid}}
                                                            </span>
                                                        </p>
                                                    </span>
                                                </span>
                                            </div>

                                        </div>
                                        <form action="{{url('add-cart')}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="product_id" :value="item.related_product.id"
                                                id="product_id">
                                            <input type="hidden" name="product_name" :value="item.related_product.p_name"
                                                id="product_name">
                                            <input type="hidden" name="price" :value="item.related_product.bundle_price"
                                                id="price">
                                            <input type="hidden" name="quantity" value="1" id="quantity">
                                            <div class="add_to_cart">
                                                <input type="submit" v-if="item.status == 2" disabled class="btn btn-primary custom-btn" value="Sold Out">
                                                <input type="submit" v-else class="btn btn-primary custom-btn" value="Submit a Bid">
                                            </div>
                                        </form>
                                    </div>
                                </figure>
                            </article>
                        </div>
                    </div>

                    <div v-else class="col-12 position-relative preloader_body section_preload_hide">
                        <div class="preloader_box"></div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-12">
            @php
                $hP = App\HotsaleOfferProduct::orderBy('id', 'DESC')->where('hotsale_position',1)->take(1)->get();
            @endphp
            @foreach($hP as $da)

                @php
                    $sliders =
                    DB::table('products')->select('id','cat_id','sub_cat_id','p_name','price','bundle_price','image','status')->where('id',
                    $da->pro_id)->first();
                    $val=$sliders->image;
                    $v=json_decode($val);

                @endphp
                <figure class="single_banner">
                    <div class="banner_thumb banner_thumb_two">


                        <div>

                            <a href="/porduct_details/{{$sliders->id}}"><img src="{{ asset('images/product') }}/{{$v['0']}}"
                                    style="width: 314px !important; height: 372px !important;"></a>
                            <p>Current Price</p>
                            <h1><a href="/porduct_details/{{$sliders->id}}" style="color: #ff8b03;">{{$sliders->p_name}}</a>
                            </h1>
                            <h2>${{number_format($sliders->price)}}
                            </h2>

                            <form action="{{url('add-cart')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="product_id" value="{{$sliders->id}}" id="product_id">
                                <input type="hidden" name="product_name" value="{{$sliders->p_name}}" id="product_name">
                                <input type="hidden" name="price" value="{{$sliders->bundle_price}}" id="price">
                                <input type="hidden" name="quantity" value="1" id="quantity">
                                <div class="button-two" style="top: 300px !important;">
                                    @if($sliders->status==2)
                                    <input type="submit" disabled class="btn btn-primary custom-btn" value="Sold Out">
                                    @else
                                    <input type="submit" class="btn btn-primary custom-btn" value="Submit a Bid">
                                    @endif
                                </div>
                            </form>
                        </div>




                    </div>
                </figure>
            @endforeach


            <div class="row no-gutters">
                <div class="col-xl-6">
                    <div class="button-hotasle">

                        <a href="{{url('/suppliers-login')}}">Become A Supplier</a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="button-hotasle  mb-r-15">
                        <a href="{{url('/online-ent')}}">Become A Reseller</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
