@extends('layouts.app')

@section('page_title', 'Finalisez votre inscription')

@section('content')
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('invite.finalize') }}" method="POST">
                @csrf
                <div>
                    <div>
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Profile
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                                Nouvel utilisateur pour {{ $etablissement->name }}
                            </p>
                        </div>
                    </div>


                    <div class="">
                            {{-- Success message --}}
                            @if (session('status'))
                                <div class="border border-green-400 rounded bg-green-100 mb-4 px-4 py-3 text-green-700">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{-- Display errors if any --}}
                            @if ($errors->any())
                                <div role="alert">
                                    <div class="border border-red-400 rounded bg-red-100 mb-4 px-4 py-3 text-red-700">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                        <div class="mt-6 sm:mt-5">

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="name" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                    Nom
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <div class="max-w-xs rounded-md shadow-sm">
                                        <input name="name" id="name" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="phone_mobile" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                    Téléphone portable
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <div class="max-w-xs rounded-md shadow-sm">
                                        <input name="phone_mobile" type="tel" id="phone_mobile" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="password" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                    Mot de passe
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <div class="max-w-lg rounded-md shadow-sm">
                                        <input id="password" type="password" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="password" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                    Confirmez mot de passe
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <div class="max-w-lg rounded-md shadow-sm">
                                        <input id="password_confirm" name="password_confirm" type="password" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="mt-8 border-t border-gray-200 pt-8 sm:mt-5 sm:pt-10">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Services
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                                Selectionnez les services dans lesquels vous intervenez, vous aurez le droit de modifier les places pour ces services uniquement.
                            </p>
                        </div>
                        <div class="mt-6 sm:mt-5">
                            <div class="sm:border-t sm:border-gray-200 sm:pt-5">
                                <fieldset>
                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                                        <div>
                                            <legend class="text-base leading-6 font-medium text-gray-900 sm:text-sm sm:leading-5 sm:text-gray-700">
                                                Services
                                            </legend>
                                        </div>
                                        <div class="mt-4 sm:mt-0 sm:col-span-2">
                                            <div class="max-w-lg">
                                                @foreach($services as $service_key => $service)
                                                    <div class="{{ !$service_key ? 'relative flex items-start' : ''}} mt-4">
                                                        <div class="relative flex items-start">
                                                            <div class="absolute flex items-center h-5">
                                                                <input id="candidates" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                                                            </div>
                                                            <div class="pl-7 text-sm leading-5">
                                                                <label for="candidates" class="font-medium text-gray-700">{{ $service->name }}</label>
                                                                <p class="text-gray-500">{{ $service->type}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-200 pt-5">
                    <div class="flex justify-end">
                        <span class="inline-flex rounded-md shadow-sm">
                            <button type="button" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                Cancel
                            </button>
                        </span>
                        <span class="ml-3 inline-flex rounded-md shadow-sm">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                Save
                            </button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
