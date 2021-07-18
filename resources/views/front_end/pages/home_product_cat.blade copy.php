@forelse($categories as $cat)
    @php
        $is_home_categories = DB::table('product_categories')->select('id','cat_name','status')->where('id', $cat['cat_id'])->first();
        // dd($is_home_categories->cat_name);
    @endphp
    @if (isset($is_home_categories))
        @if ($is_home_categories->status == 1)

                @php
                // $sp = DB::table('product_categories')->where('id', $cat['id'])->first();
                    $itemroducts = DB::table('products')->select('id','cat_id','sub_cat_id','p_name','price','bundle_price','image','status')->where('cat_id', $is_home_categories->id)->get();
                @endphp
                <div class="home_section_style4 menu-image">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h1>test</h1>
                            </div>
                        </div>
                        <div class="home_style4_inner">
                            <div class="row no-gutters">
                                <div class="col-lg-3">
                                <div class="category_menu"
                                        style="background-image: linear-gradient(rgba(11, 30, 57, 0.88), rgba(11, 30, 57, 0.88)),url({{asset('front_end/img/bg/banner112.jpg')}});background-position: center;background-size: 380px 497px;">

                                        <div class="section_title s_title_style3">
                                            <h2>{{$is_home_categories->cat_name }}</h2>
                                        </div>
                                        @if(count($cat['subcategories']))
                                        <div class="category_menu_content">
                                            <ul>
                                                {{-- @foreach($cat['subcategories'] as $scat)
                                                <li><a class="get_home_subcat_product" href="javascript:void(0)">{{ $scat['name'] }}
                                                <input type="hidden" value="{{$scat['id']}}"></a></li>
                                                @endforeach --}}
                                                @foreach($cat['subcategories'] as $scat)
                                                <li><a class="get_home_subcat_product"
                                                        href="/cat/{{$scat['id']}}">{{ $scat['name'] }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                </div>



                            <div class="col-lg-9 col-md-12">
                                <!--product area start-->
                                <div class="product_area" id="hproductlist">
                                    <div class="product_carousel product_style product_column6 owl-carousel">
                                        @foreach (array_chunk($itemroducts->toArray(), 2) as $group)
                                        <div class="product_items">
                                            @foreach ($group as $item)
                                            <?php
                                            $val = $item->image;
                                            $v = json_decode($val);
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

                                                            <div class="price_box home-cat">
                                                                <span class="old_price" style="font-size: 12px;">Unit Price: $
                                                                    {{number_format($item->price)}}</span>
                                                            </div>
                                                            <div class="price_box home-cat">

                                                                <span class="current_price"
                                                                    style="display: inline-flex; font-size: 13px;">Biding
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
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
@empty
<h3>No Product Found Or This Product is already slider</h3>
@endforelse
