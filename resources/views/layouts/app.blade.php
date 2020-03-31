<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/inter.css') }}">

        <!-- Styles -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">

        <!-- App -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-161631692-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-161631692-1');
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUGV56p7Lh1xmAV6WZgmuZ9Dy9CnE6494"></script>
    </head>
    <body>        
        <div id="app2">
            <div class="min-h-screen bg-gray-100">
                @if(auth()->check())
                <nav @keydown.window.escape="open = false" class="bg-gray-800">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex items-center justify-between h-16">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <a href="/">
                                            {{-- <img class="h-8 w-auto sm:h-10" src="/img/logos/workflow-mark-on-white.svg" alt="" /> --}}
                                            <svg class="h-6 w-6 text-gray-500" fill="currentColor" viewBox="0 0 274 375" stroke="currentColor">
                                                <g fill-rule="nonzero" fill="none"><path d="M274 137.986C274 62.199 212.664.776 137 .744 61.336.76 0 62.2 0 137.986c0 28.598 8.744 55.157 23.697 77.136h-.048L137 374.744h.032l113.351-159.622h-.048C265.256 193.142 274 166.584 274 137.986z" fill="#5850EC"/><circle fill="#FFF" cx="161" cy="109.744" r="36"/><path d="M127.443 156.896c-25.57-5.031-50.546 6.816-63.443 27.81 25.185 2.476 53.389 12.442 77.963 34.32l-33.103 46.635c-5.38 9.5-.401 21.589 10.119 24.515 6.939 1.897 15.002-1.03 18.824-7.652l38.066-53.563c6.473-32.97-15.531-65.603-48.426-72.065z" fill="#FFF"/></g></svg>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="hidden md:block">
                                        <div class="ml-10 flex items-baseline">
                                            <a href="{{ route('home') }}" class="px-3 py-2 rounded-md text-sm font-medium focus:outline-none focus:text-white focus:bg-gray-700 {{ Route::is('home') ? 'bg-gray-900 text-white' : 'text-gray-300' }}">Tableau de bord</a>
                                            <a href="{{ route('etablissements.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 {{ Route::is('etablissements.index') ? 'bg-gray-900 text-white' : 'text-gray-300' }}">Lits disponibles</a>
                                            <a href="{{ route('user.services.edit', ['user' => auth()->user()->id]) }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 {{ Route::is('user.services.edit') ? 'bg-gray-900 text-white' : 'text-gray-300' }}">Mettre à jour mes lits</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="hidden md:block">
                                    <div class="ml-4 flex items-center md:ml-6">
                                        {{-- Notifications (bell) --}}
                                        {{-- <button class="p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-white focus:outline-none focus:text-white focus:bg-gray-700"> --}}
                                            {{-- <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"> --}}
                                                {{-- <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /> --}}
                                                {{-- </svg> --}}
                                            {{-- </button> --}}
                                        <div  class="ml-3 relative">
                                            <div>

                                                <button type="button" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</button>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="-mr-2 flex md:hidden">
                                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white">
                                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div :class="{'block': open, 'hidden': !open}" class=" md:hidden">
                            <div class="px-2 pt-2 pb-3 sm:px-3">
                                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Tableau de bord</a>
                                <a href="{{ route('etablissements.index') }}" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Lits disponibles</a>
                                <a href="{{ route('user.services.edit', ['user' => auth()->user()->id]) }}" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Mettre à jour mes lits</a>
                            </div>
                            <div class="pt-4 pb-3 border-t border-gray-700">
                                <div class="flex items-center px-5">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-gray-400">
                                            <span class="text-md font-medium leading-none text-white">{{ auth()->user()->initials() }}</span>
                                        </span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-base font-medium leading-none text-white">{{ auth()->user()->name }}</div>
                                        <div class="mt-1 text-sm font-medium leading-none text-gray-400">{{ auth()->user()->email }}</div>
                                    </div>
                                </div>
                                <div class="mt-3 px-2">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Se déconnecter</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <header class="bg-white shadow-sm">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            <h2 class="text-lg leading-6 font-semibold text-gray-900">
                                @yield('page_title', 'Tableau de bord')
                                {{-- @yield('page_subtitle', '') --}}
                            </h2>
                        </div>
                    </header>
                @endif
                <main>
                    <div class="max-w-7xl mx-auto py-2 sm:py-6 sm:px-6 lg:px-8">
                        <!-- Replace with your content -->
                        <div class="sm:px-0">
                            @yield('content')
                        </div>
                        <!-- /End replace -->
                    </div>
                </main>
            </div>
            @include('partials.footer')
        </div>
        
    </body>
</html>
