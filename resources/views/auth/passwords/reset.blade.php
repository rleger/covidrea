@extends('layouts.app')

@section('content')
    <div class="row justify-content-center"><div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <h2 class="mt-2 mb-4 text-xl leading-9 font-extrabold text-gray-900">
                        Réinitialisez votre mot de passe
                    </h2>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div>

                            {{-- Success message --}}
                            @if (session('status'))
                                <div class="border border-green-400 rounded bg-green-100 mt-4 px-4 py-3 text-green-700">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div role="alert">
                                    <div class="border border-red-400 rounded bg-red-100 my-4 px-4 py-3 text-red-700">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <label for="email" class="mt-4 block text-sm font-medium leading-5 text-gray-700">
                                Adresse email
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">

                                <input id="email" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            </div>

                            <label for="email" class="mt-4 block text-sm font-medium leading-5 text-gray-700">
                                {{ __('Password') }}
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">

                                <input id="password" type="password" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" name="password" value="{{ $email ?? old('email') }}" required autocomplete="new-password">
                            </div>

                            <label for="email" class="mt-4 block text-sm font-medium leading-5 text-gray-700">
                                {{ __('Confirm Password') }}
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">

                                <input id="password-confirm" type="password" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" name="password_confirmation" value="{{ $email ?? old('email') }}" required autocomplete="new-password">
                            </div>



                        </div>

                        <div class="mt-6">
                            <span class="block w-full rounded-md shadow-sm">
                                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                    {{ __('Reset Password') }}
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div></div>
@endsection
