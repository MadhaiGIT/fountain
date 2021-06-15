@extends('layouts.app')

@section('title', 'Query')

@section('styles')
    <link rel="stylesheet" href="{{asset('libs/rateit/rateit.css')}}">
@endsection

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
                                <li><a href="#">MY CREDIT : <span class="creditValue">{{$data->credit}}</span>
                                        TOKENS</a></li>
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
    <section class="imageblock switchable feature-large height-100 bg--primary" id="secDisclaimer">
        <div class="imageblock__content col-lg-6 col-md-4 pos-right">
            <div class="background-image-holder"><img alt="image" src="{{asset('img/work-3.jpg')}}"></div>
        </div>
        <div class="container pos-vertical-center">
            <div class="row">
                <div class="col-lg-5 col-md-7">
                    <h1>Disclaimer</h1> <span class="h2 countdown color--primary" data-date="09/25/2018"
                                              data-fallback-text="Getting ready"></span>
                    <p class="lead">This page is visbile once the user submits the request to the API above. Once the
                        user cliecks on I AGREE, the content below this page is shown. In the space of this text, show a
                        filler text that will be the content of the disclaimer.</p>
                    <form
                        method="post"
                        action="/disclaimer?redirect={{$redirect ?? ''}}"
                        data-success="Thanks for signing up.  Please check your inbox for a confirmation email."
                        data-error="Please provide your email address.">
                        <div class="row">
                            @csrf
                            <div class="col-12">
                                <button type="submit" id="accept" class="btn btn--primary type--uppercase w-75">I agree</button>
                            </div>
                            <div class="col-12"><span class="type--fine-print">By clicking this button, you agree to the <a
                                        href="#">Terms of Service</a></span></div>
                            <div style="position: absolute; left: -5000px" aria-hidden="true"><input type="text"
                                                                                                     name="b_77142ece814d3cff52058a51f_f300c9cce8"
                                                                                                     tabindex="-1"
                                                                                                     value=""></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
