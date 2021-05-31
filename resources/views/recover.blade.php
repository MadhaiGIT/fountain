@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <section class="height-100 imagebg text-center" data-overlay="4">
        <div class="background-image-holder"><img alt="background" src="{{asset('img/inner-6.jpg')}}"></div>
        <div class="container pos-vertical-center">
            <div class="row">
                <div class="col-md-7 col-lg-5">

                    <p>Recover your account</p>
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
                            <div class="col-12"><input type="text" placeholder="Email" name="email" required></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn--primary type--uppercase" type="submit">Recover</button>
                            </div>
                        </div>
                    </form>
                    <span class="type--fine-print block">Don't have an account yet? <a href="/signup">Create account</a></span>
                    <span class="type--fine-print block">Remember your username or password? <a
                            href="/login">Login</a></span></div>
            </div>
        </div>
    </section>
@endsection
