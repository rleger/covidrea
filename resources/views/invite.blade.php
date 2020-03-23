@extends('layouts.app')

@section('page_title', 'Inviter des utilisateurs')

@section('content')
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <form action="{{ route('invite.process') }}" method="post">
            <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-no-wrap">
                    <div class="ml-4 mt-2">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Saisissez les email des utilisateurs à inviter de la part de {{ $user->name }} pour
                        </h3>
                    </div>
                    <div class="ml-4 mt-2 flex-shrink-0">
                        <span class="inline-flex rounded-md shadow-sm">
                            @if($user->etablissement->count() > 1)
                                <select class="mt-1 block form-select w-full py-2 px-3 pr-8 py-0 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" name="etablissement" id="etablissement">
                                    @foreach($user->etablissement as $etablissement)
                                        <option value="{{$etablissement->id}}">
                                        {{$etablissement->name}}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                {{ $user->etablissement->first()->name }}
                                <input type="hidden" name="etablissement" value="{{ $user->etablissement->first()->id}}"></input>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6">
                @csrf
                <div>

                    {{-- Success message --}}
                    @if (session('status'))
                        <div class="border border-green-400 rounded bg-green-100 mb-4 px-4 py-3 text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Display errors if any --}}
                    @if ($errors->any())
                        <div role="alert">
                            <div class="border border-red-400 rounded bg-red-100 mb-4 px-4 py-3 text-red-700">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <h3 class="text-lg font-small leading-6 text-gray-900">
                        Saisissez une liste d'emails séparés par une virgule ou un point virgule.
                    </h3>
                    <p class="mt-1 text-sm leading-5 text-gray-500 mb-8">
                        par exemple : medecin@gmail.com, doctor@hopital.com;personne@example.com
                    </p>

                    {{-- Liste d'adresses mail --}}
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">Liste d'adresses mails</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <textarea rows="6" id="emails" name="emails" class="form-input block w-full sm:text-sm sm:leading-5" placeholder="you@example.com,unautre@hopital.com" /></textarea>
                    </div>
                    {{-- <p class="mt-2 text-sm text-gray-500">Make your password short and easy to guess.</p> --}}
                </div>

            </div>
            <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
                <span class="inline-flex rounded-md shadow-sm">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                        Envoyer l'invitation
                    </button>
                </span>
            </div>
        </form>
    </div>

@endsection
