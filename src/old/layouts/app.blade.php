<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 共通css -->
  <link href="{{ asset('/css/style.css') }}" rel="stylesheet" />
  <!-- 個別css -->
  @stack('styles')

  <title>@yield('title')</title>

</head>

<body>

    @include('conponents.header')
    <!-- 見出し -->
    <h2 class="section_title">@yield('section_title')</h2>
    @yield('content')
    @include('conponents.footer')
    <!-- js -->
    @stack('scripts')

</body>

</html>