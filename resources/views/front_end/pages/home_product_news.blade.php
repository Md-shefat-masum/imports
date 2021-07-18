<div class="shop_area shop_reverse" style="padding: 0;">
    <div class="container">
        <div class="section_title">
            <h2>FREEWORLD NEWS</h2>

        </div>
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <!--sidebar widget start-->
                <aside class="sidebar_widget">
                    <div class="widget_list widget_categories">
                        {{-- <h3>FREEWORLD NEWS</h3> --}}
                        <ul>
                            {{-- <li><a class="" href="{{url("/forum/supplier")}}">All</a> --}}
                            @php
                            $blog_cat = App\Blog::select('id','category','image','sub_category','title','status')->where('status', '1')->where('type', 'supplier')->get();
                            @endphp
                            {{-- <li>
                                <a class="get_subcat" href="javascript:void(0)" data-id="all" style="border-radius: 0px;margin-right: -3px;">All</a>
                            </li> --}}

                            @foreach ($blog_cat->unique('category') as $b_cat)
                            <li class="widget_sub_categories"><a class="get_cat_blog" data-id="{{ $b_cat->category }}">
                                    @php
                                    $blog_cat = DB::table('blog_category')->where('id', $b_cat->category)->first();

                                    $blog_sub_cat = DB::table('blog_sub_cat')->where('status', '1')->where('cat_id',
                                    $blog_cat->id)->get();
                                    @endphp
                                    {{ isset($blog_cat->cat_name) ? $blog_cat->cat_name : '' }}
                                    {{-- @if (count($blog_sub_cat) > 0)
                                    <span>&nbsp;&nbsp; <i class="fas fa-angle-down"></i></span>
                                    @endif --}}
                                </a>
                                @if (count($blog_sub_cat) > 0)
                                <ul class="widget_dropdown_categories" style="display: none;">
                                    @foreach ($blog_sub_cat as $blog_sub_ca)
                                    <li><a class="get_subcat"
                                            data-id="{{ $blog_sub_ca->id }}">{{ $blog_sub_ca->sub_cat_name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif

                            </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
                <!--sidebar widget end-->
            </div>
            @php
            $blog=App\Blog::select('id','category','image','sub_category','title','status')->where('type','supplier')->where('status', 1)->orderBy('created_at', 'DESC')->paginate(12);
            @endphp
            <div class="col-lg-9 col-md-12">


                <!--shop wrapper start-->
                <div class="row no-gutters shop_wrapper subcat_blog" style="margin-bottom: 0;">
                    @foreach($blog as $b)
                    <div class="col-lg-3 col-md-4 col-12 ">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a href="{!! url('blog-details/'.$b->id) !!}"><img
                                            src="{{URL::to('/')}}/images/blog/{{$b->image}}" alt=""
                                            style="height: 243px;"></a>
                                    <div class="label_product">

                                    </div>

                                </div>

                                <div class="product_content grid_content">
                                    <div class="product_content_inner">
                                        <?php $readmore="...";?>
                                        <h4 class="product_name product_name_two"><a
                                                href="{!! url('blog-details/'.$b->id) !!}">
                                                {{ substr(strip_tags($b->title), 0,50) }}
                                                {{ strlen(strip_tags($b->title)) > 50 ? "$readmore" : "" }}
                                            </a></h4>
                                        <div class="price_box" style="padding: 20px 0px 0px 0px;">
                                            {{-- <span class="old_price">$80.00</span> --}}
                                            <div class="current_price_two">
                                                <span class="current_price"> <a
                                                        href="{!! url('blog-details/'.$b->id) !!}"> Read More</a></span>
                                                <br>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </figure>
                        </article>
                    </div>
                    @endforeach
                </div>


                <!--shop toolbar end-->
                <!--shop wrapper end-->
            </div>
        </div>
    </div>
</div>
