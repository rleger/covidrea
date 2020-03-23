@extends('layouts.app')

@section('page_title', 'Finalisez votre inscription')

@section('content')
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Créez votre compte</h3>
                    <p class="mt-1 text-sm leading-5 text-gray-500">
                        Saisissez les information suivantes pour créer votre compte et accéder à l'application.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{ route('invite.finalize') }}" method="POST">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Nouvel utilisateur pour {{ $etablissement->name }}
                            </h3>
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">


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

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Nom</label>
                                    <input id="name" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="phone_mobile" class="block text-sm font-medium leading-5 text-gray-700">Téléphone portable</label>
                                    <input id="phone_mobile" type="tel" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium leading-5 text-gray-700">Mot de passe</label>
                                    <input id="password" type="password" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password_confirm" class="block text-sm font-medium leading-5 text-gray-700">Confirmer le mot de passe</label>
                                    <input id="password_confirm" type="password" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>



                                <div class="col-span-6 sm:col-span-3">
<div class="max-w-lg">
                  <div class="relative flex items-start">
                    <div class="absolute flex items-center h-5">
                      <input id="comments" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                    </div>
                    <div class="pl-7 text-sm leading-5">
                      <label for="comments" class="font-medium text-gray-700">Comments</label>
                      <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                    </div>
                  </div>
                  <div class="mt-4">
                    <div class="relative flex items-start">
                      <div class="absolute flex items-center h-5">
                        <input id="candidates" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                      </div>
                      <div class="pl-7 text-sm leading-5">
                        <label for="candidates" class="font-medium text-gray-700">Candidates</label>
                        <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                      </div>
                    </div>
                  </div>
                  <div class="mt-4">
                    <div class="relative flex items-start">
                      <div class="absolute flex items-center h-5">
                        <input id="offers" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                      </div>
                      <div class="pl-7 text-sm leading-5">
                        <label for="offers" class="font-medium text-gray-700">Offers</label>
                        <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                      </div>
                    </div>
                  </div>
        </div>

                            </div>



                                <div class="col-span-6 sm:col-span-3">
                                    <label for="service" class="block text-sm font-medium leading-5 text-gray-700">Service(s)</label>

                                        <div class="absolute flex items-center h-5">
                                            @foreach($services as $service)
                                            <div class="pl-7 text-sm leading-5">
                                                <div class="mt-4">
                                                    <div class="relative flex items-start">
                                                        <input id="service{{$service->id}}" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                                                    </div>
                                                    <div class="pl-7 text-sm leading-5">
                                                        <label for="services" class="font-medium text-gray-700">{{ $service->name }}</label>
                                                        <p class="text-gray-500">{{ $service->type }}</p>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>

                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
