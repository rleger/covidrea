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
        <title>{{ config('app.env') == 'production' ? '' : "*" . substr(config('app.env'), 0, 3) . "." }} {{  config('app.name', 'Covid moi un lit') }} - application de recherche de lit de réanimation pour les professionnels</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/inter.css') }}">
        <!-- Styles -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="fixed bottom-0 inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-sm sm:w-full sm:p-6">
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                        <svg class="h-6 w-6 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            @yield('message')
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm leading-5 text-gray-500">
                                @yield('code') | @yield('title')
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6">
                    <span class="flex w-full rounded-md shadow-sm">
                        <a href="@yield('redirect_url', '/')" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            @yield('redirect_text', "Revenir à la page d'accueil")
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </body>
</html>
