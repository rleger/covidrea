@extends('layouts.admin')
@section('admin_title')
    Créer un établissement
@endsection

@section('admin_content')

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Etablissement</h3>
                    <p class="mt-1 text-sm leading-5 text-gray-500">
                        Cette section vous permet de mettre à jour les informations de l'établissement
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form id="form_etablissement" action="{{ route('admin.etablissement.store') }}" method="POST">
                    @csrf

                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            {{-- Display errors if any --}}
                            @if ($errors->any())
                                <div role="alert">
                                    <div class="border border-red-400 rounded bg-red-100 mt-4 px-4 py-3 text-red-700 pb-4">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            {{-- Success message --}}
                            @if (session('status'))
                                <div class="border border-green-400 rounded bg-green-100 mt-4 px-4 py-3 text-green-700 mb-4">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6">
                                    <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Nom</label>
                                    <input id="name" name="name" value="{{ old('name') }}" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="type" class="block text-sm font-medium leading-5 text-gray-700">Type / Region</label>
                                    <select id="type" name="type" class="mt-1 block form-select w-full py-2 px-3 py-0 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                        <option value="public">Public</option>
                                        <option value="prive" >Privé</option>
                                        <option value="temporaire">Temporaire</option>
                                    </select>
                                </div>


                                <div class="col-span-6">
                                    <label for="adresse" class="block text-sm font-medium leading-5 text-gray-700">Adresse</label>
                                    <input id="adresse" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                    <label for="codepostal" class="block text-sm font-medium leading-5 text-gray-700">Code postal</label>
                                    <input id="codepostal" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                    <label for="city" class="block text-sm font-medium leading-5 text-gray-700">Ville</label>
                                    <input id="city" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>



                                <div class="col-span-6 sm:col-span-3">
                                    <label for="pays" class="block text-sm font-medium leading-5 text-gray-700">Region</label>
                                    <select id="pays" class="mt-1 block form-select w-full py-2 px-3 py-0 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                        <option value="france">France</option>
                                        <option value="suisse">Suisse</option>
                                        <option value="allemagne">Allemagne</option>
                                        <option value="italie">Italie</option>
                                        <option value="Espagne">Italie</option>
                                        <option value="angleterre">Angleterre</option>
                                    </select>
                                </div>


                                <div class="col-span-6 sm:col-span-3">
                                    <label for="pays" class="block text-sm font-medium leading-5 text-gray-700">Pays</label>
                                    <select id="pays" class="mt-1 block form-select w-full py-2 px-3 py-0 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                        <option value="france">France</option>
                                    </select>
                                </div>





                            </div>


                        </div>
                        <div class="px-4 py-3 b border-t border-gray-200 g-gray-50 text-right sm:px-6">
                            <button type="submit" form="form_etablissement" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                {{ __('Save') }}
                            </button>
                        </div>





                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
