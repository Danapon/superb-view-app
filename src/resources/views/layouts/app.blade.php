<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://kit.fontawesome.com/7e8cdb0d53.js" crossorigin="anonymous"></script>

    <!-- mapbox -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet">
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-language/v1.0.0/mapbox-gl-language.js'></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- 共通css -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet" />
    <!-- 個別css -->
    @stack('styles')
    <!-- favicon -->
    <link rel="icon" href="{{ asset('/favicon.png') }}">

</head>
<body>
    <div id="app">
        @include('conponents.header')
        <!-- <main class="py-4"> -->
        <main class="container">
            <!-- 見出し -->
            {{-- <h2 class="section_title">@yield('section_title')</h2> --}}
            @yield('content')
        </main>
        @include('conponents.footer')
    </div>
    <!-- js -->
    @stack('scripts')
</body>
</html>
