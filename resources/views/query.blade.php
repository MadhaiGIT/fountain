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
    <section class="cover imagebg height-100 text-center section--ken-burns" data-overlay="4">
        <div class="background-image-holder"><img alt="background" src="{{asset('img/education-3.jpg')}}"></div>
        <div class="container pos-vertical-center">
            <div class="row">
                <div class="col-md-12">
                    <h1>This is where the user asks a query</h1>
                    <p class="lead" id="description"></p>
                    <div class="row justify-content-center mt-5">
                        <div class="col">
                            <h4 id="credit">Available Credits: <span class="creditValue">{{$data->credit}}</span></h4>
                        </div>
                    </div>
                    <form class="row justify-content-center">
                        <div class="col-md-5"><textarea name="query" id="query" rows="4"
                                                        placeholder="your query here."></textarea></div>
                        <div class="col-md-5 col-lg-3">
                            <button type="button" id="btnQuery" class="btn btn--primary type--uppercase w-50">Send
                            </button>
                        </div>
                    </form>
                    <div class="row justify-content-center m-0">
                        <div class="col"><span class="type--fine-print"><br></span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="imageblock switchable feature-large height-100 bg--primary hidden" id="secDisclaimer">
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
                            <div class="col-12">
                                <button type="button" id="accept" class="btn btn--primary type--uppercase w-75">I agree
                                    and show me the results
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
    <section class="switchable imagebg hidden" data-overlay="4" id="secResult1">
        <div class="background-image-holder"><img alt="background" src="{{asset('img/hero-1.jpg')}}"></div>
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-md-7"><img alt="Image" src="{{asset('img/device-2.png')}}"></div>
                <div class="col-md-5 col-lg-4">
                    <div class="switchable__text">
                        <h3>Result 1 from API</h3>
                        <p class="lead" id="result1"></p>
                        <hr class="short">
                        <div id="rat1" class="rateit" data-rateit-mode="font" style="font-size: 30px" data-rateit-resetable="false" ></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="switchable feature-large unpad--bottom hidden" id="secResult2">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-md-6">
                    <div class="switchable__text">
                        <h2>Result 2 from API</h2>
                        <p class="lead" id="result2"></p>
                        <div id="rat2" class="rateit" data-rateit-mode="font" style="font-size: 30px" data-rateit-resetable="false" ></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-12 text-center"><img alt="Image" src="{{asset('img/device-2.png')}}">
                </div>
            </div>
        </div>
    </section>
    <section class="switchable imagebg switchable--switch hidden" data-overlay="4" id="secResult3">
        <div class="background-image-holder"><img alt="background" src="{{asset('img/hero-1.jpg')}}"></div>
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-md-7"><img alt="Image" src="{{asset('img/device-2.png')}}"></div>
                <div class="col-md-5 col-lg-4">
                    <div class="switchable__text">
                        <h3>Result 3 from API</h3>
                        <p class="lead" id="result3"></p>
                        <hr class="short">
                        <div id="rat3" class="rateit" data-rateit-mode="font" style="font-size: 30px" data-rateit-resetable="false" ></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="switchable imagebg hidden" data-overlay="4" id="secResult4">
        <div class="background-image-holder"><img alt="background" src="{{asset('img/hero-1.jpg')}}"></div>
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-md-7"><img alt="Image" src="{{asset('img/device-2.png')}}"></div>
                <div class="col-md-5 col-lg-4">
                    <div class="switchable__text">
                        <h3>Result 4 from API</h3>
                        <p class="lead" id="result4"></p>
                        <hr class="short">
                        <div id="rat4" class="rateit" data-rateit-mode="font" style="font-size: 30px" data-rateit-resetable="false" ></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('libs/rateit/jquery.rateit.js')}}"></script>
    <script>
        function updateRating(ratingId, value) {
            console.log('update-rating', ratingId, value)
            $.ajax({
                method: 'post',
                url: '/api/query/rating',
                data: {
                    ratingId: ratingId,
                    value: value,
                },
                success: function (res) {
                    console.log(res);
                }
            })
        }

        function submitQuery() {
            var query = $('#query').val();
            if (query.trim().length) {
                $.ajax({
                    method: 'post',
                    url: '/api/query',
                    // contentType: 'application/json',
                    // dataType: 'application/json',
                    data: {
                        query: query,
                        userId: '{{$data->id}}'
                    },
                    success: function (res) {
                        try {
                            var data = JSON.parse(res);
                            console.log(data);
                            if (data.success) {
                                if (data.results.length) {
                                    for (var i = 0; i < data.results.length; i++) {
                                        var result = data.results[i].result;
                                        var ratingId = data.results[i].ratingId;
                                        $('#result' + (i + 1)).text(result);
                                        $('#secResult' + (i + 1)).removeClass('hidden');
                                        $('#rat' + (i + 1)).bind('rated', function (event, value) {
                                            updateRating(ratingId, value);
                                        });

                                    }

                                    $('.rateit').rateit();
                                    $('.creditValue').text(data.credit);
                                    window.location.href = '#secResult1';
                                    window.localStorage.setItem('lastQuery', '');
                                }
                            } else {
                                if (data.type === 'credit_insufficient') {
                                    window.localStorage.setItem('lastQuery', query);
                                    window.location.href = '/query';
                                }
                            }
                        } catch (e) {
                            console.log('error', e.message);
                        }
                    },
                    error: function (err) {
                        console.log('error', err)
                    }
                })
            } else {
                $('#description').html('Please type your query first.');
                $('#query').focus();
            }
        }

        function showDisclaimer() {
            document.getElementById('secDisclaimer').classList.remove('hidden');
            window.scrollTo(0, document.body.scrollHeight)
        }

        $(document).ready(function () {
            $('#btnQuery').click(function () {
                var query = $('#query').val();
                if (query.trim().length) {
                    showDisclaimer();
                } else {
                    $('#description').html('Please type your query first.');
                    $('#query').focus();
                }
            });

            $('#accept').click(function () {
                submitQuery();
            })
        });
    </script>
@endsection
