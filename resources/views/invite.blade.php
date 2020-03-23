@extends('layouts.app')

@section('page_title', 'Inviter des utilisateurs')

@section('content')
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <form action="{{ route('invite.process') }}" method="post">
            <div class="border-b border-gray-200 text-indigo-600 px-4 py-5 sm:px-6">
                Saisissez les email des utilisateurs à inviter de la part de <strong>{{ $user->name }}</strong>
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

                    <label for="email" class="hidden block text-sm font-medium leading-5 text-gray-700">Liste d'adresses mails</label>
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
