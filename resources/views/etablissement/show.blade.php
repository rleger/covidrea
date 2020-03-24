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
                            <span class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-red-100 text-red-800">
                                {{ $service->place_totales }} totales
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
