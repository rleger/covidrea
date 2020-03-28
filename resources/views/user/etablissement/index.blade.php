@extends('layouts.app')

@section('page_title', "Mise à jour de mes établissements")

@section('content')
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            Selectionnez l'établissement à modifier
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:p-6">
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul>
                    @foreach($etablissements as $key => $etablissement)
                        <li class="{{ $key ? 'border-t border-gray-200' : '' }}">
                            <a href="{{ route('user.etablissement.edit', ['etablissement' => $etablissement]) }}" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm leading-5 font-medium text-indigo-600 truncate">
                                            {{ $etablissement->name }}
                                        </div>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                services
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
