<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <link rel="stylesheet" href="{{ mix("css/adminkit.css") }}">
</head>
<body>
    @include('mbober-starter::includes.svg')
    @stack("svg")

    <div id="app" class="wrapper">
        @include("mbober-starter::adminkit.nav")
        @include("mbober-starter::adminkit.main")
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/adminkit.js') }}" defer></script>
    @stack("more-scripts")
</body>
</html>
