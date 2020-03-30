@extends('layouts.app')

@section('page_title', 'Créez votre compte')

@section('content')
    <h2>
        {{$prospect->name}}
    </h2>
    <div class="hidden sm:block">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Créez votre compte</h3>
                    <p class="mt-1 text-sm leading-5 text-gray-500">
                        Saisissez les informations manquantes pour créer votre compte et accéder à l'invitation des utilisateurs.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form id="register" action="{{ route('register.process') }}" method="POST">
                    @csrf
                    {{-- Hidden fields --}}
                    <input type="hidden" name="prospect" value="{{ $prospect->id}}"></input>
                    <input type="hidden" name="etab_type" value="{{ $prospect->etab_type}}"></input>
                    <input type="hidden" name="etab_long" value="{{ $prospect->etab_long}}"></input>
                    <input type="hidden" name="etab_lat" value="{{ $prospect->etab_lat}}"></input>
                    {{-- End hidden fields --}}

                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            {{-- Display errors if any --}}
                            @if ($errors->any())
                                <div role="alert">
                                    <div class="mb-4 border border-red-400 rounded bg-red-100 mt-4 px-4 py-3 text-red-700 pb-4">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            {{-- Success message --}}
                            @if (session('status'))
                                <div class="border border-green-400 rounded bg-green-100 mt-4 px-4 py-3 text-green-700 mb-4">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="etab_name" class="block text-sm font-medium leading-5 text-gray-700">Nom de l'établissement</label>
                                    <input id="etab_name" name="etab_name" value="{{ $prospect->etab_name }}" readonly class="disabled:opacity-75 bg-gray-100 text-gray-500 mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>


                                <div class="col-span-6 sm:col-span-3">
                                    <label for="etab_region" class="block text-sm font-medium leading-5 text-gray-700">Country / Region</label>
                                    <input id="etab_region" name="etab_region" value="{{ $prospect->etab_region }}" readonly class="disabled:opacity-75 bg-gray-100 text-gray-500 mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm bg-gray-100 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>


                                <div class="col-span-6">
                                    <label for="etab_adresse" class="block text-sm font-medium leading-5 text-gray-700">Adresse</label>
                                    <input id="etab_adresse" name="etab_adresse" value="{{ $prospect->etab_adresse }}" readonly class="disabled:opacity-75 bg-gray-100 text-gray-500 mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="etab_ville" class="block text-sm font-medium leading-5 text-gray-700">Ville</label>
                                    <input id="etab_ville" name="etab_ville" value="{{ $prospect->etab_ville }}" readonly class="disabled:opacity-75 bg-gray-100 text-gray-500 mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="etab_region" class="block text-sm font-medium leading-5 text-gray-700">Région</label>
                                    <input id="etab_region" name="etab_region" value="{{ $prospect->etab_region }}" readonly class="disabled:opacity-75 bg-gray-100 text-gray-500 mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="etab_codepostal" class="block text-sm font-medium leading-5 text-gray-700">Code postal</label>
                                    <input id="etab_codepostal" name="etab_codepostal" value="{{ $prospect->etab_codepostal }}" readonly class="disabled:opacity-75 bg-gray-100 text-gray-500 mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>



                                <div class="col-span-6 sm:col-span-4">
                                    <label for="user_name" class="block text-sm font-medium leading-5 text-gray-700">Nom</label>
                                    <input id="user_name" name="user_name" value="{{ $prospect->user_name }}" autofocus class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>


                                <div class="col-span-6 sm:col-span-4">
                                    <label for="user_email" class="block text-sm font-medium leading-5 text-gray-700">Email address</label>
                                    <input id="user_email" name="user_email" value="{{ $prospect->user_email }}" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="password" class="block text-sm font-medium leading-5 text-gray-700">Mot de passe</label>
                                    <input id="password" type="password" name="password" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    <p class="mt-2 text-sm text-gray-500">Le mot de passe doit comporter 8 caractères au minimum</p>
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="password_confirm" class="block text-sm font-medium leading-5 text-gray-700">Confimez votre mot de passe</label>
                                    <input id="password_confirm" type="password" name="password_confirm" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>


                                <div class="col-span-6 sm:col-span-4">
                                    <label for="user_phone" class="block text-sm font-medium leading-5 text-gray-700">Téléphone mobile</label>
                                    <input id="user_phone" name="user_phone" value="{{ $prospect->user_phone }}" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 border-t border-gray-200  text-right sm:px-6">
                            <button type="submit" form="register" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
