<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard &mdash; Arfa</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ url('/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    @stack('css')
    <link rel="stylesheet" href="{{ url('assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap-override.min.css') }}">
    <link rel="stylesheet" id="theme-color" href="{{ url('assets/css/dark.min.css') }}">
</head>

<body>
    <div id="app overflow-x-hidden" style="overflow-x: hidden">
        <div class="shadow-header"></div>
        
        @include('layouts.header')
        @include('layouts.nav')   

       @yield('content')

        @include('layouts.settings')

        <footer>
            Copyright © 2022 &nbsp <a href="https://www.youtube.com/c/mulaidarinull" target="_blank" class="ml-1"> Mulai Dari Null </a> <span> . All rights Reserved</span>
        </footer>
        <div class="overlay action-toggle">
        </div>
    </div>
    <script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ url('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <!-- js for this page only -->
    @stack('js')
    <!-- ======= -->
    <script src="{{ url('assets/js/main.min.js') }}"></script>
    <script>
        Main.init()
    </script>
</body>

</html>