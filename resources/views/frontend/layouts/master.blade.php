<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mojo Eid Campaign - Ranking')</title>
    @include('frontend.layouts.partials.analytical')
    
    <link rel="shortcut icon" href="{{ asset('public/assets/frontend/img/rankLogo.png') }}" type="image/x-icon">

    @yield('social_meta')
    @include('frontend.layouts.partials.styles')
</head>

<body>
    <div id="fb-root"></div>
    @include('frontend.layouts.partials.navbar')

    @yield('content')

    @yield('footer')

    @include('frontend.layouts.partials.scripts')
    @yield('scripts')
</body>

</html>