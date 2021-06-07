@extends('layouts.app')

@section('title', 'Credit')

@section('navigation')
    <style>
        form {
            width: 30vw;
            /*min-width: 500px;*/
            align-self: center;
            /*box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),*/
            /*0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);*/
            border-radius: 7px;
        }

        input {
            border-radius: 6px;
            margin-bottom: 6px;
            padding: 12px;
            border: 1px solid rgba(50, 50, 93, 0.1);
            height: 44px;
            font-size: 16px;
            width: 100%;
            background: white;
        }

        .result-message {
            line-height: 22px;
            font-size: 16px;
        }

        .result-message a {
            color: rgb(89, 111, 214);
            font-weight: 600;
            text-decoration: none;
        }

        .hidden {
            display: none;
        }

        #card-error {
            color: white;
            text-align: left;
            font-size: 13px;
            line-height: 17px;
            margin-top: 12px;
        }

        #card-element {
            border-radius: 4px 4px 0 0;
            padding: 12px;
            border: 1px solid rgba(50, 50, 93, 0.1);
            height: 44px;
            width: 100%;
            background: white;
        }

        #payment-request-button {
            margin-bottom: 32px;
        }

        /* Buttons and links */
        button#submit {
            background: #5469d4;
            color: #ffffff;
            font-family: Arial, sans-serif;
            border-radius: 4px;
            border: 0;
            font-weight: 600;
            cursor: pointer;
            display: block;
            transition: all 0.2s ease;
            box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
            width: 100%;
            margin-top: 0 !important;
        }

        button#submit:hover {
            filter: contrast(115%);
        }

        button#submit:disabled {
            opacity: 0.5;
            cursor: default;
        }

        /* spinner/processing state, errors */
        .spinner,
        .spinner:before,
        .spinner:after {
            border-radius: 50%;
        }

        .spinner {
            color: #ffffff;
            font-size: 22px;
            text-indent: -99999px;
            margin: 0px auto;
            position: relative;
            width: 20px;
            height: 20px;
            box-shadow: inset 0 0 0 2px;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
        }

        .spinner:before,
        .spinner:after {
            position: absolute;
            content: "";
        }

        .spinner:before {
            width: 10.4px;
            height: 20.4px;
            background: #5469d4;
            border-radius: 20.4px 0 0 20.4px;
            top: -0.2px;
            left: -0.2px;
            -webkit-transform-origin: 10.4px 10.2px;
            transform-origin: 10.4px 10.2px;
            -webkit-animation: loading 2s infinite ease 1.5s;
            animation: loading 2s infinite ease 1.5s;
        }

        .spinner:after {
            width: 10.4px;
            height: 10.2px;
            background: #5469d4;
            border-radius: 0 10.2px 10.2px 0;
            top: -0.1px;
            left: 10.2px;
            -webkit-transform-origin: 0px 10.2px;
            transform-origin: 0px 10.2px;
            -webkit-animation: loading 2s infinite ease;
            animation: loading 2s infinite ease;
        }

        @-webkit-keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @media only screen and (max-width: 600px) {
            form {
                width: 80vw;
            }
        }
    </style>
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
                            <a class="btn btn--sm btn--primary type--uppercase inner-link" href="/query"
                               target="_self">
                                <span class="btn__text">Query</span>
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
        <div class="background-image-holder"><img alt="background" src="{{asset('img/hero-1.jpg')}}"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <a class="payment-option" href="?option=1">
                        <div class="pricing pricing-3">
                            <div class="pricing__head bg--secondary boxed">
                                @if ($option == 1)
                                    <span class="label">Selected</span>
                                @endif
                                <h5>Single Query</h5> <span class="h1"><span class="pricing__dollar">$</span>1</span>
                                <p class="type--fine-print">BUY</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a class="payment-option" href="?option=2">
                        <div class="pricing pricing-3">
                            <div class="pricing__head bg--secondary boxed">
                                @if ($option == 2)
                                    <span class="label">Selected</span>
                                @endif
                                <h5>10 queries</h5> <span class="h1"><span class="pricing__dollar">$</span>9</span>
                                <p class="type--fine-print">BUY</p>
                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-md-6 col-lg-3">
                    <a class="payment-option" href="?option=3">
                        <div class="pricing pricing-3">
                            <div class="pricing__head bg--primary boxed">
                                @if ($option == 3)
                                    <span class="label">Selected</span>
                                @endif
                                <h5>50 queries</h5> <span class="h1"><span class="pricing__dollar">$</span>40</span>
                                <p class="type--fine-print">BUY</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a class="payment-option" href="?option=4">
                        <div class="pricing pricing-3">
                            <div class="pricing__head bg--secondary boxed">
                                @if ($option == 4)
                                    <span class="label">Selected</span>
                                @endif
                                <h5>100 queries</h5> <span class="h1"><span class="pricing__dollar">$</span>75</span>
                                <p class="type--fine-print">BUY</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center imagebg" data-gradient-bg="#4876BD,#5448BD,#8F48BD,#BD48B1">
        <div class="container">
            <div class="row justify-content-center">
                <h2>Pay ${{$amount}} to buy {{$queryCount}} queries</h2>
            </div>
            <div class="row justify-content-center">
                <form
                    id="payment-form"
                    class="col-lg-5 col-md-6 col-12"
                >
                    <div id="card-element"></div>
                </form>
                <div class="col-lg-3 col-md-6">
                    <button id="submit" type="button" onclick="buyNow()">
                        <div class="spinner hidden" id="spinner"></div>
                        <span id="button-text">Buy Now</span>
                    </button>
                </div>
            </div>
            <div class="row justify-content-center">
                <p id="card-error" role="alert"></p>
                <p class="result-message hidden">
                    Payment succeeded, see the result in your <a href="#">Stripe dashboard.</a>
                    Refresh the page to pay again.
                </p>
            </div>
            <div class="hidden">
                <form id="pForm" method="post" action="/credit">
                    @csrf
                    <input type="hidden" name="id" id="pId">
                    <input type="hidden" name="amount" id="pAmount">
                    <input type="hidden" name="status" id="pStatus">
                    <input type="hidden" name="currency" id="pCurrency">
                </form>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>

        function payWithCard(stripe, card, clientSecret) {
            console.log('payWithCard');
            loading(true);
            stripe
                .confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: card
                    }
                })
                .then(function (result) {
                    if (result.error) {
                        // Show error to your customer
                        showError(result.error.message);

                    } else {
                        // The payment succeeded!
                        console.log('complete', result);
                        var pi = result.paymentIntent;
                        $('#pId').val(pi.id);
                        $('#pAmount').val(pi.amount);
                        $('#pCurrency').val(pi.currency);
                        $('#pStatus').val(pi.status);
                        orderComplete(result.paymentIntent.id);
                        $('#pForm').submit();
                    }
                });
        }


        // UI helpers
        // Shows a success message when the payment is complete
        function orderComplete(paymentIntentId) {
            console.log('orderComplete', paymentIntentId);
            loading(false);
            document
                .querySelector(".result-message a")
                .setAttribute(
                    "href",
                    "https://dashboard.stripe.com/test/payments/" + paymentIntentId
                );
            document.querySelector(".result-message").classList.remove("hidden");
            document.querySelector("button").disabled = true;
        }

        // Show the customer the error from Stripe if their card fails to charge
        function showError(errorMsgText) {
            console.log('showError');

            loading(false);
            var errorMsg = document.querySelector("#card-error");
            errorMsg.textContent = errorMsgText;
            setTimeout(function () {
                errorMsg.textContent = "";
            }, 4000);
        }

        // Show a spinner on payment submission
        function loading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("button").disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("button").disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
        }

        var stripe = Stripe('{{env('STRIPE_TEST_KEY')}}');
        var purchase = {
            items: [{id: "queries"}]
        };
        document.querySelector('button').disabled = true;
        var elements = stripe.elements();
        var style = {
            base: {
                color: "#32325d",
                fontFamily: 'Arial, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#32325d"
                }
            },
            invalid: {
                fontFamily: 'Arial, sans-serif',
                color: "#fa755a",
                iconColor: "#fa755a"
            }
        };

        var card = elements.create("card", {style: style});
        card.mount('#card-element');
        card.on("change", function (event) {
            // Disable the Pay button if there are no card details in the Element
            console.log('card-change', event.empty);
            if (!event.empty) {
                document.querySelector("button").removeAttribute('disabled');
            } else {
                document.querySelector("button").disabled = true;
            }
            if (event.error) {
                document.querySelector(".result-message").classList.add("hidden");
                document.querySelector("#card-error").textContent = event.error.message;
            } else {
                document.querySelector("#card-error").textContent = "";

            }
        });
        // var form = document.getElementById("payment-form");
        // form.addEventListener("submit", function (event) {
        //     event.preventDefault();
        //     // Complete payment when the submit button is clicked
        // });

        function buyNow() {
            console.log('buyNow', stripe, card);
            payWithCard(stripe, card, '{{$intent->client_secret}}');
        }
    </script>
@endsection
