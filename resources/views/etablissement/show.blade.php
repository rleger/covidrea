@extends('layouts.app')

@section('page_title', 'Etablissements')

@section('content')
    <div class="bg-white shadow overflow-hidden  sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-indigo-600">
                {{ $etablissement->name }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                {{ $etablissement->type }}
            </p>
        </div>
        <div class="px-4 py-5 sm:p-0">
            <dl>

                @foreach($etablissement->service as $key => $service)
                    <div class="{{ $key ? 'border-t pt-2' : ''}} sm:border-t-0 mb-10 sm:mb-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        <span class="flex text-gray-900">
                            {{ $service->name }}
                        </span>
                        <span class="flex text-xs">
                            {{ $service->type }}
                        </span>
                        <span class="flex text-xs">
                            patients {{ $service->gravite }}
                        </span>
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <div class="flex-shrink-0">
                            <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-800">
                                {{ $service->place_disponible }} disponibles
                            </span>

                            <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-orange-100 text-orange-800">
                                {{ $service->place_bientot_disponible }} prochainement
                            </span>
                            <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-indigo-100 text-indigo-800">
                                {{ $service->place_totales }} totales
                            </span>
                        </div>
                        <div class="mt-2 flex items-center text-xs leading-5 text-gray-500 sm:mt-2">
                            <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            <span>
                                <span class="hidden sm:inline">mis à jour </span>{{ $service->updated_at->diffForHumans() }}
                            </span>
                        </div>
                        </dd>
                    </div>
                @endforeach
                <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                    <dt class="text-sm leading-5 font-medium text-indigo-500">
                    Contact
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $service->contact }}
                    </dd>
                </div>
                <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">

                    <dt class="text-sm leading-5 font-medium text-indigo-500">
                    Adresse
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $etablissement->adresse }}<br/>
                    {{ $etablissement->codepostal }}
                    {{ $etablissement->ville }}<br/>
                    {{ $etablissement->region }}
                    </dd>

                </div>
            </dl>
        </div>
    </div>

@endsection
