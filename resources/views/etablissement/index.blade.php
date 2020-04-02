@extends('layouts.app')

@section('page_title', "Lits disponibles")
@section('page_subtitle', "Retrouvez sur cette page l'ensemble des lits disponibles pour les patients covid, cliquez sur l'établissement pour obtenir des précisions")

@section('content')
    @if (count($etablissements) === 0)
        <div class="row justify-content-center">
            Vous n’avez pas d'établissement ni de services de référence.
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- Begining of list --}}
                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    <ul>
                        @foreach($etablissements as $key => $etablissement)
                            <li class="{{ $key ? 'border-t border-gray-200' : ''}}">
                                <a href="{{ $etablissement->service_count ? route('etablissement.show', $etablissement) : '#' }}" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                    <div class="px-4 py-4 sm:px-6">
                                        <div class="flex flex-wrap items-center justify-between">
                                            <div class="pb-2 sm:pb-0 text-md sm:text-lg leading-6 font-medium text-indigo-600">
                                                {{ $etablissement->name }}
                                                <span class="text-sm sm:text-md text-gray-400">
                                                ({{ $etablissement->service_count }} {{Str::plural('service', $etablissement->service_count)}})
                                                </span>
                                            </div>
                                            <div class="sm:ml-2 flex-shrink-0 flex">
                                                <span class="mr-2 px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $etablissement->service()->sum('place_disponible') }} disponibles
                                                </span>

                                                <span class="mr-2 px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                                    {{ $etablissement->service()->sum('place_bientot_disponible') }} prochainement
                                                </span>

                                            </div>
                                        </div>
                                        <div class="mt-2 sm:flex sm:justify-between">
                                            <div class="sm:flex">
                                                <div class="mt-2 mr-2 flex items-center text-sm leading-5 text-gray-500 sm:mt-0">
                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $etablissement->ville }} ({{ number_format($etablissement->distance, 1, '.', '')}} km)
                                                </div>
                                                <div class="flex items-center text-sm leading-5 text-gray-500">
                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $etablissement->type }}
                                                </div>
                                            </div>
                                            <div class="mt-2 flex items-center text-sm leading-5 text-gray-500 sm:mt-0">
                                                @if($etablissement->service_count)
                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span class="hidden sm:inline">
                                                        &nbsp;Mis à jour&nbsp;
                                                    </span>
                                                    <span>
                                                        {{-- <time datetime="2020-01-07">January 7, 2020</time> --}}
                                                        {{ $etablissement->service()->orderBy('updated_at', 'DESC')->first()->updated_at->diffForHumans() }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                {{ __('Previous') }}
                            </a>
                            <a href="{{ $paginator->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                {{ __('Next') }}
                            </a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm leading-5 text-gray-700">
                                    <span class="font-medium">{{ $paginator->total() }}</span> résultats
                                </p>
                            </div>
                            <div>
                                <span class="relative z-0 inline-flex shadow-sm">
                                    {{ $paginator->links() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End of list --}}
            </div>
        </div>
    @endif
@endsection
