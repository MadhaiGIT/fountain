<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fountain - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('layouts.styles')

</head>
<body data-smooth-scroll-offset="77">
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0" nonce="8afdmI4G"></script>

<div class="nav-container">
    @yield('navigation')
</div>
<div class="main-container">
    @yield('content')
</div>

@include('layouts.scripts')
</body>

</html>
