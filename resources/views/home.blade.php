@extends('layouts.app')

@section('page_title', 'Tableau de bord')

@section('content')
    @if ($etablissement === null)
        <div class="relative">
            Vous n’avez pas d’établissement de référence.
        </div>
    @else
        <div class="bg-gray-50 pt-12 sm:pt-16">
            <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl leading-9 font-extrabold text-gray-900 sm:text-4xl sm:leading-10">
                       Lits de réanimation COVID
                    </h2>
                    <p class="mt-3 text-xl leading-7 text-gray-500 sm:mt-4">
                        Disponibilités des lits
                    </p>
                    <div class="max-w-screen-xl mx-auto px-4 pt-4 sm:px-6 lg:px-8">
                        <div class="max-w-4xl mx-auto text-center">
                            {{-- <div class="sm:hidden"> --}}
                                {{-- <select class="form-select block w-full"> --}}
                                    {{-- <option>My Account</option> --}}
                                    {{-- <option>Company</option> --}}
                                    {{-- <option selected>Team Members</option> --}}
                                    {{-- <option>Billing</option> --}}
                                {{-- </select> --}}
                            {{-- </div> --}}
                            <div class="hidden sm:block">
                                <nav class="flex items-center justify-center text-center bg-white rounded-full border border-indigo-200 px-4 py-2 mt-2 text-gray-500">
                                    <span>
                                        Dans un rayon de
                                    </span>
                                    <a href="{{ route('home', ['radius' => 20]) }}" class="ml-4 px-3 py-2 font-bold text-sm leading-5 rounded-md {{ Request::input('radius', 20) == 20 ? 'text-indigo-700 bg-indigo-100 focus:outline-none focus:text-indigo-800 focus:bg-indigo-200' : 'text-gray-500 hover:text-gray-700 focus:outline-none focus:text-indigo-600 focus:bg-indigo-50' }}">
                                        20 km
                                    </a>
                                    <a href="{{ route('home', ['radius' => 80]) }}" class="ml-4 px-3 py-2 font-bold text-sm leading-5 rounded-md {{ Request::input('radius', 20) == 80 ? 'text-indigo-700 bg-indigo-100 focus:outline-none focus:text-indigo-800 focus:bg-indigo-200' : 'text-gray-500 hover:text-gray-700 focus:outline-none focus:text-indigo-600 focus:bg-indigo-50' }}">
                                        80 km
                                    </a>
                                    <a href="{{ route('home', ['radius' => 150]) }}" class="ml-4 px-3 py-2 font-bold text-sm leading-5 rounded-md {{ Request::input('radius', 20) == 150 ? 'text-indigo-700 bg-indigo-100 focus:outline-none focus:text-indigo-800 focus:bg-indigo-200' : 'text-gray-500 hover:text-gray-700 focus:outline-none focus:text-indigo-600 focus:bg-indigo-50' }}">
                                        150 km
                                    </a>
                                    <a href="{{ route('home', ['radius' => 999999]) }}" class="ml-4 px-3 py-2 font-bold text-sm leading-5 rounded-md {{ Request::input('radius', 20) == 999999 ? 'text-indigo-700 bg-indigo-100 focus:outline-none focus:text-indigo-800 focus:bg-indigo-200' : 'text-gray-500 hover:text-gray-700 focus:outline-none focus:text-indigo-600 focus:bg-indigo-50' }}">
                                        99999+ km
                                    </a>
                                    <span>
                                        &nbsp;autour de {{ $etablissement->ville }}
                                    </span>
                                </nav>
                            </div>
                        </div>
                    </div>


                    {{-- <form action="{{ route('home', ['radius' => '']) }}" method="GET"> --}}
                        {{-- <p class="flex flex-wrap mt-3 text-xl leading-7 text-gray-500 sm:mt-4"> --}}
                            {{-- <div> --}}
                                {{-- Dans un rayon de --}}
                                {{-- </div> --}}
                            {{-- <div class="flex-1"> --}}
                                {{-- <div class="mt-1 sm:mt-0 sm:col-span-2"> --}}
                                    {{-- <div class="max-w-xs rounded-md shadow-sm"> --}}
                                        {{-- <select id="distance" value="distance" class="form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"> --}}
                                            {{-- <option value=5>5 km</option> --}}
                                            {{-- <option value=10>10 km</option> --}}
                                            {{-- <option value=20>20 km</option> --}}
                                            {{-- <option value=50>50 km</option> --}}
                                            {{-- <option value=150>150 km</option> --}}
                                            {{-- <option value=300>300 km</option> --}}
                                            {{-- <option value=100000>Pays</option> --}}
                                            {{-- </select> --}}
                                        {{-- </div> --}}
                                    {{-- </div> --}}
                                {{-- </div> --}}
                            {{-- <div> --}}
                                {{-- km autour de {{ $etablissement->name }} --}}
                                {{-- </div> --}}
                            {{-- </p> --}}
                        {{-- <button type="submit">go</button> --}}
                        {{-- </form> --}}
                </div>
            </div>
            <div class="mt-10 pb-12 bg-white sm:pb-16">
                <div class="relative">
                    <div class="absolute inset-0 h-1/2 bg-gray-50"></div>
                    <div class="relative max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="max-w-4xl mx-auto">
                            <div class="rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-3">
                                <div class="border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                                    <a href="{{ route('etablissements.index') }}">
                                        <p class="text-5xl leading-none font-extrabold text-green-400">
                                            {{ $places['place_disponible'] }}
                                        </p>
                                        <p class="mt-2 text-lg leading-6 font-medium text-gray-500">
                                            Lits disponibles
                                        </p>
                                    </a>
                                </div>
                                <div class="border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r">
                                    <a href="{{ route('etablissements.index') }}">
                                        <p class="text-5xl leading-none font-extrabold text-orange-400">
                                            {{ $places['place_bientot_disponible'] }}
                                        </p>
                                        <p class="mt-2 text-lg leading-6 font-medium text-gray-500">
                                            Lits bientôt disponibles
                                        </p>
                                    </a>
                                </div>
                                <div class="border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l">
                                    <a href="{{ route('etablissements.index') }}">
                                        <p class="text-5xl leading-none font-extrabold text-indigo-400">
                                            {{ $places['places_totales'] }}
                                        </p>
                                        <p class="mt-2 text-lg leading-6 font-medium text-gray-500">
                                            Lits affectés
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
