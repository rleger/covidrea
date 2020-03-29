@extends('layouts.app')

@section('page_title', "Edition de l'établissement")

@section('content')

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Etablissement</h3>
                    <p class="mt-1 text-sm leading-5 text-gray-500">
                        Cette section vous permet de mettre à jour les informations de l'établissement
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form id="form_etablissement" action="{{ route('user.etablissement.update', $etablissement) }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            {{-- Display errors if any --}}
                            @if ($errors->any() && $etablissement->id == session('etablissement_id'))
                                <div role="alert">
                                    <div class="border border-red-400 rounded bg-red-100 mt-4 px-4 py-3 text-red-700 pb-4">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            {{-- Success message --}}
                            @if (session('status_etablissement'))
                                <div class="border border-green-400 rounded bg-green-100 mt-4 px-4 py-3 text-green-700 mb-4">
                                    {{ session('status_etablissement') }}
                                </div>
                            @endif

                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Nom</label>
                                    <input id="name" name="name" value="{{ $etablissement->name }}" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="type" class="block text-sm font-medium leading-5 text-gray-700">Type / Region</label>
                                    <select id="type" name="type" class="mt-1 block form-select w-full py-2 px-3 py-0 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                        <option value="public" {{ $etablissement->type == "public" ? "selected" : "" }}>Public</option>
                                        <option value="prive" {{ $etablissement->type == "prive" ? "selected" : "" }}>Privé</option>
                                        <option value="temporaire" {{ $etablissement->type == "temporaire" ? "selected" : "" }}>Temporaire</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" form="form_etablissement" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="hidden sm:block">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Services</h3>
                    <p class="mt-1 text-sm leading-5 text-gray-500">
                        Cette section vous permet de mettre à jour les services de l'établissement
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form id="form_service" action="{{ route('user.services.store') }}" method="POST">
                    @csrf
                    <div class="bg-white shadow overflow-hidden sm:rounded-md">
                        <div class="bg-white">

                            {{-- Success message --}}
                            @if (session('status_service'))
                                <div class="border border-green-400 rounded bg-green-100 m-4 px-4 py-3 text-green-700">
                                    {{ session('status_service') }}
                                </div>
                            @endif
                            <ul>
                                @forelse($services as $service_key => $service)

                                    <li class="{{ $service_key ? 'border-t border-gray-200' : '' }}">
                                        <a href="{{ route('service.edit', $service) }}" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                            <div class="px-4 py-3 sm:px-6">
                                                <div class="flex items-center justify-between">
                                                    <div class="text-sm leading-5 font-medium ">
                                                        <span class="text-indigo-600 truncate">{{ $service->name }}</span>

                                                        <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium leading-4 bg-indigo-100 text-indigo-800">
                                                            {{ $service->place_totales }} totales
                                                        </span>
                                                    </div>
                                                    @if($service->count() > 1)
                                                        <div class="ml-2 flex-shrink-0 flex">
                                                            <span class="inline-flex rounded-md shadow-sm">
                                                                <form method="POST" id="delete_service_{{$service->id}}" action="{{ route('service.delete', $service) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" form="delete_service_{{$service->id}}" class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 text-xs leading-4 font-medium rounded text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">

                                                                        {{ __('Delete') }}
                                                                </form>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li>
                                        L'établissement n'a encore aucun service
                                    </li>
                                @endforelse

                            </ul>
                        </div>
                        <div class="px-4 py-4 bg-gray-50 text-right sm:px-4">
                            <form id="form_services" action="{{ route('user.services.store') }}" method="POST">
                                @csrf

                                <div class="text-left">
                                    {{-- Display errors if any --}}
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
                                </div>

                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="hidden" name="etablissement_id" value="{{ $etablissement->id }}">


                                    <div class="relative flex-grow focus-within:z-10">
                                        <input id="name" name="name" class="form-input block w-full rounded-none rounded-l-md border-r-none transition ease-in-out duration-150 sm:text-sm sm:leading-5" placeholder="Nom du service" />
                                    </div>
                                    <div class="relative flex-grow focus-within:z-10">
                                        <input id="place_totales" name="place_totales" type="number" min=0 max=100 class="form-input block w-full rounded-none transition ease-in-out duration-150 sm:text-sm sm:leading-5" placeholder="Places totales" />
                                    </div>

                                    <button type="submit" form="form_services" class="rounded-l-none inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                        {{ __('Ajouter') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
