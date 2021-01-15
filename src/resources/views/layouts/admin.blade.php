<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('mbober-starter::includes.favicon')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('meta-title', config('app.name', 'Laravel'))
    </title>
    <meta content="@yield('meta-title', config('app.name', 'Laravel'))" property="og:title">

    @stack('more-meta')

    <!-- Scripts -->
    @stack('js-lib')
    @include('mbober-starter::includes.scripts')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix("css/admin.css") }}">
</head>
<body>
    @include('mbober-starter::includes.svg')
    @stack("svg")

    <div id="app">
        @include("mbober-starter::layouts.nav")

        @include("mbober-starter::layouts.main")

        @include("mbober-starter::layouts.footer")
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/admin.js') }}" defer></script>
    @stack("more-scripts")
</body>
</html>