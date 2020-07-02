<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!--====== Title ======-->
    <title>{{ config('app.name') }} |Book Management System</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('frontpage/assets/images/favicon.png" type="image/png') }}">
        
    <!--====== Magnific Popup CSS ======-->
    <link rel="stylesheet" href="{{ asset('frontpage/assets/css/magnific-popup.css') }}">
        
    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="{{ asset('frontpage/assets/css/slick.css') }}">
        
    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{ asset('frontpage/assets/css/LineIcons.css') }}">
        
    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="{{ asset('frontpage/assets/css/bootstrap.min.css') }}">
    
    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="{{ asset('frontpage/assets/css/default.css') }}">
    
    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="{{ asset('frontpage/assets/css/style.css') }}"> 
      
    <style type="text/css">
        .navbar-expand-lg >#navbarTwo > ul > li {
            color: #007bff !important;
            font-size: inherit;
        }
        .footer-area {
            padding: 0px;
        }
        a.navbar-brand {
            color: #121212 !important;
            font-weight: bolder !important;
        }
        .navbar-area .navbar .navbar-nav .nav-item a{
            color: #121212 !important;
            padding: 1em !important;
            margin: 0 1em !important
        }
    </style>
     <!--====== Jquery js ======-->
     <script src="{{ asset('frontpage/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('frontpage/assets/js/vendor/modernizr-3.7.1.min.js') }}"></script>
    
</head>

<body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
   
    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->
    
    <!--====== NAVBAR TWO PART START ======-->

    <section class="navbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                       
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset('frontpage/assets/images/logo.svg') }}" alt="Logo">
                        {{ config('app.name') }}
                        </a>
                        

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo" aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                            <ul class="navbar-nav m-auto">
                       <!-- Authentication Links -->
                        @if (Route::has('login'))
                            @auth
                                <!-- @if(Auth::user()->role===1) {{$admin='admin'}} @endif
                                @if(Auth::user()->role===2) {{$admin='clients'}} @endif
                                @if(Auth::user()->role===3) {{$admin='user'}} @endif -->

                                <li class="nav-item active">
                                    @if(Auth::user()->role===2)
                                    <a class="page-scroll" href="{{ url('clientsprofile/'.Auth::user()->id) }}">Home</a>
                                    @elseif(Auth::user()->role===3)
                                    <a class="page-scroll" href="{{ url('userprofile/'.Auth::user()->id) }}">Home</a>
                                    @else
                                    <a class="page-scroll" href="{{route('admin.index')}}">Home</a>
                                    @endif
                                </li>
                                  
                            @else
                                <!-- <li class="nav-item">
                                    <a class="page-scroll" href="#contact">Contact</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" 
                                    href="{{ route('login') }}">Login</a>
                                </li> -->

                            <li class="nav-item dropdown font-clr">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Login') }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="page-scroll dropdown-item" href="{{ url('login/clients') }}">
                                        {{ __('Client') }}
                                    </a>
                                    <a class="page-scroll dropdown-item" href="{{ route('login') }}">
                                        {{ __('User') }}
                                    </a>
                                </div>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item dropdown font-clr">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Registration') }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="page-scroll  dropdown-item" href="{{ route('clients.register') }}">
                                        {{ __('Client') }}
                                    </a>
                                    <a class="page-scroll dropdown-item" href="{{ route('register') }}">
                                        {{ __('User') }}
                                    </a>
                                </div>
                                
                            </li>
                            @endif
                        
<!-- 
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="page-scroll" href="{{ route('register') }}">Register</a>
                                </li>
                                @endif -->
                            @endauth
                            
                        @endif
                            </ul>
                        </div>

                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== NAVBAR TWO PART ENDS ======-->
    
    <!--====== SLIDER PART START ======-->
    <section id="home" class="slider_area">
        <div id="carouselThree" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselThree" data-slide-to="0" class="active"></li>
                <li data-target="#carouselThree" data-slide-to="1"></li>
                <li data-target="#carouselThree" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h1 class="title">
                                    Book Management System</h1>
                                    <p class="text">We blend insights and strategy to create digital products for forward-thinking organisations.</p>
                                    
                                </div>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                    <div class="slider-image-box d-none d-lg-flex align-items-end">
                        <div class="slider-image">
                            <img src="{{ asset('frontpage/assets/images/slider/1.png')}}" alt="Hero">
                        </div> <!-- slider-imgae -->
                    </div> <!-- slider-imgae box -->
                </div> <!-- carousel-item -->

                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h1 class="title">Multi User Login</h1>
                                    <p class="text">We blend insights and strategy to create digital products for forward-thinking organisations.</p>
                                    
                                </div> <!-- slider-content -->
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                    <div class="slider-image-box d-none d-lg-flex align-items-end">
                        <div class="slider-image">
                            <img src="{{ asset('frontpage/assets/images/slider/2.png') }}" alt="Hero">
                        </div> <!-- slider-imgae -->
                    </div> <!-- slider-imgae box -->
                </div> <!-- carousel-item -->

                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider-content">
                                    <h1 class="title">Based on Bootstrap 4</h1>
                                    <p class="text">We blend insights and strategy to create digital products for forward-thinking organisations.</p>
                                    
                                </div> <!-- slider-content -->
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                    <div class="slider-image-box d-none d-lg-flex align-items-end">
                        <div class="slider-image">
                            <img src="{{ asset('frontpage/assets/images/slider/3.png') }}" alt="Hero">
                        </div> <!-- slider-imgae -->
                    </div> <!-- slider-imgae box -->
                </div> <!-- carousel-item -->
            </div>

            <a class="carousel-control-prev" href="#carouselThree" role="button" data-slide="prev">
                <i class="lni lni-arrow-left"></i>
            </a>
            <a class="carousel-control-next" href="#carouselThree" role="button" data-slide="next">
                <i class="lni lni-arrow-right"></i>
            </a>
        </div>
    </section>
    <!--====== SLIDER PART ENDS ======-->
    
    <!-- Content Wrapper. Contains page content -->
    <section id="services" class="mt-30 features-area">
      <div class="container">
        @yield('content')
      </div>
    </section>
    <!--====== FOOTER PART START ======-->

    <section class="footer-area footer-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                 <!-- footer logo -->
                    <ul class="social text-center mt-60">
                        <li><a href="https://twitter.com/sanpandi"><i class="lni lni-twitter-original"></i></a></li>
                        <li><a href="https://in.linkedin.com/in/santhiveerapandik"><i class="lni lni-linkedin-original"></i></a></li>
                    </ul> <!-- social -->
                    <div class="footer-support text-center">
                        <span class="number">+919498017460</span>
                        <span class="mail">santhiveerapandi@gmail.com</span>
                    </div>
                    <div class="copyright text-center mt-35">
                        <p class="text"> </p>
                    </div> <!--  copyright -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== FOOTER PART ENDS ======-->
    
    <!--====== BACK TOP TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni lni-chevron-up"></i></a>

   
    <!--====== Bootstrap js ======-->
    <script src="{{ asset('frontpage/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontpage/assets/js/bootstrap.min.js') }}"></script>
    
    <!--====== Slick js ======-->
    <script src="{{ asset('frontpage/assets/js/slick.min.js') }}"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="{{ asset('frontpage/assets/js/jquery.magnific-popup.min.js') }}"></script>
    
    <!--====== Ajax Contact js ======-->
    <script src="{{ asset('frontpage/assets/js/ajax-contact.js') }}"></script>
    
    <!--====== Isotope js ======-->
    <script src="{{ asset('frontpage/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontpage/assets/js/isotope.pkgd.min.js') }}"></script>
    
    <!--====== Scrolling Nav js ======-->
    <script src="{{ asset('frontpage/assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('frontpage/assets/js/scrolling-nav.js') }}"></script>
    
    <!--====== Main js ======-->
    <script src="{{ asset('frontpage/assets/js/main.js') }}"></script>
    
</body>

</html>
