<footer class="footer_widgets">
    <!--newsletter area start-->
    <div class="newsletter_area">
        <div class="container">
            <div class="newsletter_inner">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <h4 style="color:#333;">NEWSLETTER</h4>
                    </div>
                    <div class="col-lg-4 col-md-7">
                            <p style="color:#333;">Keep up with recent additions and fast moving offers - Enter your
                                e-mail and subscribe to our newsletter.</p>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="subscribe_form subscribe_form_two">
                            <form  action="{{url('/')}}" method="POST" class="mc-form footer-newsletter" style="width: 100%;
                            position: relative;
                            background: #ffffff;
                            border-radius: 4px;">
                            {{ csrf_field() }}
                                <input type="email" name="email"
                                class="form-control custom-form-control"
                                placeholder="Email..." aria-label="Username"
                                aria-describedby="basic-addon1"/>
                                <button type="submit" id="mc-submit">Subscribe</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--newsletter area end-->
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5 col-sm-7">
                    <div class="widgets_container contact_us">
                        <h3>Facebook Feed</h3>
                        <div class="aff_content">
                            @php
                            $feed = DB::table('facebook_feed')->where('status', '1')->get();
                            @endphp

                            <iframe
                                src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffreeworldimports%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                                width="100%" height="500" style="border:none;overflow:hidden" scrolling="yes"
                                frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-5">
                    <div class="widgets_container widget_menu">
                        <h3>News Feed & Blog</h3>
                        <div class="footer_menu">
                            @php
                            $feed = DB::table('news_feeds')->where('status', '1')->get();
                            @endphp
                            <ul>
                                @foreach ($feed as $value)
                                <li style="font-weight: bold; padding: 5px; padding-left: 0px;"><a
                                        href="{{ $value->link }}">{{ $value->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>Quick Contact</h3>
                        <div class="footer_menu">
                            <ul>
                                <li> @php
                                    $quickContact = DB::table('quick_contacts')->first();
                                    @endphp
                                    <p><i class="fa fa-map-marker" aria-hidden="true"></i>
                                        {{ $quickContact->address_first }}
                                        <br /> {{ $quickContact->address_second }}
                                        <br /> {{ $quickContact->address_third }}
                                    </p>
                                </li>
                                <li>
                                    <p><i class="fa fa-phone" aria-hidden="true"></i> {{ $quickContact->phone }}</p>
                                </li>
                                <li>
                                    <p><i class="fa fa-envelope" aria-hidden="true"></i> {{ $quickContact->email }}</p>
                                </li>


                            </ul>
                        </div>
                        <div class="footer_social">
                            <ul>
                                <li><a class="facebook"  target="_blank" href="{{ $quickContact->facebook }}"><i
                                            class="fa fa-facebook"></i></a></li>
                                <li><a class="twitter"  target="_blank" href="{{ $quickContact->twitter }}"><i
                                            class="fa fa-twitter"></i></a></li>
                                <li><a class="rss"  target="_blank" href="{{ $quickContact->gmail }}"><i
                                            class="fa fa-envelope-o"></i></a></li>
                                <li><a class="linkedin"  target="_blank" href="{{ $quickContact->linkedin }}"><i
                                            class="fa fa-linkedin"></i></a></li>
                                <li><a class="talkingtota" target="_blank" href="http://talkingtota.com/@FreeWorld">
                                    <img src="http://talkingtota.com/themes/default/statics/img/logo.png" alt="">
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>Partners</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="#">      @php
                                    $patners = DB::table('partners')->where('status', 1)->get();
                                    $i=0;
                                @endphp
                                @foreach ($patners as $patner)
                                    <div class="media">
                                      <div class="media-left" style="margin-right: 10px; margin-top: 5px">
                                        <img src="{{URL::to('/')}}/images/footer/{{$patner->image}}" class="media-object" style="width:70px">
                                      </div>
                                      <div class="media-body">
                                        <h4 class="media-heading" style="font-size: 17px;">{{ $patner->title }}</h4>
                                        <p style="font-size: 15px;">{{ substr($patner->description, 0, 40) }}</p>
                                      </div>
                                    </div>
                                    @php
                                        $i++;
                                        if($i==4) break;
                                    @endphp
                                @endforeach</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6">
                    <div class="copyright_area">
                        <p>&copy; FreeWorldImports 2018-<?php echo date("Y"); ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer_payment">
                        <p> <a  href="{{url('/terms')}}">Terms and Conditions</a>
                            <a  href="{{url('/policy')}}">Privacy Policy</a></p>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer_payment text-right">
                        <p>Support & Maintenance By : <a href="http://hsblco.com" target="_blank" style="color: red;">HSBLCO</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
