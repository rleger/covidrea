@extends('layouts.app')

@section('page_title', "Lits disponibles")
@section('page_subtitle', "Retrouvez sur cette page l'ensemble des lits disponibles pour les patients covid, cliquez sur l'établissement pour obtenir des précisions")

@section('content')


<style>
.custom-map-controls {
    margin: 1rem;
    font-family: Inter var, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    background-color: #5850EC;
}

.custom-map-controls label {
    margin-right: 2rem;
}

.custom-map-controls input {
    vertical-align: top;
    margin-right: 0.25rem;
}



</style>


<div id="map" class="google-map" style="width: 100%; height: 500px;"></div>
<div id="map-filters-template"  style="display: none;">
    <div class="p-2 bg-gray-100 text-sm custom-map-controls">
        <input type="checkbox" name="map-filters-all" class="map-filters-all" onclick="filterMarkers('all')" checked>
        <label for="map-filters-all">Tous</label>
        
        <input type="checkbox" name="map-filters-available" class="map-filters-available" onclick="filterMarkers('available')">
        <label for="map-filters-available">Lits disponibles</label>
        

        <input type="checkbox" name="map-filters-soon" class="map-filters-soon" onclick="filterMarkers('soon')">
        <label for="map-filters-soon">Lits bientôt disponibles</label>
    </div>
</div>


<script>
    var map;
    
    map = new google.maps.Map(document.getElementById('map'), {
        // france center: { lat: 46.227638, lng: 2.213749 },
        center: { lat: 9.8303450, lng: 49.6575990 },
        zoom: 6,
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: false
    });

    let filterMarkers = (type) => {
        
        if(type === "all") {
            let checkbox = document.querySelector("#map-filters .map-filters-all");
            markers.forEach(marker => marker.setVisible(checkbox.checked));
            // uncheck others
            document.querySelector("#map-filters .map-filters-available").checked = false;
            document.querySelector("#map-filters .map-filters-soon").checked = false;

        } else if (type === "available") {
            let checkbox = document.querySelector("#map-filters .map-filters-available");
            document.querySelector("#map-filters .map-filters-all").checked = false;

            let soonStatus = document.querySelector("#map-filters .map-filters-soon").checked;
            let availableStatus = document.querySelector("#map-filters .map-filters-available").checked;
            markers.forEach(marker => {
                marker.setVisible((soonStatus && marker._underlying.soon_available > 0) || (availableStatus && marker._underlying.available > 0));
            });


        } else {
            let checkbox = document.querySelector("#map-filters .map-filters-soon");
            document.querySelector("#map-filters .map-filters-all").checked = false;

            let soonStatus = document.querySelector("#map-filters .map-filters-soon").checked;
            let availableStatus = document.querySelector("#map-filters .map-filters-available").checked;
            markers.forEach(marker => {
                marker.setVisible((soonStatus && marker._underlying.soon_available > 0) || (availableStatus && marker._underlying.available > 0));
            });

        }
    };


    let etablissements = [];
    let markers = [];
    @foreach($etablissements as $key => $etablissement)
    markers.push(
        new google.maps.Marker({
            position: { lat: {{ $etablissement->lat }}, lng: {{ $etablissement->long }} },
            map: map,
            icon: ["/images/map/logo-available.svg", "/images/map/logo-soon-available.svg", "/images/map/logo-unavailable.svg"][Math.floor(Math.random() * 3)],
            _underlying: {
                id: "{{ $etablissement->id }}",
                soon_available: {{ $etablissement->service()->sum('place_bientot_disponible') }},
                available: {{ $etablissement->service()->sum('place_disponible') }},
                lat: "{{ $etablissement->lat }}",
                lon: "{{ $etablissement->long }}"
            }
        })
    );
    @endforeach



  
    var div = document.createElement('div');
    div.id = "map-filters";
    div.innerHTML = document.getElementById("map-filters-template").innerHTML;
    map.controls[google.maps.ControlPosition.LEFT_TOP].push(div);

    // events
    

</script>


  


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

            </div>
            {{-- End of list --}}

            
   

        </div>

        
    </div>
@endsection
