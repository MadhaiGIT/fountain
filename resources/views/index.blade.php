@extends('layouts.app')

@section('title', 'Home')

@section('navigation')
    <div class="via-1621970940043" via="via-1621970940043" vio="NAVIGATION">
        <div class="bar bar--sm visible-xs">
            <div class="container">
                <div class="row">
                    <div class="col-3 col-md-2">
                        <a href="/"> <img class="logo logo-dark" alt="logo" src="{{asset('img/logo-dark.png')}}"> <img
                                class="logo logo-light" alt="logo" src="{{asset('img/logo-light.png')}}"> </a>
                    </div>
                    <div class="col-9 col-md-10 text-right">
                        <a href="#" class="hamburger-toggle" data-toggle-class="#menu1;hidden-xs hidden-sm"> <i
                                class="icon icon--sm stack-interface stack-menu"></i> </a>
                    </div>
                </div>
            </div>
        </div>
        <nav id="menu1" class="bar bar-1 hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 col-md-2 hidden-xs">
                        <div class="bar__module">
                            <a href="/"> <img class="logo logo-dark" alt="logo"
                                              src="{{asset('img/logo-dark.png')}}">
                                <img class="logo logo-light" alt="logo" src="{{asset('img/logo-light.png')}}"> </a>
                        </div>
                    </div>
                    <div class="col-lg-11 col-md-12 text-right text-left-xs text-left-sm">
                        <div class="bar__module">
                            <a class="btn btn--sm type--uppercase" href="/login">
                                <span class="btn__text">LOGIN&nbsp;</span>
                            </a>
                            <a class="btn btn--sm btn--primary type--uppercase inner-link" href="/signup"
                               target="_self">
                                <span class="btn__text">SIGN UP</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

@endsection

@section('content')
    <a id="index" class="in-page-link"></a>
    <body data-smooth-scroll-offset="77">
        <div class="nav-container"> </div>
        <div class="main-container">
            <section class="imagebg videobg text-center parallax height-100" data-overlay="2"> <video autoplay="" loop="" muted="">
		<source src="video/video.webm" type="video/webm">
		<source src="video/video.mp4" type="video/mp4">
		<source src="video/video.ogv" type="video/ogv">
	</video>
                <div class="background-image-holder"> <img alt="image" src="img/ImageHEre.jpg"> </div>
                <div class="container pos-vertical-center">
                    <div class="row">
                        <div class="col-md-8 col-lg-7">
                            <h1> Instant advice based on all the world's knowledge</h1>
                            <p class="lead">No humans involved</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/parallax.js"></script>
        <script src="js/smooth-scroll.min.js"></script>
        <script src="js/scripts.js"></script>

    </body>
@endsection

