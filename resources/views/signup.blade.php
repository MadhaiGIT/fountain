@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
    <section class="imageblock switchable feature-large height-100">
        <div class="imageblock__content col-lg-6 col-md-4 pos-right">
            <div class="background-image-holder"><img alt="image" src="{{asset('img/inner-6.jpg')}}"></div>
        </div>
        <div class="container pos-vertical-center">
            <div class="row">
                <div class="col-lg-5 col-md-7">
                    <h2>Fountain project Signup</h2>
                    <a class="btn block btn--icon bg--facebook type--uppercase" href="/facebook"> <span
                            class="btn__text">
                        <i class="socicon-facebook"></i>
                        Sign up with Facebook
                    </span> </a>
                    <a class="btn block btn--icon bg--twitter type--uppercase" href="/google"> <span class="btn__text">
                        <i class="socicon-google"></i>
                        Sign up with Google
                    </span> </a>
                    <hr data-title="OR">
                    @if ($errors->any())
                        <div class="alert alert__body text-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    @if ($error == 'The email already exists.')
                                        <li><a href="/recover" class="text-danger">{{$error}}</a></li>
                                    @else
                                        <li>{{$error}}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/signup" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12"><input type="text" name="nickname"
                                                       placeholder="Nickname" required></div>
                            <div class="col-12"><input type="email" name="email"
                                                       placeholder="Email Address" required></div>
                            <div class="col-12"><input type="password" name="password" placeholder="Password"
                                                       required></div>
                            <div class="col-12">
                                <button type="submit" class="btn btn--primary type--uppercase">Create Account
                                </button>
                            </div>
                            <div class="col-12"><span class="type--fine-print">By signing up, you agree to the <a
                                        href="/policy">Terms of Service</a></span></div>
                        </div>
                    </form>
                    <span class="type--fine-print block">Already registered? <a href="/login">Login</a></span>
                </div>
            </div>
        </div>
    </section>
@endsection

