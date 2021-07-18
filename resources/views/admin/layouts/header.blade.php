<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>
    <link rel="shortcut icon" href="{{asset('admin/assets/images/icon.png')}}">

    <link href="{{asset('admin/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/apexcharts/apexcharts.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/slick/slick-theme.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    {{-- @stack('css') --}}
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/dropify/dist/css/dropify.min.css')}}">
    <link href="{{asset('admin/assets/css/datatables.min.css')}}" rel="stylesheet" type="text/css">
    {{-- <link href="{{asset('admin/assets/plugins/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css">
    --}}
    @yield('stylesheet')
    <link href="{{asset('admin/assets/css/orbiter.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/sweetalert.min.js')}}"></script>

</head>

<body class="vertical-layout">


    <!-- End Infobar Setting Sidebar -->
    <!-- Start Containerbar -->
    <div class="infobar-settings-sidebar-overlay"></div>
    <div id="containerbar">
        <!-- Start Leftbar -->
        {{-- @include('layouts.partials.sidebar') --}}
        @include('admin.layouts.sidebar')

        <div class="rightbar">
            <div class="topbar-mobile">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="mobile-logobar">
                            <a href="index.html" class="mobile-logo"><img
                                    src="{{asset('admin/assets/images/logo.png')}}" class="img-fluid" alt="logo"></a>
                        </div>
                        <div class="mobile-togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="topbar-toggle-icon">
                                        <a class="topbar-toggle-hamburger" href="javascript:void();">
                                            <img src="{{asset('admin/assets/images/svg-icon/horizontal.svg')}}"
                                                class="img-fluid menu-hamburger-horizontal" alt="horizontal">
                                            <img src="{{asset('admin/assets/images/svg-icon/verticle.svg')}}"
                                                class="img-fluid menu-hamburger-vertical" alt="verticle">
                                        </a>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger" href="javascript:void();">
                                            <img src="{{asset('admin/assets/images/svg-icon/collapse.svg')}}"
                                                class="img-fluid menu-hamburger-collapse" alt="collapse">
                                            <img src="{{asset('admin/assets/images/svg-icon/close.svg')}}"
                                                class="img-fluid menu-hamburger-close" alt="close">
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Topbar -->
            <div class="topbar">
                <div class="row align-items-center">
                    <div class="col-md-12 align-self-center">
                        <div class="togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger" href="javascript:void();">
                                            <img src="{{asset('admin/assets/images/svg-icon/collapse.svg')}}"
                                                class="img-fluid menu-hamburger-collapse" alt="collapse">
                                            <img src="{{asset('admin/assets/images/svg-icon/close.svg')}}"
                                                class="img-fluid menu-hamburger-close" alt="close">
                                        </a>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="searchbar">
                                        <form>
                                            <div class="input-group">
                                                <input type="search" class="form-control" placeholder="Search"
                                                    aria-label="Search" aria-describedby="button-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn" type="submit" id="button-addon2"><img
                                                            src="{{asset('admin/assets/images/svg-icon/search.svg')}}"
                                                            class="img-fluid" alt="search"></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="infobar">
                            <ul class="list-inline mb-0">
                                {{-- <li class="list-inline-item">
                            <a href="{{url('/')}}" target="_blank">
                                <img src="{{asset('admin/assets/images/svg-icon/widgets.svg')}}" class="img-fluid"
                                    alt="banner"><span>Visit Site</span></i>
                                </a>
                                </li> --}}
                                <li class="list-inline-item">
                                    <div class="notifybar">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle infobar-icon" href="/" title="Visit Site"><img
                                                    src="{{asset('admin/assets/images/svg-icon/widgets.svg')}}"
                                                    class="img-fluid" alt="notifications"></a>
                                          
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="profilebar">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="profilelink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                                    src="{{asset('admin/assets/images/users/images.png')}}"
                                                    class="img-fluid" alt="profile" style="height: 30px;"><span
                                                    class="feather icon-chevron-down live-icon"></span></a>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="profilelink">
                                                <div class="dropdown-item">
                                                    <div class="profilename">
                                                        <h5>{{Auth::user()->first_name}} {{Auth::user()->last_name}}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="userbox">
                                                    <ul class="list-unstyled mb-0">
                                                        {{-- <li class="media dropdown-item">
                                                    <a href="#" class="profile-icon"><img
                                                            src="{{asset('admin/assets/images/svg-icon/user.svg')}}"
                                                        class="img-fluid" alt="user">My Profile</a>
                                </li> --}}
                                <li class="media dropdown-item">
                                    <a href="#" class="profile-icon"><img
                                            src="{{asset('admin/assets/images/svg-icon/email.svg')}}" class="img-fluid"
                                            alt="email">{{Auth::user()->email}}</a>
                                </li>
                                <li class="media dropdown-item">
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                        class="profile-icon"><img
                                            src="{{asset('admin/assets/images/svg-icon/logout.svg')}}" class="img-fluid"
                                            alt="logout">Logout</a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </li>
            </ul>
        </div>
    </div>
    </div>
    </div>

    @component('admin.layouts.breadcrumb')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">CRM</li>
    @endcomponent