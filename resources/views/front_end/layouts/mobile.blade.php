{{-- for mobile responsive --}}

<div class="Offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="canvas_open">
                    <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                </div>
                <div class="Offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                    </div>
                    <div class="antomi_message">
                    
                    </div>
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


                    <div class="search_container">
                        <form class="" action="{{ route('serach_this_roduct') }}" method="get">
                            <div class="hover_category">
                                <select class="select_option" name="select" id="categori1">
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
                    <div id="menu" class="text-left ">

                        <ul class="offcanvas_main_menu">
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

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>