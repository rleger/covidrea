@extends('layouts.admin')

@section('admin_title')
    Gestion des établissements
@endsection

@section('admin_content')
    <div class="py-4">

        {{-- Top section --}}
<div class="mb-6 bg-white overflow-hidden shadow rounded-lg">
  <div class="px-4 py-5 sm:p-6">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <div>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <div class="relative flex-grow focus-within:z-10">
                            <input id="email" class="form-input block w-full rounded-none rounded-l-md pl-4 transition ease-in-out duration-150 sm:text-sm sm:leading-5" placeholder="Rechercher un établissement" />
                        </div>
                        <form action="{{ route('admin.etablissement.index') }}" method="get">
                            @csrf
                        <button type="submit" name="search" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-r-md text-gray-700 bg-gray-50 hover:text-gray-500 hover:bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">Rechercher</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <span class="ml-3 shadow-sm rounded-md">
                    <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-700 active:bg-indigo-700 transition duration-150 ease-in-out">
                        {{ __('Add') }}
                    </button>
                </span>
            </div>
        </div>


  </div>
</div>
        {{-- Liste des etablissements --}}
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul>
                @forelse($etablissements as $etablissement_key => $etablissement)
                    <li class="{{ $etablissement_key ? 'border-t border-gray-200' : '' }}">
                        {{-- <a href="{{ route('etablissement.show', $etablissement) }}" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out"> --}}
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm leading-5 font-medium text-indigo-600 truncate">
                                        {{ $etablissement->name }}
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
<span class="relative z-0 inline-flex shadow-sm">
    <a href="{{ route('admin.etablissement.invite', $etablissement) }}" class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
        Inviter des utilisateurs
    </a>
  <a href="{{ route('etablissement.show', $etablissement) }}" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
      Voir
  </a>
  <a href="{{ route('admin.etablissement.edit', $etablissement) }}" class="-ml-px relative inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
      Modifier
  </a>
</span>
                                    </div>
                                </div>
                            </div>
                        {{-- </a> --}}
                    </li>
                @empty
                    Aucun établissement
                @endforelse
            @endsection
            </ul>
        </div>
    </div>
