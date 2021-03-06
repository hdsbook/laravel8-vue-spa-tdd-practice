<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield('title', config('app.name', 'Laravel'))
        </title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="font-sans antialiased">
        <div id="app"></div>

        <!-- Scripts -->
        <script>
            function base_url(url) {
                var APP_URL = {!! json_encode(url('/')) !!};
                return url
                    ? APP_URL + '/' + url
                    : APP_URL;
            }
        </script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
