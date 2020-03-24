@extends('layouts.app')

@section('page_title', 'Oups...')

@section('content')
    <div class="bg-white">
        <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 md:py-16 lg:px-8 lg:py-20">
            <h2 class="text-3xl leading-9 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                Oups...
                <br />
                <span class="text-indigo-600">Cette ressource n'est pas disponible</span>
            </h2>
            <div class="mt-8 flex">
                <div class="inline-flex rounded-md shadow">
                    <a href="/" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                        Retourner à l'accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
