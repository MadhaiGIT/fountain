<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fountain - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('layouts.styles')

</head>
<body data-smooth-scroll-offset="77">
<div class="nav-container">
    @yield('navigation')
</div>
<div class="main-container">
    @yield('content')
</div>

@include('layouts.scripts')
</body>

</html>
