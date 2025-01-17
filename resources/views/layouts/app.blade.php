<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LipescRo') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('extra-head')
</head>

<body>
    @include('partials.navbar')
    @includeWhen(request()->path() == '/', 'partials.hero')
    @includeWhen(request()->path() != '/', 'partials.breadcrumbs')
    @include('partials.messages')
    <main role="main">
        @yield('content')
    </main>
    @include('partials.footer')

    @yield('extra-footer')
    <script>
        $('form').preventDoubleSubmission();
    </script>
</body>

</html>
