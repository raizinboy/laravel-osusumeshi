<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/72fb19de51.js" crossorigin="anonymous"></script>

    <!--style -->
    <link href="https://fonts.googleapis.com/earlyaccess/hannari.css" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        @component('components.header')
        @endcomponent    

        <main class="py-1">
            @yield('content')
        </main>

        @component('components.footer')
        @endcomponent  
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>
    @vite(['resources/css/app.css','resources/js/app.js']) 
</body>
</html>
