@extends('layouts.admin')
@section('admin_title')
    Gestion des établissements
@endsection

@section('admin_content')
        <div class="px-4 md:px-0">
            <h2>
                {{$etablissement->name}}
            </h2>
        </div>
        <div class="hidden sm:block">
            <div class="py-5">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>

        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Ajouter des services</h3>
                        <p class="mt-1 text-sm leading-5 text-gray-500">Ajouter des services
                            Cette section vous permet d'ajouter des services à l'établissement. Les utilisateurs pourront <span class="font-medium">choisir un ou plusieurs</span> de ces services lors de leur inscription.
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form id="form_service_{{$etablissement->id}}" action="{{ route('etablissement.services.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="etablissement" value="{{ $etablissement->id}}"></input>
                        <div class="bg-white shadow overflow-hidden sm:rounded-md">
                            <div class="bg-white">

                                {{-- Success message --}}
                                @if (session('status_service') && session('etablissement_id') === $etablissement->id)
                                    <div class="border border-green-400 rounded bg-green-100 m-4 px-4 py-3 text-green-700">
                                        {{ session('status_service') }}
                                    </div>
                                @endif
                                <ul>
                                    @forelse($etablissement->service as $service_key => $service)

                                        <li class="{{ $service_key ? 'border-t border-gray-200' : '' }}">
                                            <a href="{{ route('service.edit', $service) }}" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                                <div class="px-4 py-3 sm:px-6">
                                                    <div class="flex items-center justify-between">
                                                        <div class="text-sm leading-5 font-medium ">
                                                            <span class="text-indigo-600 truncate">{{ $service->name }}</span>

                                                            <span class="mt-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium leading-4 bg-indigo-100 text-indigo-800">
                                                                {{ $service->place_totales }} totales
                                                            </span>
                                                        </div>
                                                        @if($etablissement->service->count() > 1)
                                                            <div class="ml-2 flex-shrink-0 flex">
                                                                <span class="inline-flex rounded-md shadow-sm">
                                                                    <form method="POST" id="delete_service_{{$service->id}}" action="{{ route('service.delete', $service) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" form="delete_service_{{$service->id}}" class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 text-xs leading-4 font-medium rounded text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">

                                                                            {{ __('Delete') }}
                                                                        </button>
                                                                    </form>
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @empty
                                        <li>
                                            <div class="px-4 py-3 sm:px-6">
                                                <div class="text-sm leading-5 font-medium ">
                                                    <span class="text-gray-600 truncate">
                                                        L'établissement n'a encore aucun service
                                                    </span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="px-4 py-4 bg-gray-50 border-t border-gray-200 text-right sm:px-4">
                                <form id="form_service_{{$etablissement->id}}" action="{{ route('etablissement.services.store') }}" method="POST">
                                    @csrf

                                    <div class="text-left">
                                        {{-- Display errors if any --}}
                                        @if ($errors->any() && $etablissement->id == session('etablissement_id') && session('form') != 'invite')
                                            <div role="alert">
                                                <div class="border border-red-400 rounded bg-red-100 my-4 px-4 py-3 text-red-700">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mt-1 flex flex-wrap rounded-md shadow-sm">
                                        <input type="hidden" name="etablissement_id" value="{{ $etablissement->id }}">
                                        <div class="relative flex-grow w-full md:w-3/6 focus-within:z-10">
                                            <input id="name" name="name" class="form-input block w-full rounded-md md:rounded-none md:rounded-l-md border-r-none transition ease-in-out duration-150 sm:text-sm sm:leading-5" placeholder="Nom du service" />
                                        </div>
                                        <div class="relative flex-grow w-4/6 md:w-2/6 focus-within:z-10">
                                            <input id="place_totales" name="place_totales" type="number" min=0 max=100 class="form-input block w-full rounded-none rounded-l-md md:rounded-none transition ease-in-out duration-150 sm:text-sm sm:leading-5" placeholder="Places totales" />
                                        </div>

                                        <button type="submit" form="form_service_{{$etablissement->id}}" class="w-2/6 md:w-1/6 rounded-l-none inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150 justify-center">
                                            {{ __('Add') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if($etablissement->service->count())

        <div class="hidden sm:block">
            <div class="py-5">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>

        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Invitez des praticiens</h3>
                        <p class="mt-1 text-sm leading-5 text-gray-500">
                            Saisissez les email des praticiens qui seront invités à utiliser covid un moi un lit.
                        </p>

                        <p class="mt-1 text-sm leading-5 text-blue-500 mb-8">
                            par exemple : medecin@gmail.com, doctor@hopital.com;personne@example.com
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form id="form_invite_{{$etablissement->id}}" action="{{ route('invite.process') }}" method="POST">
                        @csrf

                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                {{-- Display errors if any --}}
                                @if ($errors->any() && $etablissement->id == session('etablissement_id') && session('form') == "invite")
                                    <div role="alert">
                                        <div class="mb-4 border border-red-400 rounded bg-red-100 mt-4 px-4 py-3 text-red-700 pb-4">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                {{-- Success message --}}
                                @if (session('status_invitation') && session('etablissement_id') == $etablissement->id)
                                    <div class="border border-green-400 rounded bg-green-100 mt-4 px-4 py-3 text-green-700 mb-4">
                                        {{ session('status_invitation') }}
                                    </div>
                                @endif

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">

                                        <input type="hidden" name="etablissement" value="{{ $etablissement->id}}"></input>

                                        <label for="emails" class="block text-sm font-medium leading-5 text-gray-700">Liste d'adresses mails</label>

                                        <textarea rows="6" id="emails" name="emails" class="paste-enabled mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" placeholder="you@example.com,unautre@hopital.com">{{ session('unprocessed_emails') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200  text-right sm:px-6">
                                <button type="submit" form="form_invite_{{$etablissement->id}}" class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                                    {{ __('Send invitation') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
