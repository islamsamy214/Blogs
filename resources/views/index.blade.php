<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <div id="app">
        @if (auth()->guard('clients')->user() && auth()->user())
            <blog-app 
                :client="{{ auth()->guard('clients')->user() }}" 
                :user="{{ auth()->user() }}">
            </blog-app>
        @elseif(auth()->guard('clients')->user())
            <blog-app :client="{{ auth()->guard('clients')->user() }}"></blog-app>
        @elseif(auth()->user())
            <blog-app :user="{{ auth()->user() }}"></blog-app>
        @else
            <blog-app></blog-app>
        @endif

    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
