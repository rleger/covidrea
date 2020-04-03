@extends('layouts.admin')

@section('admin_title')
    Statut des notification email
@endsection

@section('admin_content')
    <div class="py-4">
        {{-- Top section --}}
        <div class="mb-6 bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <div class="flex rounded-md shadow-sm">
                            <form action="{{ route('admin.notifications.index', $type) }}" method="get" class="m-0 p-0 w-full">
                                <div class="relative flex-grow focus-within:z-10">
                                    <input id="email" name="email" value="{{ $searchEmail ? $searchEmail : ''}}" class="form-input block inline-flex w-64 rounded-none rounded-l-md pl-4 transition ease-in-out duration-150 sm:text-sm sm:leading-5" placeholder="Rechercher un destinataire" />
                                    @csrf
                                    <button type="submit" name="search" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-r-md text-gray-700 bg-gray-50 hover:text-gray-500 hover:bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">Rechercher</button>
                                </div>                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Liste des notifications en echec --}}
        <ul class="flex">
            <li class="flex-1 mr-2">
                <a class="text-center block border {{ $type == 'prospect' ? 'border-indigo-800 bg-indigo-800 hover:bg-indigo-700 text-white' : 'border-white hover:border-gray-200 text-indigo-800 hover:bg-gray-200' }} rounded py-2 px-4 " href="{{ route('admin.notifications.index', 'prospect') }}">Prospect</a>
            </li>
            <li class="flex-1 mr-2">
                <a class="text-center block border {{ $type == 'invite' ? 'border-indigo-800 bg-indigo-800 hover:bg-indigo-700 text-white' : 'border-white hover:border-gray-200 text-indigo-800 hover:bg-gray-200' }} rounded  py-2 px-4" href="{{ route('admin.notifications.index', 'invite') }}">Invitations</a>
            </li>
        </ul>

        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <h2 class="py-8 px-4 text-indigo-800">
                Envois en echec
            </h3>
            <ul>
                @php
                    $hasFailedNotifications = false;
                @endphp
                @foreach($notifications as $notification_key => $notification)
                    @if ($notification->feedback == "failed")
                        @php
                            $hasFailedNotifications = true;
                        @endphp
                        <li class="">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm leading-5 font-medium text-indigo-600 truncate">
                                        {{ $notification->name }}
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <span class="relative z-0 inline-flex shadow-sm">
                                            <span class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-red-700 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150">
                                                failed
                                            </span>
                                            <a href="" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                                Renvoyer
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
                @if (!$hasFailedNotifications)
                    <p class="text-gray-600 px-4 py-4">
                        Aucune notification en échec
                        @if ($searchEmail)
                            à {{ $searchEmail}}
                        @endif
                    </p>
                @endif            
            </ul>

            <h2 class="py-8 px-4 text-indigo-800 border-t border-gray-200">
                Envois délivrés
            </h3>
            <ul>
                @php
                    $hasDeliveredNotifications = false;
                @endphp
                @foreach($notifications as $notification_key => $notification)
                    @if ($notification->feedback != "failed")
                        @php
                            $hasDeliveredNotifications = true;
                        @endphp
                        <li class="">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm leading-5 font-medium text-indigo-600 truncate">
                                        {{ $notification->name }}
                                    </div>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <span class="relative z-0 inline-flex shadow-sm">
                                            @php
                                                if ($notification->feedback == "opened") $text = "text-green-700";
                                                else $text = 'text-blue-800';
                                            @endphp
                                            <span class="{{ $text }} relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 transition ease-in-out duration-150">
                                                {{ $notification->feedback }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
                @if (!$hasDeliveredNotifications)
                    <p class="text-gray-600 px-4 py-4">
                        Aucune notification envoyées 
                        @if ($searchEmail)
                            à {{ $searchEmail}}
                        @endif
                    </p>
                @endif            
            </ul>
        </div>
    </div>
@endsection