<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @if(config('app.env') != 'production')
            <meta name="robots" content="noindex">
            <meta name="googlebot" content="noindex">
        @endif

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title></title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/inter.css') }}">

        <!-- Styles -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">

        <!-- App -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        @if(config('app.env') != 'production')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-161631692-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-161631692-1');
        </script>
        @endif
    </head>
    <body>
    <header>
    <div class="flex items-center justify-center pt-2">
        <a href="/">   
           <img src="/images/logo.png"> 
        </a> 
    </div>      
    </header>
    <main>
        <div class="max-w-7xl mx-auto py-2 sm:py-6 sm:px-6 lg:px-8">
            <!-- Replace with your content -->
            <div class="sm:px-0">
                @yield('content')
            </div>
            <!-- /End replace -->
        </div>
    </main>
    @include('partials.footer')
    
    </body>
</html>
