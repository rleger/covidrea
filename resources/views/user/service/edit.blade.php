@extends('layouts.app')

@section('page_title', 'Mettre à jour mes lits')

@section('content')

    @foreach($services->all() as $etablissement_id => $grouped_service)
        <div class="mb-16 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-indigo-600">
                    {{$grouped_service[0]->etablissement->name}}
                </h3>
                <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                    {{ $grouped_service[0]->etablissement->type }}
                </p>
            </div>
            <div>
                @foreach($grouped_service as $service_key => $service)
                    <dl>
                        <div class="{{ $service_key ? 'border-t' : '' }} px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-8 sm:pb-10">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                            <span class="flex">
                                {{ $service->name }}
                            </span>
                            {{-- <span class="flex text-xs"> --}}
                                {{-- {{ $service->type }} --}}
                            {{-- </span> --}}
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">

                            <h3 class="text-lg leading-6 font-medium text-gray-900 hidden sm:block">Mise à jour des données</h3>
                            <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500 hidden sm:block">Veillez à bien enregistrer vos changements.</p>


                            {{-- Success message --}}
                            @if (session('status') && $service->id == session('service_id'))
                                <div class="border border-green-400 rounded bg-green-100 mt-4 px-4 py-3 text-green-700">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form action="/service/{{$service->id}}" method="POST">
                                @method('PATCH')
                                @csrf

                                {{-- {{ session('service_id') }} --}}
                                {{-- Display errors if any --}}
                                @if ($errors->any() && $service->id == session('service_id'))
                                    <div role="alert">
                                        <div class="border border-red-400 rounded bg-red-100 mt-4 px-4 py-3 text-red-700">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif


                                <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                                    <div class="sm:col-span-2">
                                        <label for="place_totales" class="block text-sm font-medium leading-5 text-gray-700">
                                            Places totales
                                        </label>
                                        <div class="mt-1 rounded-md shadow-sm">
                                            <input type="number" min=0 max=100 step=1 value="{{ $service->place_totales }}" id="place_totales" name="place_totales" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="place_disponible" class="block text-sm font-medium leading-5 text-gray-700">
                                            Places disponibles
                                        </label>
                                        <div class="mt-1 rounded-md shadow-sm">
                                            <input type="number" min=0 max=100 step=1 value="{{ $service->place_disponible }}" id="place_disponible" name="place_disponible" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="place_bientot_disponible" class="block text-sm font-medium leading-5 text-gray-700">
                                            Places bientôt disponibles
                                        </label>
                                        <div class="mt-1 rounded-md shadow-sm">
                                            <input type="number" min=0 max=100 step=1 value="{{ $service->place_bientot_disponible }}" name="place_bientot_disponible" id="place_bientot_disponible" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                        </div>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <span class="inline-flex rounded-md shadow-sm">
                                            {{-- Valider --}}
                                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                                {{ __('Save') }}
                                            </button>

                                            {{-- Annuler --}}
                                            <a href="{{ Request::url() }}" class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-50 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray active:bg-gray-200 transition ease-in-out duration-150">
                                                {{ __('Annuler') }}
                                            </a>

                                        </span>
                                    </div>
                                </div>
                            </form>



                            </dd>
                        </div>
                    </dl>
                @endforeach
            </div>
        </div>
    @endforeach
@endsection
