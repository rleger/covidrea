@extends('layouts.app')

@section('page_title', 'Mettre à jour mes lits')

@section('content')

    @foreach($services->all() as $etablissement_key => $etablissement)
        <div class="{{ $etablissement_key ? 'mt-8' : '' }} bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{$etablissement[0]->name}}
                </h3>
                <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                    {{ $etablissement[0]->type }}
                </p>
            </div>
            <div>
                <dl>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        Services
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul class="border border-gray-200 rounded-md">
                            @foreach($etablissement as $service_key => $service)
                                <li class="{{ $service_key ? 'border-t border-gray-200 ' : '' }} pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5">
                                    <div class="w-0 flex-1 flex items-center">
                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="ml-2 flex-1 w-0 truncate">
                                            {{ $service->name }}
                                        </span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-gray-100 text-gray-800">
                                            patients {{ $service->gravite }}
                                        </span>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-red-100 text-red-800">
                                                {{ $service->place_totales }} totales
                                            </span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-800">
                                                {{ $service->place_disponible }} disponibles
                                            </span>

                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-orange-100 text-orange-800">
                                                {{ $service->place_bientot_disponible }} prochainement
                                            </span>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    @endforeach
@endsection
