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
    <section class="imagebg height-100 text-center" data-gradient-bg="#fbcd10,#d79d04,#fbd845,#805806">
        <div class="background-image-holder"><img alt="background" src="{{asset('img/landing-18.jpg')}}"></div>
        <div class="container pos-vertical-center">
            <div class="row">
                <div class="col-md-9"><img alt="Image" src="{{asset('img/headline-3.png')}}"> <span class="h1 countdown"
                                                                                       data-date="09/25/2018"
                                                                                       data-date-fallback="Fountain Project"></span>
                    <p class="lead">This is the template for Fountain Project. Static web to be updated. Please insert
                        code for Login, sigunup and all the processes related to private section.</p>
                    <div class="modal-instance">
                        <a class="modal-trigger btn btn--primary type--uppercase" href="#"> <span class="btn__text">
							Notify Me
						</span> </a>
{{--                        <div>{{json_encode($data)}}</div>--}}
                        <div class="modal-container">
                            <div class="modal-content imagebg text-center">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <h2>Get notified as soon as we launch!</h2>
                                        <form class="row justify-content-center"
                                              action="//mrare.us8.list-manage.com/subscribe/post?u=77142ece814d3cff52058a51f&amp;id=f300c9cce8"
                                              data-success="Thanks for signing up.  Please check your inbox for a confirmation email."
                                              data-error="Please provide your name and email address and agree to the terms.">
                                            <div class="col-lg-4 col-md-4"><input class="validate-required" type="text"
                                                                                  name="NAME" placeholder="Your Name">
                                            </div>
                                            <div class="col-lg-4 col-md-4"><input
                                                    class="validate-required validate-email" type="email" name="EMAIL"
                                                    placeholder="Email Address"></div>
                                            <div class="col-lg-4 col-md-4">
                                                <button type="submit" class="btn btn--primary type--uppercase">
                                                    Subscribe
                                                </button>
                                            </div>
                                            <div class="col-md-12"><input class="validate-required" type="checkbox"
                                                                          name="group[13737][1]"> <span>I have read and agree to the <a
                                                        href="#">terms and conditions</a></span></div>
                                            <div style="position: absolute; left: -5000px" aria-hidden="true"><input
                                                    type="text" name="b_77142ece814d3cff52058a51f_f300c9cce8"
                                                    tabindex="-1" value=""></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

