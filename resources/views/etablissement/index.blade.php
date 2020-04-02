@extends('layouts.app')

@section('page_title', "Lits disponibles")
@section('page_subtitle', "Retrouvez sur cette page l'ensemble des lits disponibles pour les patients covid, cliquez sur l'établissement pour obtenir des précisions")

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Begining of list --}}
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul>
                    @foreach($etablissements as $key => $etablissement)
                    <li class="{{ $key ? 'border-t border-gray-200' : ''}}">
                            <a href="{{ $etablissement->numberOfServices() > 0 ? route('etablissement.show', $etablissement) : '#' }}" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex flex-wrap items-center justify-between">
                                        <div class="pb-2 sm:pb-0 text-md sm:text-lg leading-6 font-medium text-indigo-600">
                                            {{ $etablissement->name }}
                                            <span class="text-sm sm:text-md text-gray-400">
                                            ({{ $etablissement->numberOfServices() }} {{Str::plural('service', $etablissement->numberOfServices())}})
                                            </span>
                                        </div>
                                        <div class="sm:ml-2 flex-shrink-0 flex">
                                            <span class="mr-2 px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $etablissement->numberOfAvailableBeds() }} disponibles
                                            </span>

                                            <span class="mr-2 px-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                                {{ $etablissement->numberOfSoonAvailableBeds() }} prochainement
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
                                        <h1>{{ $etablissement->numberOfServices() }}</h1>
                                            @if($etablissement->numberOfServices() > 0)
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="hidden sm:inline">
                                                    &nbsp;Mis à jour&nbsp;
                                                </span>
                                                <span>
                                                    {{-- <time datetime="2020-01-07">January 7, 2020</time> --}}
                                                    {{ \Carbon\Carbon::parse($etablissement->last_service_update)->diffForHumans() }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
            {{-- End of list --}}

            
   

        </div>

        
    </div>
@endsection
