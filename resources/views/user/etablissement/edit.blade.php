@extends('layouts.app')

@section('page_title', "Edition de l'établissement")

@section('content')
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <form action="/user/etablissement/{{$etablissement->id}}/update" method="POST">
            @method('PATCH')
            @csrf
            {{-- Display errors if any --}}
            @if ($errors->any() && $etablissement->id == session('etablissement_id'))
                <div role="alert">
                    <div class="border border-red-400 rounded bg-red-100 mt-4 px-4 py-3 text-red-700">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-indigo-600">
                    {{ $etablissement->name }}
                </h3>
                <div class="mt-1 flex items-center text-sm leading-5 text-gray-500">
                  <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                    </svg>
                    {{ $etablissement->type }}
                </div>
            </div>
            <div class="px-4 pb-8">
                <div class="border-t border-gray-200">
                    <div class="mt-6 sm:mt-5">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start">
                            <label for="name" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Nom
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-xs rounded-md shadow-sm">
                                    <input name="name" id="name" value="{{ $etablissement->name }}" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="type" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Type
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-xs rounded-md shadow-sm">
                                    <select name="type" id="type" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />>
                                        <option value="public" {{ $etablissement->type == "public" ? "selected" : "" }}>Public</option>
                                        <option value="prive" {{ $etablissement->type == "prive" ? "selected" : "" }}>Privé</option>
                                        <option value="temporaire" {{ $etablissement->type == "temporaire" ? "selected" : "" }}>Temporaire</option>
                                    </select>
                                    
                                </div>
                            </div>
                        </div>

                      
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
                <div class="sm:col-span-2">
                    <span class="inline-flex rounded-md shadow-sm">
                        {{-- Valider --}}
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                            {{ __('Save') }}
                        </button>

                        {{-- Annuler --}}
                        <a href="{{ Request::url() }}" class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-50 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray active:bg-gray-200 transition ease-in-out duration-150">
                            {{ __('Annuler') }}
                        </a>

                    </span>
                </div>
            </div>
        </form>
    </div>
@endsection
