@extends('layouts.app')

@section('page_title', "Edition de l'établissement")

@section('content')
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <form id="etablissement" action="/user/etablissement/{{$etablissement->id}}/update" method="POST">
            @method('PATCH')
            @csrf
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-indigo-600">
                    {{ $etablissement->name }}
                </h3>
                <div class="mt-1 flex items-center text-sm leading-5 text-gray-500">
                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                    </svg>
                    {{ $etablissement->type }}
                </div>
            </div>
            <div class="px-4 pb-8">
                {{-- Display errors if any --}}
                @if ($errors->any() && $etablissement->id == session('etablissement_id'))
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

                {{-- Success message --}}
                @if (session('status'))
                    <div class="border border-green-400 rounded bg-green-100 mt-4 px-4 py-3 text-green-700">
                        {{ session('status') }}
                    </div>
                @endif



                <div class="">
                    <div class="mt-6 sm:mt-5">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                            {{-- <label for="name" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2"> --}}
                                {{-- Nom --}}
                            {{-- </label> --}}
                            {{-- <div class="mt-1 sm:mt-0 sm:col-span-2"> --}}
                                {{-- <div class="max-w-xs rounded-md shadow-sm"> --}}
                                    {{-- <input name="name" id="name" value="{{ $etablissement->name }}" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" /> --}}
                                {{-- </div> --}}
                            {{-- </div> --}}
                        {{-- </div> --}}
                        <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="type" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Type
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-xs rounded-md shadow-sm">
                                    <select name="type" id="type" class="mt-1 block form-select w-full py-2 px-3 pr-8 py-0 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />>
                                        <option value="public" {{ $etablissement->type == "public" ? "selected" : "" }}>Public</option>
                                        <option value="prive" {{ $etablissement->type == "prive" ? "selected" : "" }}>Privé</option>
                                        <option value="temporaire" {{ $etablissement->type == "temporaire" ? "selected" : "" }}>Temporaire</option>
                                    </select>
                                </div>
                            </div>
                        </div>


            <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
                <div class="sm:col-span-2">
                    <span class="inline-flex rounded-md shadow-sm">
                        {{-- Valider --}}
                        <button type="submit" form="etablissement" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                            {{ __('Save') }}
                        </button>

                        {{-- Annuler --}}
                        <a href="{{ URL::previous() }}" class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-50 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray active:bg-gray-200 transition ease-in-out duration-150">
                            {{ __('Cancel') }}
                        </a>
                    </span>
                </div>
            </div>
        </form>




                        <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="type" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Services
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">

                                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                                    <ul>
                                        @forelse($services as $service_key => $service)

                                            <li class="{{ $service_key ? 'border-t border-gray-200' : '' }}">
                                                <a href="#" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
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
                                                                        <button type="button" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs leading-4 font-medium rounded text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150">
                                                                            {{ __('Delete') }}
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

                                        <div class="border-t border-gray-200 bg-gray-100 px-4 py-3 sm:px-6">
                                            <div class="mt-1 flex rounded-md shadow-sm">

                                                <form id="service" name="service" action="{{ route('user.services.store') }}" method="POST">
                                                    @csrf
                                                <div class="relative flex-grow focus-within:z-10">
                                                    <input id="name" name="name" class="form-input block w-full rounded-none rounded-l-md border-r-none transition ease-in-out duration-150 sm:text-sm sm:leading-5" placeholder="Nom du service" />
                                                </div>
                                                <div class="relative flex-grow focus-within:z-10">
                                                    <input id="place_totales" name="place_totales" type="number" min=0 max=100 class="form-input block w-full rounded-none transition ease-in-out duration-150 sm:text-sm sm:leading-5" placeholder="Places totales" />
                                                </div>
                                                {{-- Display errors if any --}}
                                                @if ($errors->any())
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
                                                </form>

                                                <button type="submit" form="service" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-r-md text-gray-700 bg-gray-50 hover:text-gray-500 hover:bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                                    <span class="ml-2">{{ __('Ajouter') }}</span>
                                                </button>
                                            </div>
                                        </div>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
