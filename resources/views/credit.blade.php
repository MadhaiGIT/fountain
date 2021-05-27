@extends('layouts.app')

@section('title', 'Credit')

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
                            <ul class="menu-horizontal text-left">
                                <li><a href="#">MY CREDIT : XXXX TOKENS</a></li>
                            </ul>
                        </div>
                        <div class="bar__module">
                            <a class="btn btn--sm type--uppercase" href="/logout">
                                <span class="btn__text">LOGOFF&nbsp;</span>
                            </a>
                            <a class="btn btn--sm btn--primary type--uppercase inner-link" href="/credit"
                               target="_self">
                                <span class="btn__text">Buy CREDIT</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
@endsection

@section('content')
    <section class="pricing-section-2 text-center imagebg section--ken-burns" data-overlay="4">
        <div class="background-image-holder"> <img alt="background" src="{{asset('img/hero-1.jpg')}}"> </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="pricing pricing-3">
                        <div class="pricing__head bg--secondary boxed">
                            <h5>Single Query</h5> <span class="h1"><span class="pricing__dollar">$</span>1</span>
                            <p class="type--fine-print">BUY</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="pricing pricing-3">
                        <div class="pricing__head bg--secondary boxed">
                            <h5>10 queries</h5> <span class="h1"><span class="pricing__dollar">$</span>9</span>
                            <p class="type--fine-print">BUY</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="pricing pricing-3">
                        <div class="pricing__head bg--primary boxed"> <span class="label">Value</span>
                            <h5>50 queries</h5> <span class="h1"><span class="pricing__dollar">$</span>40</span>
                            <p class="type--fine-print">BUY</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="pricing pricing-3">
                        <div class="pricing__head bg--secondary boxed">
                            <h5>100 queries</h5> <span class="h1"><span class="pricing__dollar">$</span>75</span>
                            <p class="type--fine-print">BUY</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center imagebg" data-gradient-bg="#4876BD,#5448BD,#8F48BD,#BD48B1">
        <div class="container">
            <div class="row justify-content-center">
                <h2>Enter credit card data</h2>
            </div>
            <form class="row justify-content-center" action="//mrare.us8.list-manage.com/subscribe/post?u=77142ece814d3cff52058a51f&amp;id=f300c9cce8" data-success="Thanks for signing up.  Please check your inbox for a confirmation email." data-error="Please provide your name, email address, phone number and agree to the terms.">
                <div class="col-lg-3 col-md-6"> <input class="validate-required" type="text" name="NAME" placeholder="Your Name"> </div>
                <div class="col-lg-3 col-md-6"> <input class="validate-required validate-email" type="email" name="EMAIL" placeholder="Card number"> </div>
                <div class="col-lg-3 col-md-6"> <input class="validate-required" type="tel" name="PHONE" placeholder="Expiration"> </div>
                <div class="col-lg-3 col-md-6"> <button type="submit" class="btn btn--primary">BUYNOW</button> </div>
                <div class="col-md-12"> <input class="validate-required" type="checkbox" name="group[13737][1]"> <span>I have read and agree to the <a href="#">terms and conditions</a></span> </div>
                <div style="position: absolute; left: -5000px" aria-hidden="true"> <input type="text" name="b_77142ece814d3cff52058a51f_f300c9cce8" tabindex="-1" value=""> </div>
            </form>
        </div>
    </section>
@endsection
