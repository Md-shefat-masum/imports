<div class="leftbar">
    <!-- Start Sidebar -->
    <div class="sidebar">
        <!-- Start Logobar -->
        <div class="logobar">
            <a href="" class="logo logo-large"><img src="{{asset('admin/assets/images/logo.png')}}"
                    class="img-fluid" alt="logo"></a>
            <a href="" class="logo logo-small"><img src="{{asset('admin/assets/images/icon.png')}}"
                    class="img-fluid" alt="logo"></a>
        </div>
        {{-- <div class="logobar">
            <a href="" class="logo logo-large"><img src="{{asset('admin/assets/images/users/images.png')}}"
                class="img-fluid" alt="logo" style="width: 50px; border-radius:30px;"></a>

            <h5 style="color:#ffffff; margin-top:10px; ">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h5>
        </div> --}}
        <!-- End Logobar -->
        <!-- Start Navigationbar -->
        <div class="navigationbar">
            {{-- <div class="scroll-side"> --}}
            @php
            $group_id = Auth::user()->group_id;
            @endphp
            <ul class="vertical-menu">
                @if($group_id==1)
                <li>
                    <a href="/dashboard">
                        <img src="{{asset('admin/assets/images/svg-icon/dashboard.svg')}}" class="img-fluid"
                            alt="dashboard"><span>Dashboard</span></i>
                    </a>
                </li>
                @endif

                {{-- <li>
                    <a href="javaScript:void();">
                        <img src="{{asset('admin/assets/images/svg-icon/components.svg')}}" class="img-fluid"
                            alt="layouts"><span>Website Management</span><i
                            class="feather icon-chevron-right pull-right"></i>
                    </a>
                    <ul class="vertical-submenu"> --}}
                        @if($group_id==1)
                        <li><a href="{{ route('reset_bid_price') }}"><i class="dripicons-scale"></i></i>Bid Price Reset Now</a></li>
                        <li><a href="{{ route('bid_reset') }}"><i class="dripicons-scale"></i></i>Bid reset time</a></li>
                        <li><a href="{{ route('big_sales') }}"><i class="dripicons-scale"></i></i>Big Sale Contents</a></li>
                        <li><a href="{{route('blogpopupProduct')}}"><i class="dripicons-scale"></i></i>Add Popup</a></li>

                        <li><a href="#"><i class="dripicons-scale"></i></i>Home Page Manager<i class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">
                                <li><a href="{{url('/pages/menus')}}">Menus</a></li>
                                <li><a href="{{url('/pages/submenus')}}">Sub Menus</a></li>
                                <li><a href="{{url('/pages/megamenus')}}">Mega Menus</a></li>
                                <li><a href="{{url('/pages/services')}}">How It Works</a></li>
                                <li><a href="{{url('/pages/tes')}}">Testimonials</a></li>
                                <li><a href="{{url('/pages/sliders')}}">Sliders</a></li>
                                <li><a href="{{route('hotsaleProduct')}}">Hot Sale Offer Product</a></li>

                            </ul>
                        </li>
                        <li><a href="#"><i class="dripicons-scale"></i></i>Page Manager<i class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">
                                <li><a href="{{url('/pages/contact')}}">Contact Us</a></li>
                                <li><a href="{{url('/pages/aboutOne')}}">About Us</a></li>
                                <li><a href="{{url('/pages/services')}}">Services</a></li>
                                <li><a href="{{url('/pages/faqs')}}">FAQ</a></li>
                                <li><a href="{{url('/pages/policy')}}">Privency Policy</a></li>
                                <li><a href="{{url('/pages/terms')}}">Terms And Condition</a></li>
                                <li><a href="{{ route('supplier-forum.index') }}"><span>Supplier</span></a></li>
                                <li><a href="{{ route('enterprenor-forum.index') }}"><span>Entrepreneur</span></a></li>
                                <li class=""><a href="{{ route('commentSection') }}">Comment Section</a></li>

                            </ul>
                        </li>
                        <li><a href="#"><i class="dripicons-scale"></i></i>E-Commerce <br> Functionality<i
                                    class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">

                                <li><a href="{{url('/pages/subCategory')}}">Sub Category</a></li>
                                <li><a href="{{url('/pages/units')}}">Unit</a></li>
                                <li><a href="{{route('brand')}}">Brand</a></li>
                                {{-- <li><a href="{{route('test')}}">test</a></li> --}}
                                <li><a href="{{url('/pages/p_category')}}">Product Category</a></li>
                                <li><a href="{{url('/pages/product')}}">Product</a></li>
                                <li><a href="{{url('/pages/slider_product')}}">Slider Product</a></li>
                                <li><a href="{{url('/pages/homecat_product')}}">Home Product Category</a></li>
                                <li class=""><a href="{{route('discount')}}">Home Product Category Discount</a></li>
                                <li class=""><a href="{{route('discountProduct')}}">Discount Product List</a></li>
                                {{-- <li><a href="{{route('category_offer')}}">Home Category Offer</a></li> --}}
                                {{-- <li><a href="{{route('gadgets_banner')}}">Gadgets Banner</a></li> --}}
                                <li><a href="{{route('gadgetscatProduct')}}">Gadgets Product Category</a></li>
                                <li><a href="{{url('/pages/hot_sale_product')}}">Hot Sale Product</a></li>

                                {{-- <li><a href="{{route('hotsale_date')}}">Hot Sale Date</a></li> --}}
                                <li><a href="{{ route('linkProduct') }}">Product Link</a></li>
                                <li><a href="{{ route('homeProduct') }}">Home Product</a></li>
                                <li><a href="{{ route('auctionProduct') }}">Current Auction</a></li>
                                @if (Auth::user()->group_id != 1)
                                <li><a href="{{ route('supplierApprove') }}">Supplier Products</a></li>
                                @endif
                                <li><a href="{{  route('supplier_pro_request') }}">Supplier Products Request</a></li>
                                <li><a href="{{  route('supplier_pro_approve') }}">Supplier Approved Products</a></li>
                                <li><a href="{{ route('enterprenorApprove') }}">Enterprenor Products</a></li>



                            </ul>
                        </li>
                        <li><a href="#"><i class="dripicons-scale"></i></i>Partner<i class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">
                                <li><a href="{{ route('userSuppliers') }}">Suppler Request</a></li>
                                <li><a href="{{ route('userEntrepreneurs') }}">Enterprenor Request</a></li>
                                <li><a href="{{ route('suppliersList') }}">Suppler List</a></li>
                                <li><a href="{{ route('enterprenorList') }}">Enterprenor List</a></li>
                                <li><a href="{{ route('enterprenorSales') }}">Enterprenor Seles</a></li>

                            </ul>
                        </li>
                        <li><a href="#"><i class="dripicons-scale"></i></i>Forums Post<i class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">
                                <li><a href="{!! url('pages/blog') !!}">Post a Forums</a></li>
                                <li><a href="{{route('related_blog')}}">Related Blog & Flash Sale</a></li>
                                <li><a href="{!! url('pages/request-blog') !!}">Request Blog</a></li>
                                <li><a href="{!! url('pages/blog-list') !!}">Forums List</a></li>
                                <li><a href="{{ route('b_cat_index') }}">Forums Category</a></li>
                                <li><a href="{{ route('b_sub_cat_index') }}">Forums Sub Category</a></li>

                            </ul>
                        </li>
                        <li><a href="#"><i class="dripicons-scale"></i></i>User Manager<i class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">
                                <li><a href="{{ url('/user-list/create') }}">Add User</a></li>
                                <li><a href="{!! url('user-list') !!}">User List</a></li>
                                <li><a href="{!! url('user-manager') !!}">User Management</a></li>
                                <li><a href="{{ route('passwordReset') }}">Reset Password</a></li>

                            </ul>
                        </li>

                        <li class=""><a href="{{ route('deal_manager') }}"><i class="dripicons-scale"></i></i>Deal Manager</a></li>
                        <li class=""><a href="{{ route('getSubscribe') }}"><i class="dripicons-scale"></i></i>Subscribe List</a></li>
                        <li class=""><a href="{{url('/pages/orders')}}"><i class="dripicons-scale"></i></i>Orders List</a></li>
                        @if(Auth::user()->email == 'hsblco_admin@gmail.com')
                        <li class=""><a href="{{url('/pages/orders-logs')}}"><i class="dripicons-scale"></i></i>Orders Logs</a></li>
                        @endif
                        <li><a href="#"><i class="dripicons-scale"></i></i>Shipping<i class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">
                                <li><a href="{{ url('/pages/verification-status') }}">Verification Status</a></li>
                                <li><a href="{{ url('/pages/shipping') }}">Shipping List</a></li>
                                <li><a href="{!! url('pages/shipping-delivered') !!}">Delivery List</a></li>

                            </ul>
                        </li>


                        <li class=""><a href="{{url('/pages/vpos')}}"><i class="dripicons-scale"></i></i>VPOS Operator</a></li>

                        <li><a href="#"><i class="dripicons-scale"></i></i>Footer Section<i class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">
                                <li><a href="{{ route('facebookFeed') }}">Facebook Feed</a></li>
                                <li><a href="{{ route('news-feed.index') }}">News Feed</a></li>
                                <li><a href="{{ route('quickContact') }}">Quick Contact</a></li>
                                <li><a href="{{ route('partners.index') }}">Partners</a></li>

                            </ul>
                        </li>
                        <li class=""><a href="https://s2.mylivechat.com/webconsole/"><i class="dripicons-scale"></i></i>Live Chat</a></li>
                        <li class=""><a href="{{url('/pages/setting')}}"><i class="dripicons-scale"></i></i>Setting</a></li>
                        <li class=""><a href="{{url('/pages/contactMessage')}}"><i class="dripicons-scale"></i></i>Feedback</a></li>
                        <li class=""><a href="{{url('/pages/spam-registrations')}}"><i class="dripicons-scale"></i></i>Spam Registration</a></li>



                        @elseif($group_id==4)
                        <li><a href="#"><i class="dripicons-scale"></i></i>E-Commerce <br> Functionality<i class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">
                                <li><a href="{{url('/pages/units')}}">Unit</a></li>
                                <li><a href="{{url('/pages/product')}}">Product</a></li>
                                <li><a href="{{ route('supplierApprove') }}">Approved Product</a></li>

                            </ul>
                        </li>

                        <li class=""><a href="{{url('/pages/orders')}}"><i class="dripicons-scale"></i></i>Orders List</a></li>

                        <li><a href="#"><i class="dripicons-scale"></i></i>Shipping<i class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">
                                <li><a href="{!! url('pages/shipping-delivered') !!}">Delivery List</a></li>

                            </ul>
                        </li>
                        <li><a href="#"><i class="dripicons-scale"></i></i>Forums Post<i class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">
                                <li><a href="{!! url('pages/blog') !!}">Post a Forums</a></li>
                                <li><a href="{!! url('pages/blog-list') !!}">Forums List</a></li>

                            </ul>
                        </li>
                        <li><a href="#"><i class="dripicons-scale"></i></i>Manage Sales<i class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">
                                <li><a href="{{url('/manage-sales')}}">Sales Management</a></li>

                            </ul>
                        </li>
                        <li><a href="{{url('/pages/blog')}}"><i class="dripicons-scale"></i></i> Manage Posted Item </a></li>


                        @elseif ($group_id==5)
                        <li><a href="#"><i class="dripicons-scale"></i></i>Manage Product<i class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">
                                <li><a href="{{ route('linkProduct') }}">Product Link</a></li>

                            </ul>
                        </li>
                        <li><a href="#"><i class="dripicons-scale"></i></i>Manage Sales<i class="feather icon-chevron-right pull-right"></i></a>
                            <ul class="vertical-submenu vertical-submenu-two">
                                <li><a href="{{url('/manage-sales')}}">Sales Management</a></li>
                                <li><a href="{{ route('enterprenorSales') }}">Entrepreneur Sales</a></li>

                            </ul>
                        </li>
                        <li><a href="{{url('/pages/blog')}}"> <i class="dripicons-scale"></i></i>Manage Forum Post </a></li>
                        <li><a href="{{ route('deal_registration') }}"><i class="dripicons-scale"></i></i> Deals Registration </a></li>


                        @elseif($group_id==2)
                        <!-- For VPOS -->
                        <li class=""><a href="{{url('/pages/vpos')}}"><i class="dripicons-scale"></i></i>VPOS Operator</a></li>
                        <li class=""><a href="{{url('/pages/orders')}}"><i class="dripicons-scale"></i></i>All Orders</a></li>

                        @elseif($group_id==3)
                        <!-- For Shipping -->
                        <li class=""><a href="{{url('/pages/orders')}}"><i class="dripicons-scale"></i></i>All Orders</a></li>

                        @endif

                    {{-- </ul> --}}


                {{-- </li> --}}
                <li>
                    <a href="{{url('/')}}" target="_blank">
                        <img src="{{asset('admin/assets/images/svg-icon/widgets.svg')}}" class="img-fluid"
                            alt="banner"><span>Visit Site</span></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <img src="{{asset('admin/assets/images/svg-icon/logout.svg')}}" class="img-fluid"
                            alt="logout"><span>Logout</span></i>
                    </a>
                </li>




            </ul>
            {{-- </div> --}}

        </div>
    </div>
</div>
