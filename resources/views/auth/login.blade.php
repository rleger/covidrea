@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col justify-center sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            {{-- <img class="mx-auto h-12 w-auto" src="/img/logos/workflow-mark-on-white.svg" alt="Workflow" /> --}}
            <svg class="mx-auto h-10 sm:h-12 w-auto" fill="none" viewBox="0 0 274 375" stroke="currentColor">
                {{-- <svg class="h-6 w-6 text-gray-500" fill="currentColor" viewBox="0 0 274 375" stroke="currentColor"> --}}
                    <g fill-rule="nonzero" fill="none"><path d="M274 137.986C274 62.199 212.664.776 137 .744 61.336.76 0 62.2 0 137.986c0 28.598 8.744 55.157 23.697 77.136h-.048L137 374.744h.032l113.351-159.622h-.048C265.256 193.142 274 166.584 274 137.986z" fill="#5850EC"/><circle fill="#FFF" cx="161" cy="109.744" r="36"/><path d="M127.443 156.896c-25.57-5.031-50.546 6.816-63.443 27.81 25.185 2.476 53.389 12.442 77.963 34.32l-33.103 46.635c-5.38 9.5-.401 21.589 10.119 24.515 6.939 1.897 15.002-1.03 18.824-7.652l38.066-53.563c6.473-32.97-15.531-65.603-48.426-72.065z" fill="#FFF"/></g></svg>
            </svg>


            <h2 class="mt-3 sm:mt-6 text-center text-xl leading-9 font-extrabold text-gray-900 sm:text-3xl">{{ __('Login') }}</h2>
            {{-- <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w"> --}}
                {{-- ou --}}
                {{-- <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"> --}}
                    {{-- demander un accès --}}
                    {{-- </a> --}}
                {{-- </p> --}}
        </div>

        <div class="sm:mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                            {{ __('E-Mail Address') }}
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <!-- <input id="email" type="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" /> -->

                            <input id="email" type="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                        </div>
                        @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="mt-6">
                        <label for="password" class="block text-sm font-medium leading-5 text-gray-700">{{ __('Password') }}</label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="password" name="password" type="password" required autocomplete="current-password" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') is-invalid @enderror" />

                        </div>

                        @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="mt-6 flex items-center justify-between">
                        {{-- <div class="flex items-center"> --}}
                            {{-- <input id="remember" name="remember" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" {{ old('remember') ? 'checked' : '' }} /> --}}

                            {{-- <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900"> --}}
                                {{-- {{ __('Remember Me') }} --}}
                                {{-- </label> --}}
                            {{-- </div> --}}

                        @if (Route::has('password.request'))
                            <div class="text-sm leading-5">
                                <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                {{ __('Login') }}
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            <h3 class="text-center"><a href="/#inscription">Vous n'avez pas encore de compte manifestez votre intérêt !</a></h3>
        </div>
    </div>
@endsection
