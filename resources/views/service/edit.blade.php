@extends('layouts.app')

@section('page_title', "Edition de l'établissement")

@section('content')

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Service</h3>
                    <p class="mt-1 text-sm leading-5 text-gray-500">
                        Cette section vous permet de mettre à jour les informations d'un service
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form id="form_service" action="{{ route('service.update', $service) }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            {{-- Display errors if any --}}
                            @if ($errors->any() && $service->id == session('service_id'))
                                <div role="alert">
                                    <div class="border border-red-400 rounded bg-red-100 mt-4 px-4 py-3 text-red-700 mb-4">
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

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Nom</label>
                                    <input id="name" name="name" value="{{ $service->name }}" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
<div class="col-span-6 sm:col-span-4">
                                    <label for="contact" class="block text-sm font-medium leading-5 text-gray-700">Contact</label>
                                    <input id="contact" name="contact" value="{{ $service->contact }}" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" form="form_service" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                {{ __('Save') }}
                            </button>

                            {{-- Annuler --}}
                            <a href="{{ Request::url() }}" class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-50 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray active:bg-gray-200 transition ease-in-out duration-150">
                                {{ __('Cancel') }}
                            </a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
