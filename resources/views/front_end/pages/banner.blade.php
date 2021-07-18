<section class="slider_section slider_s_four mb-60 mt-20">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-6">
                <div class="slider_area slider3_carousel owl-carousel">
                    @foreach($slider as $data)
                    <div class="single_slider d-flex align-items-center" data-bgimg="{{ asset('images/slider') }}/{{$data->image}}">
                        <div class="slider_content slider_content_two slider_c_four color_white">
                            <h1>{{$data->title}}</h1>
                            <p>{{$data->subtitle}}</p>
                            <p>{!!$data->description!!}</p>
                            <a class="button" href="{{$data->link}}">Registration</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-3">
                <figure class="single_banner">
                    <div class="banner_thumb banner_thumb_two">
                        <div id="slideshow">
                            @foreach($sliderProduct as $sliders) @php $data = DB::table('products')->where('id', $sliders->pro_id)->first(); $val=$data->image; $v=json_decode($val); @endphp

                            <div>
                                <a href="/porduct_details/{{$data->id}}"><img src="{{ asset('images/product') }}/{{$v['0']}}" /></a>

                                <h1><a href="/porduct_details/{{$data->id}}" style="color: #ff8b03;">{{$data->p_name}}</a></h1>
                                <p>Current Price</p>
                                <h2>${{number_format($data->price)}}</h2>

                                <form action="{{url('add-cart')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" value="{{$data->id}}" id="product_id" />
                                    <input type="hidden" name="product_name" value="{{$data->p_name}}" id="product_name" />
                                    <input type="hidden" name="price" value="{{$data->bundle_price}}" id="price" />
                                    <input type="hidden" name="quantity" value="1" id="quantity" />
                                    <div class="button-two">
                                        @if($data->status==2)
                                        <input type="submit" disabled class="btn btn-primary custom-btn" value="Sold Out" />
                                        @else
                                        <input type="submit" class="btn btn-primary custom-btn" value="Submit a Bid" />
                                        @endif
                                    </div>
                                </form>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </figure>
                <figure class="single_banner">
                    <div class="banner_thumb banner_thumb_two">
                        <div id="slideshow_two">
                            @foreach($sliderProduct2 as $sliderPro) @php $data = DB::table('products')->where('id', $sliderPro->pro_id)->first(); $val=$data->image; $v=json_decode($val); @endphp

                            <div>
                                <a href="/porduct_details/{{$data->id}}"><img src="{{ asset('images/product') }}/{{$v['0']}}" /></a>

                                <h1><a href="/porduct_details/{{$data->id}}" style="color: #ff8b03;">{{$data->p_name}}</a></h1>

                                <p>Current Price</p>
                                <h2>${{number_format($data->price)}}</h2>

                                <form action="{{url('add-cart')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" value="{{$data->id}}" id="product_id" />
                                    <input type="hidden" name="product_name" value="{{$data->p_name}}" id="product_name" />
                                    <input type="hidden" name="price" value="{{$data->bundle_price}}" id="price" />
                                    <input type="hidden" name="quantity" value="1" id="quantity" />
                                    <div class="button-two">
                                        @if($data->status==2)
                                        <input type="submit" disabled class="btn btn-primary custom-btn" value="Sold Out" />
                                        @else
                                        <input type="submit" class="btn btn-primary custom-btn" value="Submit a Bid" />
                                        @endif
                                    </div>
                                </form>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </figure>
            </div>
            <div class="col-lg-3">
                <figure class="single_banner">
                    <div class="banner_thumb banner_thumb_two">
                        <div id="slideshow_three">
                            @foreach($sliderProduct2 as $sliderPro) @php $data = DB::table('products')->where('id',$sliderPro->pro_id)->first(); $val=$data->image; $v=json_decode($val); @endphp

                            <div>
                                <a href="/porduct_details/{{$data->id}}"><img src="{{ asset('images/product') }}/{{$v['0']}}" /></a>

                                <h1><a href="/porduct_details/{{$data->id}}" style="color: #ff8b03;">{{$data->p_name}}</a></h1>
                                <p>Current Price</p>
                                <h2>${{number_format($data->price)}}</h2>

                                <form action="{{url('add-cart')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" value="{{$data->id}}" id="product_id" />
                                    <input type="hidden" name="product_name" value="{{$data->p_name}}" id="product_name" />
                                    <input type="hidden" name="price" value="{{$data->bundle_price}}" id="price" />
                                    <input type="hidden" name="quantity" value="1" id="quantity" />
                                    <div class="button-two">
                                        @if($data->status==2)
                                        <input type="submit" disabled class="btn btn-primary custom-btn" value="Sold Out" />
                                        @else
                                        <input type="submit" class="btn btn-primary custom-btn" value="Submit a Bid" />
                                        @endif
                                    </div>
                                </form>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </figure>
                <figure class="single_banner">
                    <div class="banner_thumb banner_thumb_two">
                        <div id="slideshow_four">
                            @foreach($sliderProduct as $sliders) @php $data = DB::table('products')->where('id', $sliders->pro_id)->first(); $val=$data->image; $v=json_decode($val); @endphp

                            <div>
                                <a href="/porduct_details/{{$data->id}}"><img src="{{ asset('images/product') }}/{{$v['0']}}" /></a>

                                <h1><a href="/porduct_details/{{$data->id}}" style="color: #ff8b03;">{{$data->p_name}}</a></h1>
                                <p>Current Price</p>
                                <h2>${{number_format($data->price)}}</h2>

                                <form action="{{url('add-cart')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" value="{{$data->id}}" id="product_id" />
                                    <input type="hidden" name="product_name" value="{{$data->p_name}}" id="product_name" />
                                    <input type="hidden" name="price" value="{{$data->bundle_price}}" id="price" />
                                    <input type="hidden" name="quantity" value="1" id="quantity" />
                                    <div class="button-two">
                                        @if($data->status==2)
                                        <input type="submit" disabled class="btn btn-primary custom-btn" value="Sold Out" />
                                        @else
                                        <input type="submit" class="btn btn-primary custom-btn" value="Submit a Bid" />
                                        @endif
                                    </div>
                                </form>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </figure>
            </div>
        </div>
    </div>
</section>
