@extends('layouts.app')

@section('title', 'Query')

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
                                <li><a href="#">MY CREDIT : {{$data->credit}} TOKENS</a></li>
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
    <section class="cover imagebg height-100 text-center section--ken-burns" data-overlay="4">
        <div class="background-image-holder"><img alt="background" src="{{asset('img/education-3.jpg')}}"></div>
        <div class="container pos-vertical-center">
            <div class="row">
                <div class="col-md-12">
                    <h1>This is where the user asks a query</h1>
                    <p class="lead"> in the textbox below. please make it larger. The button should send the string from
                        the textbox to the generic API. Response from the API will bring 5 diferent strings. Each string
                        has to be shown in the blocks below.&nbsp;<br></p>
                    <div class="row justify-content-center mt-5">
                        <div class="col">
                            <h4>Show here avaiable credits for this account.</h4>
                        </div>
                    </div>
                    <form class="row justify-content-center">
                        <div class="col-md-5"><input type="email" name="email"
                                                     placeholder="your query here. Make plese this box bigger"></div>
                        <div class="col-md-5 col-lg-3">
                            <button type="submit" class="btn btn--primary type--uppercase">Sendquerytoapi</button>
                        </div>
                    </form>
                    <div class="row justify-content-center m-0">
                        <div class="col"><span class="type--fine-print"><br></span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="imageblock switchable feature-large height-100 bg--primary">
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
                        action="//mrare.us8.list-manage.com/subscribe/post?u=77142ece814d3cff52058a51f&amp;id=f300c9cce8"
                        data-success="Thanks for signing up.  Please check your inbox for a confirmation email."
                        data-error="Please provide your email address.">
                        <div class="row">
                            <div class="col-12"><input class="validate-required validate-email" type="email"
                                                       name="EMAIL" placeholder="Email Address"></div>
                            <div class="col-12">
                                <button type="submit" class="btn btn--primary type--uppercase">IAGREE.showmetheresults
                                </button>
                            </div>
                            <div class="col-12"><span class="type--fine-print">By signing up, you agree to the <a
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
    <section class="switchable imagebg" data-overlay="4">
        <div class="background-image-holder"><img alt="background" src="{{asset('img/hero-1.jpg')}}"></div>
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-md-7"><img alt="Image" src="{{asset('img/device-2.png')}}"></div>
                <div class="col-md-5 col-lg-4">
                    <div class="switchable__text">
                        <h3>Result 1 from API</h3>
                        <p class="lead"> Enter here result 2 from API</p>
                        <hr class="short">
                        <p> Enter here system to rate from 1 to 5 stars the result 1 from API and record in database</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="switchable feature-large unpad--bottom">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-md-6">
                    <div class="switchable__text">
                        <h2>Result 2 from API</h2>
                        <p class="lead"> Enter here result from API </p>
                        <p class="lead"> Enter here system to rate from 1 to 5 stars the result 2 from API and record in
                            database </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-12 text-center"><img alt="Image" src="{{asset('img/device-1.png')}}"></div>
            </div>
        </div>
    </section>
    <section class="switchable imagebg switchable--switch" data-overlay="4">
        <div class="background-image-holder"><img alt="background" src="{{asset('img/hero-1.jpg')}}"></div>
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-md-7"><img alt="Image" src="{{asset('img/device-2.png')}}"></div>
                <div class="col-md-5 col-lg-4">
                    <div class="switchable__text">
                        <h3>Result 3 from API</h3>
                        <p class="lead"> Enter here result 3 from API </p>
                        <hr class="short">
                        <p> Enter here system to rate from 1 to 5 stars the result 3 from API and record in
                            database </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="switchable imagebg" data-overlay="4">
        <div class="background-image-holder"><img alt="background" src="{{asset('img/hero-1.jpg')}}"></div>
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-md-7"><img alt="Image" src="{{asset('img/device-2.png')}}"></div>
                <div class="col-md-5 col-lg-4">
                    <div class="switchable__text">
                        <h3>Result 4 from API</h3>
                        <p class="lead"> Enter here result 4 from API </p>
                        <hr class="short">
                        <p> Enter here system to rate from 1 to 5 stars the result 4 from API and record in
                            database </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
