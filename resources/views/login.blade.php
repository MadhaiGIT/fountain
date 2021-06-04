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
                       href="/facebook" onclick="fbLogin()"> <span
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
                            <div class="col-md-12"><input type="email" placeholder="Email " name="email" required></div>
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
@endsection

@section('scripts')
    <script src="{{asset('js/facebook.js')}}"></script>
@endsection
