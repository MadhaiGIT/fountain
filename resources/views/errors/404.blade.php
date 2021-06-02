@extends('layouts.app')

@section('title', 'Error')

@section('content')
    <section class="height-100 text-center bg--dark">
        <div class="container pos-vertical-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="h1--large">500</h1>
                    <p class="lead"> An unexpected error has occurred preventing the page from loading. </p> <a href="/">Go back to home page</a> </div>
            </div>
        </div>
    </section>
@endsection
