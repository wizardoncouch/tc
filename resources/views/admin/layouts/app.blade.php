<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Team Console: {{ $title }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-colors/1.2.6/colors.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">



    <link href="{{ asset('css/vendor.css') }}" rel="stylesheet">
    @if(file_exists('css/admin/'.$name.'.css'))
        <link href="{{ asset('css/admin/'.$name.'.css') }}" rel="stylesheet">
    @endif
    @yield('css')
</head>
<body class="theme-gradient-sidebar-3">
    <div class="layout-container">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @if(Auth::guard('admin')->check())
        <script src="{{ asset('js/admin/logged.js') }}" defer></script>
    @endif
    @if(file_exists('js/admin/'.$name.'.js'))
    <script src="{{ asset('js/admin/'.$name.'.js') }}" defer></script>
    @endif
    @yield('js')
</body>
</html>
