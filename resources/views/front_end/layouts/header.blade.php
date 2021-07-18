<header>
    <div class="main_header">
        <div class="container">
            <!--header top start-->
            <div class="header_top">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-2">
                        <div class="antomi_message">
                            {{-- <p>Get free shipping – Free 30 day money back guarantee</p> --}}
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-10">
                        <div class="header_top_settings text-right">
                            @php
                            $quickContact = DB::table('quick_contacts')->first();
                            @endphp
                            <ul>
                                <li><a href="#"> {{ $quickContact->address_first }} {{ $quickContact->address_second }}
                                        {{ $quickContact->address_third }}</a></li>
                                <li><a href="#"> {{ $quickContact->email }}</a></li>
                                <li>Hotline: <a href="tel:+(012)800456789"> {{ $quickContact->phone }} </a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--header top start-->

            <!--header middel start-->
            <div class="header_middle sticky-header">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-3 col-4">
                        <div class="logo">
                            <a href="/"><img src="{{asset('front_end/img/logo/logo.png')}}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="main_menu menu_position text-center">
                            <nav>
                                <ul>
                                    @if(!isset($menu))
                                    @php
                                    $menu = DB::table('menus')->get();
                                    @endphp
                                    @endif
                                    @foreach($menu as $m)
                                    @if($m->status==1)


                                    <li class="">
                                        <a class=""
                                            href="{!! ($m->slug == '/partners') ? url('#') : url($m->slug) !!}">{{$m->menu}}</a>
                                        @php
                                        $submenus=DB::table('submenus')->where('menu_id',$m->id)->get();
                                        @endphp
                                        @if(count($submenus)>0)

                                        <ul class="sub_menu pages">
                                            @foreach($submenus as $submenu)

                                            <li><a href="{!! url($submenu->link) !!}">
                                                    {{$submenu->submenu}}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>

                                        @endif
                                    </li>

                                    @endif
                                    @endforeach


                                    @if(Auth::user())
                                    <li class="">
                                        <a class="" href="{{url('/contact')}}">Contact</a>
                                    </li>
                                    <li class="">
                                        <a class="nav-link dropdown-toggle custom-dropdown-toggle"
                                            href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" id="navbarDropdown">
                                            Logout
                                            <span class="submen-toggle"></span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                        <ul class="sub_menu pages">
                                            <li><a class="" href="{{ route('my-profile') }}">My Profile</a></li>
                                            <li><a class="" href="{{ route('my-order') }}">My Order</a></li>
                                        </ul>
                                    </li>
                                    @else
                                    <li class="">
                                        <a class="" href="{{url('/contact')}}">Contact</a>

                                    </li>
                                    <li class="">
                                        <a class="" href="{{url('/user-login')}}">Login</a>

                                    </li>
                                    @endif

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-7 col-6">
                        <div class="header_configure_area">
                            <div class="header_wishlist">
                                <a href="{{route('wishlist_page')}}"><i class="ion-android-favorite-outline"></i>
                                    {{-- check if login --}}
                                    {{--if login --}}
                                    {{-- if is not login --}}
                                    @php
                                    $auth_user = Auth::user();

                                    @endphp
                                    @if(isset($auth_user))
                                    @php
                                    $wishlist = DB::table('wish_lists')->where('user_id', $auth_user->id)->get();

                                    @endphp
                                    <span class="wishlist_count wishlist_updatecount">{{ count($wishlist) }}</span>
                                    @else
                                    <span class="wishlist_count">0</span>
                                    @endif

                                </a>
                            </div>
                            <div class="mini_cart_wrapper">
                                <a href="{{url('/cart')}}">
                                    <i class="fa fa-shopping-bag"></i>
                                    {{-- <span class="cart_price">$152.00 </span> --}}
                                    <span class="cart_count">
                                        @if (isset($r))
                                        {{ $r }}
                                        @else
                                        {{ $i ?? '0' }}
                                        @endif</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--header middel end-->


            <!--header bottom satrt-->
            <div class="header_bottom">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-md-9">
                        <div class="search_container">
                            <form class="" action="{{ route('serach_this_roduct') }}" method="get">
                                <div class="hover_category main_cat">
                                    <select class="select_option" name="select" id="categori2">
                                        <option selected value="1">All Categories</option>
                                        @php
                                        $p_cat = App\ProductCategory::orderBy('created_at', 'DESC')->get();
                                        @endphp
                                        @foreach($p_cat as $items)
                                        <option value="{{ $items->id }}">{{ $items->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="search_box">
                                    
                                    <input type="text" name="search" id="search"
                                        class="form-control custom-form-control" placeholder="Search For Products ..."
                                        aria-label="Username" aria-describedby="basic-addon1">
                                    <button type="submit">Search</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="header_bigsale">
                            @php
                            $big= DB::table('big_sales')->orderBy('id','DESC')->take(1)->get();
                            @endphp
                            @foreach ($big as $item)

                            <a href="{{route('bigsale_discount_page')}}">{{$item->title}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!--header bottom end-->
        </div>
    </div>
</header>