


                            @foreach ($products as $p)
                            {{-- @php
                                        $counter = 1;
                                        $counter2 = 2;
                                        @endphp --}}
                            <?php
                                        $val=$p->image;
                                        $v=json_decode($val);
                                    
                                        ?>
                            <div class="product_items">
                                @if($p->id % 2 == 1)
                                <article class="single_product">
                                    <figure>

                                        <div class="product_thumb">
                                            <a class="primary_img" href="/porduct_details/{{$p->id}}"><img
                                                    src="{{URL::to('/')}}/images/product/{{$v['0']}}" alt=""></a>

                                            <div class="label_product">

                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="wishlist"><a href="#" title="Add to Wishlist"><i
                                                                class="ion-android-favorite-outline"></i></a>
                                                    </li>

                                                    <li class="quick_button"><a href="/porduct_details/{{$p->id}}"
                                                            title="View"><i class="ion-ios-search-strong"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a
                                                        href="/porduct_details/{{$p->id}}">{{$p->p_name}}</a></h4>
                                                {{-- <h4 class="product_name"><a href="product-details.html">{{$p->cat_id}}</a>
                                                </h4> --}}
                                                <div class="price_box">
                                                    <span class="old_price">$ {{number_format($p->price)}}</span>
                                                    <span class="current_price" style="display: inline-flex;">$
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
                                            </form>

                                        </div>

                                    </figure>

                                </article>
                                @endif
                                @if($p->id % 2 == 0)
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="/porduct_details/{{$p->id}}"><img
                                                    src="{{URL::to('/')}}/images/product/{{$v['0']}}" alt=""></a>

                                            <div class="label_product">

                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="wishlist"><a href="#" title="Add to Wishlist"><i
                                                                class="ion-android-favorite-outline"></i></a>
                                                    </li>

                                                    <li class="quick_button"><a href="/porduct_details/{{$p->id}}"
                                                            title="View"><i class="ion-ios-search-strong"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_content">
                                            <div class="product_content_inner">
                                                <h4 class="product_name"><a
                                                        href="/porduct_details/{{$p->id}}">{{$p->p_name}}</a></h4>
                                                {{-- <h4 class="product_name"><a href="product-details.html">{{$p->cat_id}}</a>
                                                </h4> --}}
                                                <div class="price_box">
                                                    <span class="old_price">$ {{number_format($p->price)}}</span>
                                                    <span class="current_price" style="display: inline-flex;">$
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
                                            </form>

                                        </div>

                                    </figure>

                                </article>
                                @endif
                            </div>
                            {{-- @php 
                            $counter++;
                            $counter2++;
                           @endphp --}}
                            @endforeach
