<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <meta property="og:title" content="" />
        <meta property="og:description" content="" />
        <meta property="og:site_name" content="icsbook" />
        <meta property="og:image" content="https://url/image.jpeg" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="" />
        <meta name="twitter:description" content="" />
        <meta name="twitter:image" content="https://www.info/uploads/rU.jpeg" />

        <meta property="fb:pages" content="https://www.facebook.com/" />

        <!--@yield('title')-->
        <title>Free World Imports</title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('front_end/img/logo/icon.png')}}" />

        {{-- <link href="{{asset('front_end/css/datatables.min.css')}}" rel="stylesheet" type="text/css" /> --}}
        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{asset('front_end/css/plugins.css')}}" />

        <!-- Main Style CSS -->
        <link rel="stylesheet" href="{{asset('front_end/css/style.css')}}" />

        @yield('stylesheet')
        <!-- Facebook Pixel Code -->

        <script>
            !(function (f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function () {
                    n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments);
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = "2.0";
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s);
            })(window, document, "script", "https://connect.facebook.net/en_US/fbevents.js");
            fbq("init", "261367245501279");
            fbq("track", "PageView");
        </script>
        <noscript><img height="1" width="1" style="display: none;" src="https://www.facebook.com/tr?id=261367245501279&ev=PageView&noscript=1" /></noscript>

        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <!-- End Facebook Pixel Code -->
        <link rel="stylesheet" href="{{asset('front_end/css/responsive.css')}}" />
        <link rel="stylesheet" href="/front_end/css/custom.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <body>
        <!--Offcanvas menu area start-->
        <div class="off_canvars_overlay"></div>
        @include("front_end.layouts.mobile")

        <!--Offcanvas menu area end-->
        <!--header area start-->

        <!--header area end-->

        @if(Session::has('success'))
        <div class="alert alert-success" style="text-align: center;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('success') }}
        </div>
        @endif @if(Session::has('error'))
        <div class="alert alert-danger" style="text-align: center;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('error') }}
        </div>
        @endif @include("front_end.layouts.header") @yield('content')

        <!--home section bg area start-->
        <div class="home_section_bg"></div>

        <!--footer area start-->
        @include("front_end.layouts.footer")
        <!--footer area end-->

        <!-- Plugins JS -->
        {{--
        <script src="{{asset('front_end/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('front_end/js/all.min.js')}}"></script>
        <script src="{{asset('front_end/js/active.js')}}"></script>
        <script src="{{asset('front_end/ResponsiveSlides.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>
        --}} {{-- new --}}
        <script src="{{ asset('/js/app.js') }}"></script>
        {{-- --}}


        <script src="{{asset('front_end/js/plugins.js')}}"></script>
        {{-- <script src="{{asset('front_end/js/datatables.min.js')}}"></script> --}}
        <!-- Main JS -->
        <script src="{{asset('front_end/js/main.js')}}"></script>

        <script src="{{asset('front_end/js/ajax.js')}}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
        </script>

        @stack('js')

        <script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=1392248567542584&autoLogAppEvents=1";
                fjs.parentNode.insertBefore(js, fjs);
            })(document, "script", "facebook-jssdk");
        </script>

        @yield('scripts')

        <script>
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
        </script>
        <script>
            $(document).ready(function () {
                $("#search").keyup(function () {
                    var inputValue = $(this).val();
                    var inputLength = $(this).val().length;
                    if (inputLength > 2) {
                        console.log(inputValue);
                    }
                });
            });
        </script>

        <script>
            (function (d, s, id) {
                var js,
                    fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=1392248567542584&autoLogAppEvents=1";
                fjs.parentNode.insertBefore(js, fjs);
            })(document, "script", "facebook-jssdk");
        </script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131307101-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag("js", new Date());

            gtag("config", "UA-131307101-1");
        </script>

        <script type="text/javascript">
            function add_chatinline() {
                var hccid = 23118430;
                var nt = document.createElement("script");
                nt.async = true;
                nt.src = "https://mylivechat.com/chatinline.aspx?hccid=" + hccid;
                var ct = document.getElementsByTagName("script")[0];
                ct.parentNode.insertBefore(nt, ct);
            }
            add_chatinline();
        </script>

        <script>
            var num = 200; //number of pixels before modifying styles

            $(window).bind("scroll", function () {
                if ($(window).scrollTop() > num) {
                    $("#header").addClass("sticky");
                } else {
                    $("#header").removeClass("sticky");
                }
            });

            $(document).ready(function () {
                $("#navbar100").click(function () {
                    if ($("#navbar99").hasClass("collapse")) {
                        $("#navbar99").removeClass("collapse");
                    } else {
                        $("#navbar99").addClass("collapse");
                    }
                });
            });
        </script>

        <script>
            var num = 200; //number of pixels before modifying styles

            $(window).bind("scroll", function () {
                if ($(window).scrollTop() > num) {
                    $("#upper").addClass("upper-sticky");
                } else {
                    $("#upper").removeClass("upper-sticky");
                }
            });

            $(document).ready(function () {
                var sideslider = $("[data-toggle=collapse-side]");
                var sel = sideslider.attr("data-target");
                var sel2 = sideslider.attr("data-target-2");
                sideslider.click(function (event) {
                    $(sel).toggleClass("in");
                    $(sel2).toggleClass("out");
                });
            });

            //  $(document).ready(function(){
            //     $(".dropdown").hover(
            //         function() {
            //             $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
            //             $(this).toggleClass('open');
            //         },
            //         function() {
            //             $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
            //             $(this).toggleClass('open');
            //         }
            //     );
            //     $('#about_us_dropdown').slideDown();
            //     $('#about_us_dropdown').toggleClass('open');
            // });
            $(document).ready(function () {
                // executes when HTML-Document is loaded and DOM is ready

                // breakpoint and up
                $(window).resize(function () {
                    if ($(window).width() >= 980) {
                        // when you hover a toggle show its dropdown menu
                        $(".navbar .dropdown-toggle").hover(function () {
                            $(this).parent().toggleClass("show");
                            $(this).parent().find(".dropdown-menu").toggleClass("show");
                        });

                        // hide the menu when the mouse leaves the dropdown
                        $(".navbar .dropdown-menu").mouseleave(function () {
                            $(this).removeClass("show");
                        });

                        // do something here
                    }
                });

                // document ready
            });
        </script>

        <script>
            (function (d, s, id) {
                var js,
                    fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=1392248567542584&autoLogAppEvents=1";
                fjs.parentNode.insertBefore(js, fjs);
            })(document, "script", "facebook-jssdk");
        </script>

        @yield('scripts')

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131307101-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag("js", new Date());

            gtag("config", "UA-131307101-1");
        </script>

        <script type="text/javascript">
            function add_chatinline() {
                var hccid = 23118430;
                var nt = document.createElement("script");
                nt.async = true;
                nt.src = "https://mylivechat.com/chatinline.aspx?hccid=" + hccid;
                var ct = document.getElementsByTagName("script")[0];
                ct.parentNode.insertBefore(nt, ct);
            }
            add_chatinline();
        </script>

        <script>
            $(document).ready(function () {
                $("#select_price_range").on("click", "", function (e) {
                    var value_type = $(this).val();
                    console.log(value_type);
                    $.ajax({
                        type: "POST",
                        url: "/product-low-high",
                        data: {
                            _token: "{{ csrf_token() }}",
                            value_type: value_type,
                        },
                        success: function (data) {
                            //console.log(data);
                            $("#productlist").html(data);
                            $(".shop_toolbar").hide();
                        },
                    });
                });

                //get Category Product

                $(".get_subcat_product").click(function () {
                    var sub_cat_id = $(this).find("input").val();
                    //alert(sub_cat_id);

                    $.ajax({
                        type: "POST",
                        url: "/product-subcat",
                        data: {
                            _token: "{{ csrf_token() }}",
                            sub_cat_id: sub_cat_id,
                        },
                        success: function (data) {
                            //  console.log(data);
                            // alert(ok);
                            $("#productlist").html(data);
                            $(".shop_toolbar").hide();
                        },
                    });
                });

                $(".get_home_subcat_product").click(function () {
                    // alert('ok');
                    var home_sub_cat_id = $(this).find("input").val();
                    // alert(home_sub_cat_id);

                    $.ajax({
                        type: "POST",
                        url: "/product-home-subcat",
                        data: {
                            _token: "{{ csrf_token() }}",
                            home_sub_cat_id: home_sub_cat_id,
                        },
                        success: function (data) {
                            //  console.log(data);
                            // alert(ok);
                            $("#hproductlist").html(data);
                        },
                    });
                });
                $(".get_brand_product").click(function () {
                    // alert('ok');
                    var sub_brand_id = $(this).find("input").val();
                    // var sub_brand_id = $(this).find('input:checkbox[name=ant-checkbox-inner]:checked').val();
                    // alert(sub_brand_id);

                    $.ajax({
                        type: "POST",
                        url: "/product-brand",
                        data: {
                            _token: "{{ csrf_token() }}",
                            sub_brand_id: sub_brand_id,
                        },
                        success: function (data) {
                            console.log(data);
                            // alert(ok);
                            $("#productlist").html(data);

                            // $('.shop_toolbar').display('none');
                            $(".shop_toolbar").hide();
                        },
                    });
                });

                // $('.add_towishlist').submit(function(event){

                //     event.preventDefault();
                //     // alert('ok');
                //    var post_url = $(this).attr("action");
                //    var request_method = $(this).attr("method");
                //    var form_data = $(this).serialize();

                //         // console.log(form_data);

                //       $.ajax({
                //           url : post_url,
                //           type: request_method,
                //           data : form_data
                //       }).done(function(response){ //
                //         if(response == 'not_login'){
                //             window.location = '/user-login';
                //         }else {
                //             $("#server-results").html(response);
                //           // console.log(data)
                //         }

                //       });

                // });
                $(".add_towishlist").click(function () {
                    //   alert('ok');
                    var product_id = $(this).find("input").val();

                    $.ajax({
                        type: "POST",
                        url: "/addWishList",
                        data: {
                            _token: "{{ csrf_token() }}",
                            product_id: product_id,
                        },
                        success: function (response) {
                            if (response == "not_login") {
                                window.location = "/user-login";
                            } else {
                                $(".wishlist_count").html(response);
                                // console.log(data)
                            }

                            // $('.shop_toolbar').hide();
                        },
                    });
                });
                $(".add_towishlist_flash").click(function () {
                    //   alert('ok');
                    var flash_id = $(this).find("input").val();

                    $.ajax({
                        type: "POST",
                        url: "/addWishList-flash",
                        data: {
                            _token: "{{ csrf_token() }}",
                            flash_id: flash_id,
                        },
                        success: function (response) {
                            if (response == "not_login") {
                                window.location = "/user-login";
                            } else {
                                $(".wishlist_count").html(response);
                                // console.log(data)
                            }

                            // $('.shop_toolbar').hide();
                        },
                    });
                });

                function wishinit() {
                    $(".remove_wishlist").click(function () {
                        var wishlist_id = $(this).find("input").val();
                        // alert(wishlist_id);
                        $.ajax({
                            type: "POST",
                            url: "/wishlist_delete",
                            data: {
                                _token: "{{ csrf_token() }}",
                                wishlist_id: wishlist_id,
                            },
                            success: function (response) {
                                if (response == "not_login") {
                                    window.location = "/user-login";
                                } else {
                                    $("#wishlist_remove").html(response.view);
                                    $(".wishlist_updatecount").html(response.countval);
                                    wishinit();
                                    // console.log(response)
                                }
                            },
                            // console.log(data);
                        });
                    });
                }
                wishinit();

                //         $('.wishlist_delete_cls').submit(function(event){

                //     event.preventDefault();
                //     // alert('ok');
                //    var post_url = $(this).attr("action");
                //    var request_method = $(this).attr("method");
                //    var form_data = $(this).serialize();

                //         // console.log(form_data);

                //       $.ajax({
                //           url : post_url,
                //           type: request_method,
                //           data : form_data
                //       }).done(function(response){
                //           $("#wishlist-results").html(response);
                //           console.log(data)
                //       });

                //   });

                $("#country").change(function () {
                    // alert('ok');
                    var classId = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "/statesName",
                        data: {
                            id: classId,
                            _token: "{{ csrf_token() }}",
                        },
                        datatype: "html",
                        success: function (response) {
                            //console.log(response);
                            $("#states").html(response);
                        },
                    });
                });

                $(".get_cat_product").click(function () {
                    var get_cat_product = $(this).find("input").val();

                    // alert(get_cat_product);

                    $.ajax({
                        type: "POST",
                        url: "/home-product-subcat",
                        data: {
                            _token: "{{ csrf_token() }}",
                            get_cat_product: get_cat_product,
                        },
                        success: function (data) {
                            //  console.log(data);
                            // alert(ok);
                            $("#productcatlist").html(data);

                            // $('.shop_toolbar').hide();
                        },
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $(document).on("click", "#softDelete", function () {
                    var deleteID = $(this).data("id");
                    $(".modal-body #modal_id").val(deleteID);
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $("html,body").scrollTop(55);
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>

        <script>
              $(document).ready(function() {

                  $('.popup_pdf a').click(function(e) {
                      // alert('ok');
                      e.preventDefault();
                      var href_pdf = $(this).attr("href");
                      console.log(href_pdf);
                      // console.log(href_pdf.replace('https://freeworldimports.com',location.origin));
                      var blank = $(this).attr("target");
                      var ext = href_pdf.substring(href_pdf.length - 4, href_pdf.length);

                      if (ext == '.pdf' || ext == '.PDF') {
                          console.log('find');
                          $('#myModal').modal('show');
                          // PDFObject.embed(href_pdf.replace('https://freeworldimports.com',location.origin), "#example1");
                          PDFObject.embed(href_pdf.replace('https://freeworldimports.com','https://freeworldimports.com'), "#example1");
                      } else if (blank == undefined) {
                          window.open(href_pdf, '_self');
                          console.log(href_pdf);
                          $.ajax({
                              url: href_pdf,
                              type: 'GET',
                              dataType: 'HTML',
                              cache: false,
                              async: false,
                              contentType: false,
                              processData: false,
                              success: function (success) {
                                  // $('.view-body').html(success);
                                  console.log('new data: ',success);
                                  $('#myModal2').modal('show');
                                  $('#example22').html(success);
                              }
                          });

                      } else {
                          window.open(href_pdf, blank);
                      }
                  });

                  jQuery('.categories>li>a').on('click', function() {
            	jQuery(this).parent().toggleClass('open');
            	jQuery(this).parent().find('ul').slideToggle();
            	//console.log('ok');
            });
              });
              @stack('mjs')
        </script>

        <script src="/front_end/lazy.js"></script>


    </body>
</html>
