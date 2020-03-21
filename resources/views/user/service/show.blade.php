@extends('layouts.app')

@section('page_title', 'Mettre à jour mes lits')

@section('content')
    @foreach($services->all() as $etablissement_id => $grouped_service)
        <div class="mb-8 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{$grouped_service[0]->etablissement->name}}
                </h3>
                <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                    {{ $grouped_service[0]->etablissement->type }}
                </p>
            </div>
            <div>
                <dl>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                        @foreach($grouped_service as $service_key => $service)
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ $service->name }}
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            <ul class="border border-gray-200 rounded-md">
                                patients {{ $service->gravite }}
                                {{ $service->place_totales }} totales
                                {{ $service->place_disponible }} disponibles
                                {{ $service->place_bientot_disponible }} prochainement
                            </ul>
                            </dd>
                        @endforeach
                    </div>
                </dl>
            </div>
        </div>
    @endforeach
@endsection
