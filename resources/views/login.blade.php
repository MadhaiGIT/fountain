@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <section class="height-100 imagebg text-center" data-overlay="4">
        <div class="background-image-holder"><img alt="background" src="{{asset('img/inner-6.jpg')}}"></div>
        <div class="container pos-vertical-center">
            <div class="row">
                <div class="col-md-7 col-lg-5">
                    <h2>Login to continue</h2>

                    <a class="btn block btn--icon bg--facebook type--uppercase"
                       href="#" onclick="fbLogin()"> <span
                            class="btn__text">
                        <i class="socicon-facebook"></i>
                        Login with Facebook
                    </span> </a>

                    <a class="btn block btn--icon bg--twitter type--uppercase" href="/google"> <span class="btn__text">
                        <i class="socicon-google"></i>
                        Login with google</span> </a>
                    <hr>
                    <p>Login using your Stack account</p>
                    @if ($errors->any())
                        <div class="alert alert__body text-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="/login" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12"><input type="text" placeholder="Username" name="email" required></div>
                            <div class="col-md-12"><input type="password" placeholder="Password" name="password"
                                                          required></div>
                            <div class="col-md-12"><input type="hidden" placeholder="redirect" name="redirect"
                                                          value="{{$redirect ?? ''}}"></div>
                            <div class="col-md-12">
                                <button class="btn btn--primary type--uppercase" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                    <span class="type--fine-print block">Don't have an account yet? <a href="/signup">Create account</a></span>
                    <span class="type--fine-print block">Forgot your username or password? <a
                            href="/recover">Recover account</a></span></div>
            </div>
        </div>
    </section>
    <script>
        function fbLogin() {
            console.log('fbLogin');
            FB.login(function(response) {

                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    //console.log(response); // dump complete info
                    access_token = response.authResponse.accessToken; //get access token
                    user_id = response.authResponse.userID; //get FB UID

                    FB.api('/me', function(response) {
                        user_email = response.email; //get user email
                        // you can store this data into your database
                    });

                } else {
                    //user hit cancel button
                    console.log('User cancelled login or did not fully authorize.');

                }
            }, {
                scope: 'public_profile,email'
            });

        }

        function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
            console.log('statusChangeCallback');
            console.log(response);                   // The current login status of the person.
            if (response.status === 'connected') {   // Logged into your webpage and Facebook.
                testAPI();
            } else {                                 // Not logged into your webpage or we are unable to tell.
                document.getElementById('status').innerHTML = 'Please log ' +
                    'into this webpage.';
            }
        }


        function checkLoginState() {               // Called when a person is finished with the Login Button.
            FB.getLoginStatus(function (response) {   // See the onlogin handler
                statusChangeCallback(response);
            });
        }


        window.fbAsyncInit = function () {
            FB.init({
                appId: '406964643619783',
                cookie: true,                     // Enable cookies to allow the server to access the session.
                xfbml: true,                     // Parse social plugins on this webpage.
                version: 'v10.0'           // Use this Graph API version for this call.
            });


            FB.getLoginStatus(function (response) {   // Called after the JS SDK has been initialized.
                statusChangeCallback(response);        // Returns the login status.
            });
        };

        function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', function (response) {
                console.log('Successful login for: ' + response.name);
                document.getElementById('status').innerHTML =
                    'Thanks for logging in, ' + response.name + '!';
            });
        }

    </script>
@endsection
