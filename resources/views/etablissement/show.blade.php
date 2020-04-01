@extends('layouts.app')

@section('page_title', 'Disponibilité des lits de réanimation')

@section('content')
    <div class="bg-white shadow overflow-hidden  sm:rounded-lg">
        <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
            <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-no-wrap">
                <div class="ml-4 mt-2">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ $etablissement->name }}
                    </h3>
                    <div class="mt-2 sm:flex">
                        <div class="mt-2 mr-2 flex items-center text-sm leading-5 text-gray-500 sm:mt-0">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            {{ $etablissement->ville }}
                        </div>
                        <div class="flex items-center text-sm leading-5 text-gray-500">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                            </svg>
                            {{ $etablissement->type }}
                        </div>
                    </div>
                </div>
                <div class="ml-4 mt-2 flex-shrink-0">
                    @can('update', $etablissement)
                    <span class="inline-flex rounded-md shadow-sm">
                        <a href="{{ route('user.etablissement.edit', $etablissement) }}" class="relative inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-700 active:bg-indigo-700">
                            {{ __('Update') }}
                        </a>
                    @endcan

                    </span>
                </div>
            </div>
        </div>

        <div class="px-4 py-5 sm:p-0">
            <dl>
                @foreach($etablissement->service as $key => $service)
                    <div class="{{ $key ? 'border-t pt-2' : ''}} mb-5 sm:border-t-0 sm:mb-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5 border-b border-gray-200">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        <span class="flex text-gray-900">
                            {{ $service->name }}
                        </span>
                        <span class="flex text-xs">
                            {{ $service->contact }}
                            </span>
                        {{-- <span class="flex text-xs"> --}}
                            {{-- patients {{ $service->gravite }} --}}
                            {{-- </span> --}}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <div class="flex-shrink-0">
                            <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-800">
                                {{ $service->place_disponible }} disponibles
                            </span>

                            <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium leading-4 bg-orange-100 text-orange-800">
                                {{ $service->place_bientot_disponible }} prochainement
                            </span>
                            <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium leading-4 bg-indigo-100 text-indigo-800">
                                {{ $service->place_totales }} totales
                            </span>
                        </div>
                        <div class="mt-2 flex items-center text-xs leading-5 text-gray-500 sm:mt-2">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm hidden sm:inline">&nbsp;Mis à jour {{ $service->updated_at->diffForHumans() }}</span>
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
