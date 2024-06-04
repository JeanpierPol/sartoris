<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/richtexteditor/rte_theme_default.css')}}">
    <script type="text/javascript" src="{{ asset('assets/richtexteditor/rte.js')}}"></script>  
    <script type="text/javascript" src="{{asset ('assets/richtexteditor/plugins/all_plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset ('assets//richtexteditor/lang/rte-lang-es.js')}}"></script>
    @if (Auth::guard('vendedor')->check())
        <link rel="icon" href="{{ asset('faviconV.ico') }}">
    @else
        <link rel="icon" href="{{ asset('faviconC.ico') }}">
    @endif
    

</head>

<body>

    <header>
        @if (Auth::guard('vendedor')->check())

            @include('layout.navbar-vendedor')

        @else
            @include('layout.navbar-comprador')

        @endif
    </header>

    <div class="content">
        @yield('content')
    </div>
    
   
</html>