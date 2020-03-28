<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>
    {{-- BeginHero --}}
    <div x-data="{ open: false }" class="relative bg-white overflow-hidden">
        <div class="max-w-screen-xl mx-auto ">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <div class="pt-6 px-4 sm:px-6 lg:px-8"></div>
                <div class="mt-10 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
                            Lits de réanimation
                            <br class="xl:hidden" />
                            <span class="text-indigo-600">COVID-19</span>
                        </h2>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Première application dédiée <span class="font-bold">aux professionnels</span> de santé à la recherche d’un <span class="font-bold">lit de réanimation</span> pour leurs malades COVID+.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('home') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10">Rechercher un lit</a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="{{ auth()->check() ? route('user.services.edit', []) : route('login') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:shadow-outline focus:border-indigo-300 transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10">
                                    Mettre à jour mes lits
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="/images/cover-min-sm.jpg" alt="" />
        </div>
    </div>
    {{-- EndHero --}}



    {{-- Features --}}
    <div class="bg-gray-50 overflow-hidden">
        <div class="relative max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <svg class="absolute top-0 left-full transform -translate-x-1/2 -translate-y-3/4 lg:left-auto lg:right-full lg:translate-x-2/3 lg:translate-y-1/4" width="404" height="784" fill="none" viewBox="0 0 404 784">
                <defs>
                    <pattern id="8b1b5f72-e944-4457-af67-0c6d15a99f38" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="404" height="784" fill="url(#8b1b5f72-e944-4457-af67-0c6d15a99f38)" />
            </svg>

            <div class="relative lg:grid lg:grid-cols-3 lg:col-gap-8">
                <div class="lg:col-span-1">
                    <h3 class="text-3xl leading-9 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                        Trouver <span class="text-indigo-600">un lit</span> c'est sauver <span class="text-indigo-600">une vie</span>
                    </h3>
                </div>
                <div class="mt-10 sm:grid sm:grid-cols-2 sm:col-gap-8 sm:row-gap-10 lg:col-span-2 lg:mt-0">
                    <div>
                        <div class="flex items-center justify-center h-16 w-16 rounded-md bg-white border-indigo-700 border text-white">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" stroke="currentColor" version="1.0" viewBox="0 0 32 32">
                                <path fill="#EDD87E" d="M17 0h-2c-1.656 0-3 1.344-3 3v2a4 4 0 008 0V3c0-1.656-1.344-3-3-3z" />
                                <path opacity=".1" d="M16 8c-1.555 0-2.923-.739-3.818-1.87C12.672 7.785 14.187 9 16 9s3.328-1.215 3.818-2.87C18.923 7.261 17.555 8 16 8z" />
                                <g fill="#434854">
                                    <path d="M12 3v1h1a4 4 0 004-4h-2c-1.656 0-3 1.344-3 3zM17 0a3.99 3.99 0 003 3.858V3c0-1.656-1.344-3-3-3z" />
                                </g>
                                <path fill="#3FA4C4" d="M20 9h-8a3 3 0 00-3 3v1h14v-1a3 3 0 00-3-3z" />
                                <path fill="#EDD87E" d="M16 12c1.656 0 3-1.344 3-3h-6c0 1.656 1.344 3 3 3zM26 19h-2c-1.656 0-3 1.344-3 3v2a4 4 0 008 0v-2c0-1.656-1.344-3-3-3z" />
                                <path opacity=".1" d="M25 27c-1.555 0-2.923-.739-3.818-1.87C21.672 26.785 23.187 28 25 28s3.328-1.215 3.818-2.87C27.923 26.261 26.555 27 25 27z" />
                                <g fill="#434854">
                                    <path d="M21 22v1h1a4 4 0 004-4h-2c-1.656 0-3 1.344-3 3zM26 19a3.99 3.99 0 003 3.858V22c0-1.656-1.344-3-3-3z" />
                                </g>
                                <path fill="#EF4D4D" d="M29 28h-8a3 3 0 00-3 3v1h14v-1a3 3 0 00-3-3z" />
                                <path fill="#EDD87E" d="M25 31c1.656 0 3-1.344 3-3h-6c0 1.656 1.344 3 3 3z" />
                                <g>
                                    <path fill="#EDD87E" d="M8 19H6c-1.656 0-3 1.344-3 3v2a4 4 0 008 0v-2c0-1.656-1.344-3-3-3z" />
                                    <path opacity=".1" d="M7 27c-1.555 0-2.923-.739-3.818-1.87C3.672 26.785 5.187 28 7 28s3.328-1.215 3.818-2.87C9.923 26.261 8.555 27 7 27z" />
                                    <g fill="#434854">
                                        <path d="M3 22v1h1a4 4 0 004-4H6c-1.656 0-3 1.344-3 3zM8 19a3.99 3.99 0 003 3.858V22c0-1.656-1.344-3-3-3z" />
                                    </g>
                                    <path fill="#60B748" d="M11 28H3a3 3 0 00-3 3v1h14v-1a3 3 0 00-3-3z" />
                                    <path fill="#EDD87E" d="M7 31c1.656 0 3-1.344 3-3H4c0 1.656 1.344 3 3 3z" />
                                </g>
                                <path fill="#434854" d="M19 22.5a.5.5 0 01-.5.5h-5a.5.5 0 010-1h5a.5.5 0 01.5.5zM12.854 14.146a.5.5 0 010 .707l-2.828 2.828a.5.5 0 01-.707-.707l2.828-2.828a.5.5 0 01.707 0zM22.682 17.683a.5.5 0 01-.707 0l-2.828-2.828a.5.5 0 01.707-.707l2.828 2.828a.5.5 0 010 .707z" />
                            </svg>


                        </div>
                        <div class="mt-5">
                            <h5 class="text-lg leading-6 font-medium text-gray-900 text-indigo-700">Collaboratif</h5>
                            <p class="mt-2 text-base leading-6 text-gray-500">
                                Vous renseignez vous même les lits disponibles dans votre unité en <span class="font-bold">30 secondes</span> chrono.
                            </p>
                        </div>
                    </div>
                    <div class="mt-10 sm:mt-0">
                        <div class="flex items-center justify-center h-16 w-16 rounded-md bg-white border-indigo-700 border text-white">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10  stroke=" currentColor" version="1.0" viewBox="0 0 32 32">
                                <g fill="#EF4D4D">
                                    <path d="M18.039 20l-5-7-5 5H3.148l12.87 13 10.89-11h-8.869z" />
                                    <path d="M29.41 4.654a8.907 8.907 0 00-12.687 0 8.948 8.948 0 00-.705.812 9.42 9.42 0 00-.705-.812 8.909 8.909 0 00-12.688 0C-.427 7.737-.816 12.487 1.449 16h5.59l6-6 6 8h9.849l.522-.528c3.505-3.539 3.505-9.279 0-12.818z" />
                                </g>
                            </svg>
                            </svg>
                        </div>
                        <div class="mt-5">
                            <h5 class="text-lg leading-6 font-medium text-gray-900 text-indigo-700">Gratuit</h5>
                            <p class="mt-2 text-base leading-6 text-gray-500">
                                Covid moi un lit est entièrement <span class="font-bold">gratuit</span> et n’a en aucun cas été développé dans un but commercial.
                            </p>
                        </div>
                    </div>
                    <div class="mt-10 sm:mt-0">
                        <div class="flex items-center justify-center h-16 w-16 rounded-md bg-white border-indigo-700 border text-white">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10  stroke=" currentColor" version="1.0" viewBox="0 0 32 32">
                                <ellipse fill="#EDD87E" cx="24" cy="10.5" rx="1" ry="2.5" />
                                <ellipse fill="#EDD87E" cx="8" cy="10.5" rx="1" ry="2.5" />
                                <ellipse opacity=".1" cx="24" cy="10.5" rx="1" ry="2.5" />
                                <ellipse opacity=".1" cx="8" cy="10.5" rx="1" ry="2.5" />
                                <path fill="#EDD87E" d="M21 21v-5H11v5c-4.971 0-11 3.029-11 8a3 3 0 003 3h26a3 3 0 003-3c0-4.971-6.029-8-11-8z" />
                                <path fill="#EDD87E" d="M20 0h-8a4 4 0 00-4 4v6c0 5.522 3.582 10 8 10s8-4.478 8-10V4a4 4 0 00-4-4z" />
                                <path opacity=".1" d="M21 19.141v-1.342C19.63 19.174 17.894 20 16 20s-3.63-.826-5-2.201v1.342C12.432 20.313 14.15 21 16 21s3.568-.687 5-1.859z" />
                                <path fill="#EAEAEA" d="M21 21c0 2.209-2.238 4-5 4s-5-1.791-5-4c-4.971 0-11 3.029-11 8a3 3 0 003 3h26a3 3 0 003-3c0-4.971-6.029-8-11-8z" />
                                <path fill="#FFF" d="M16 2a3 3 0 100 6 3 3 0 000-6zm0 5a2 2 0 11-.001-3.999A2 2 0 0116 7z" />
                                <circle fill="#EF4D4D" cx="16" cy="5" r="2" />
                                <g fill="#434854">
                                    <path d="M13 5c0-.353.072-.686.184-1H8v2h5.184A2.962 2.962 0 0113 5zM18.816 4c.112.314.184.647.184 1s-.072.686-.184 1H24V4h-5.184z" />
                                </g>
                                <path fill="#434854" d="M8.67 14c1.235 3.53 4.051 6 7.33 6s6.095-2.47 7.33-6H8.67zM18 17h-4a1 1 0 110-2h4a1 1 0 110 2z" />
                                <g opacity=".1">
                                    <path d="M16 25v7h1v-7.081A6.172 6.172 0 0116 25zM8 29l3 1 3-1v-2H8z" />
                                </g>
                            </svg>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="mt-5">
                            <h5 class="text-lg leading-6 font-medium text-gray-900 text-indigo-700">Par les médecins pour les médecins</h5>
                            <p class="mt-2 text-base leading-6 text-gray-500">
                                Développé par deux praticiens qui connaissent et comprennent les <span class="font-bold">réalités du terrain</span> pour vous offrir un outil qui répond à vos besoins pratiques.
                            </p>
                        </div>
                    </div>
                    <div class="mt-10 sm:mt-0">
                        <div class="flex items-center justify-center h-16 w-16 rounded-md bg-white border-indigo-700 border text-white">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10  stroke=" currentColor" version="1.0" viewBox="0 0 32 32">
                                <path fill="#469FCC" d="M21 14.01h-5v-9l-7 13h5v9z" />
                                <g fill="#434854">
                                    <path d="M30 11.01h-1v-2a2 2 0 00-2-2h-9v2h9v4h3v6h-3v4l-8.5-.011-1 2.011H27a2 2 0 002-2v-2h1a2 2 0 002-2v-6a2 2 0 00-2-2zM2 23.01v-14h9.5l1-2H2a2 2 0 00-2 2v14a2 2 0 002 2h10v-2H2z" />
                                </g>
                            </svg>

                            {{-- <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"> --}}
                            {{-- <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/> --}}
                            {{-- </svg> --}}
                        </div>
                        <div class="mt-5">
                            <h5 class="text-lg leading-6 font-medium text-gray-900 text-indigo-700">Réactif et efficient</h5>
                            <p class="mt-2 text-base leading-6 text-gray-500">
                                Nous avons mis l'accent sur l'ergonomie et l'accessibilité <span class="font-bold">sur smartphone</span> afin que vous ne perdiez pas de temps !
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Features --}}


    {{-- Intérêt --}}
    <div id="interet" class="bg-white">
        <div class="max-w-screen-xl mx-auto px-4 py-12 sm:px-6 lg:py-16 lg:px-8">
            <div class="px-6 py-6 bg-indigo-700 rounded-lg md:py-12 md:px-12 lg:py-16 lg:px-16 xl:flex xl:items-center">
                <div class="xl:w-0 xl:flex-1">
                    <h2 class="text-2xl leading-8 font-extrabold tracking-tight text-white sm:text-3xl sm:leading-9">
                        Manifestez-nous votre intérêt
                    </h2>
                    <p class="mt-3 max-w-3xl text-lg font-bold leading-6 text-indigo-200">
                        Nous débutons en Bourgogne Franche Comté mais nous n'allons pas nous arrêter là.
                    </p>
                    <p class="mt-3 max-w-3xl text-sm leading-6 text-indigo-200">
                        En vous incrivant, vous nous manifestez votre intérêt et nous aidez à poursuivre notre mission pour vous amener covid-moi-un-lit partout où vous en aurez besoin.
                    </p>
                </div>
                <div class="mt-8 sm:w-full sm:max-w-2xl xl:mt-0 xl:ml-8">
                    {{-- Success message --}}

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

                    @if (!session('status'))
                    <form action="{{ route('interested.store') }}" method="post" class="sm:flex">
                        @csrf
                        <div class="w-full mt-3 rounded-md shadow sm:mt-0">
                            {{-- <div class="max-w-xs rounded-md shadow-sm"> --}}
                            <div class="rounded-md shadow-sm text-gray-900 ">
                                <select id="region" name="region[]" class="block text-gray-900 form-select w-full transition border border-transparent text-base duration-150 ease-in-out leading-8 sm:text-sm">
                                    @foreach(config('covidrea.regions-france') as $key => $region)
                                    <option value="{{$key}}">{{ $region }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <input aria-label="Email address" type="email" name="email" value="{{ old('email')}}" required class="mt-4 sm:mt-0 sm:ml-4 appearance-none w-full px-5 py-3 border border-transparent text-base leading-6 rounded-md text-gray-900 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 transition duration-150 ease-in-out" placeholder="Votre adresse email" />

                        <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                            <button class="w-full flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none focus:bg-indigo-400 transition duration-150 ease-in-out">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                    <p class="mt-3 text-sm leading-5 text-indigo-400">
                        Nous savons garder un secret ! votre adresse restera au chaud chez nous, pas de spam !
                    </p>
                    @else
                    <div class="border border-green-400 rounded bg-green-100 mb-4 px-4 py-3 text-green-700">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>



    {{-- FAQ --}}
    <div class="bg-white">
        <div class="max-w-screen-xl mx-auto pt-12 pb-16 sm:pt-16 sm:pb-20 px-4 sm:px-6 lg:pt-20 lg:pb-28 lg:px-8">
            <h2 class="text-3xl leading-9 font-extrabold text-gray-900">
                Vos questions
            </h2>
            <div class="mt-6 border-t-2 border-gray-100 pt-10">
                <dl class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <div>
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                            Qui peut utiliser covid moi un lit ?
                            </dt>
                            <dd class="mt-2">
                                <p class="text-base leading-6 text-gray-500">
                                Tous les acteurs de soins (<span class="font-bold">urgentistes</span> et <span class="font-bold">réanimateurs</span> notamment) impliqués dans la prise en charge des malades COVID nécessitant des soins de réanimation.
                                </p>
                            </dd>
                        </div>
                        <div class="mt-12">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Comment ça marche ?
                            </dt>
                            <dd class="mt-2">
                                <p class="text-base leading-6 text-gray-500">
                                    Une invitation est transmise à un référent de votre établissement réa covid qui se chargera de vous transmettre un email vous donnant accès à l'application.
                                </p>
                            </dd>
                        </div>
                        <div class="mt-12">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Je suis praticien et je veux vous rejoindre, que dois-je faire ?
                            </dt>
                            <dd class="mt-2">
                                <p class="text-base leading-6 text-gray-500">
                                    Nous débutons notre service en Bourgogne Franche Comté. Si vous exercez dans cette région vous devriez reçevoir une invitation prochainement de la part du responsable de votre établissement. Pensez à vérifier votre <strong>courrier indésirable</strong>. Si vous exercez dans une autre région, nous vous demandons encore un peu de patience, vous pouvez <a href="#interet" class="text-indigo-600">manifester votre intérêt</a> plus haut sur cette page.
                                </p>
                            </dd>
                        </div>
                        <div class="mt-12">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Je suis responsable d'établissement que dois-je faire pour vous rejoindre ?
                            </dt>
                            <dd class="mt-2">
                                <p class="text-base leading-6 text-gray-500">
                                    Si votre établissement est situé en Bourgogne Franche Comté vous devriez recevoir une invitation de notre part, dans le cas contraire, vous pouvez nous contacter en envoyant un email à <a href="mailto:etablissement@covid-moi-un-lit.com" class="text-indigo-600">etablissement@covid-moi-un-lit.com</a>. Si vous êtes dans une autre région, nous vous invitons à <a href="#interet" class="text-indigo-600">manifester votre intérêt</a> plus haut sur cette page.
                                </p>
                            </dd>
                        </div>
                    </div>
                    <div class="mt-12 md:mt-0">
                        <div>
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Est-ce que je peux mettre à jour et consulter les données depuis mon téléphone ?
                            </dt>
                            <dd class="mt-2">
                                <p class="text-base leading-6 text-gray-500">
                                    Bien sûr ! Nous avons tout fait pour vous simplifier la vie, le site est accessible sur votre ordinateur, tablette ou mobile.
                                </p>
                            </dd>
                        </div>
                        <div class="mt-12">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Quand allez-vous ouvrir l'accès pour ma région ?
                            </dt>
                            <dd class="mt-2">
                                <p class="text-base leading-6 text-gray-500">
                                    Nous sommes conscients de l'urgence de la situation et mettons tout en oeuvre pour offrir notre service au plus grand nombre dans les meilleurs délais, vous pouvez <a href="#interet" class="text-indigo-600">manifester votre intérêt</a>.
                                </p>
                            </dd>
                        </div>
                        <div class="mt-12">
                            <dt class="text-lg leading-6 font-medium text-gray-900">
                                Que deviennent les données saisies sur le site ?
                            </dt>
                            <dd class="mt-2">
                                <p class="text-base leading-6 text-gray-500">
                                Nous accordons la plus grande importance à la sécurité et confidentialité des données. Nous ne communiquerons aucune information personnelle à une tierce partie. L'objectif de l'application est d'assister les praticiens dans la gestion opérationnelle de la crise. L'application ne requiert la saisie <span class="font-bold">d'aucune donnée patient</span>.
                                </p>
                            </dd>
                        </div>
                    </div>
                </dl>
            </div>
        </div>
    </div>


    {{-- Pitch --}}
    <div class="py-12 bg-gray-50 overflow-hidden md:py-20 lg:py-24">
        <div class="relative max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <svg class="absolute top-full right-full transform translate-x-1/3 -translate-y-1/4 lg:translate-x-1/2 xl:-translate-y-1/2" width="404" height="404" fill="none" viewBox="0 0 404 404">
                <defs>
                    <pattern id="ad119f34-7694-4c31-947f-5c9d249b21f3" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                    </pattern>
                </defs>
                <rect width="404" height="404" fill="url(#ad119f34-7694-4c31-947f-5c9d249b21f3)" />
            </svg>

            <div class="relative">
                <div class="mx-auto flex items-center justify-center h-40 w-40 mb-10 rounded-full bg-white">
                    <svg class="mx-auto h-20" xmlns="http://www.w3.org/2000/svg" version="1.0" viewBox="0 0 32 32">
                        <path fill="#EAEAEA" d="M29 3h-7V1a1 1 0 00-1-1H11a1 1 0 00-1 1v2H3a1 1 0 00-1 1v28h28V4a1 1 0 00-1-1z" />
                        <path fill="#FFF" d="M11 24h10v8H11z" />
                        <path fill="#434854" d="M12 25h8v7h-8z" />
                        <g fill="#469FCC">
                            <path d="M11 18h4v4h-4zM5 18h4v4H5zM23 18h4v4h-4zM11 12h4v4h-4zM5 12h4v4H5zM23 12h4v4h-4zM17 18h4v4h-4zM17 12h4v4h-4zM5 6h4v4H5zM23 6h4v4h-4z" />
                        </g>
                        <g opacity=".2">
                            <path d="M5 6h4v1H5zM23 6h4v1h-4zM5 12h4v1H5zM17 12h4v1h-4zM23 12h4v1h-4zM5 18h4v1H5zM17 18h4v1h-4zM11 12h4v1h-4zM11 18h4v1h-4zM23 18h4v1h-4z" />
                        </g>
                        <path fill="#3AAD73" d="M7.445 32A3.958 3.958 0 008 30a4 4 0 00-8 0c0 .732.211 1.409.555 2h6.89zM28 26a3.992 3.992 0 00-3.632 2.345A2.964 2.964 0 0023 28a3 3 0 00-3 3c0 .353.072.686.184 1h11.262A3.967 3.967 0 0032 30a4 4 0 00-4-4z" />
                        <path d="M24.368 28.345A2.964 2.964 0 0023 28a3 3 0 00-3 3c0 .353.072.686.184 1h4.371A3.958 3.958 0 0124 30c0-.592.137-1.149.368-1.655z" opacity=".2" />
                        <path fill="#EF4D4D" d="M19 2a1 1 0 00-1 1v2h-4V3a1 1 0 10-2 0v6a1 1 0 102 0V7h4v2a1 1 0 102 0V3a1 1 0 00-1-1z" />
                    </svg>

                </div>

                <blockquote class="mt-8">
                    <div class="max-w-3xl mx-auto text-center text-lg sm:text-2xl leading-7 sm:leading-9 font-medium text-gray-600">
                        <p class="mb-4">
                            Avec <span class="text-indigo-600 font-bold">Covid moi un lit</span> les informations sont issues directement du terrain sans la complexité des filtres administratifs.
                        </p>
                        <p class="mb-4">
                            Elles sont disponibles <span class="text-indigo-600 font-bold">en temps réel</span> et exploitables pour l’ensemble des acteurs de la prise en charge des malades.
                        </p>

                        <p class="text-indigo-600 text-xl sm:text-2xl leading-8 sm:leading-9 font-medium text-gray-900 border-t py-6 my-6">
                            En vous permettant de gagner un temps précieux<br/> <span class="font-bold">Covid moi un lit</span> vous aide à sauver des vies !
                        </p>
                    </div>
                    <footer class="mt-8">
                        <div class="md:flex md:items-center md:justify-center">
                            <div class="md:flex-shrink-0 text-gray-900">
                                <img class="mx-auto h-14 w-14 rounded-full" src="images/avatar-rl.png" alt="" />
                            </div>
                            <div class="mt-3 text-center md:mt-0 md:ml-4 md:flex md:items-center">
                                <div class="text-base leading-6 font-medium text-gray-900">Dr Léger Romain</div>
                            </div>
                            <div class="pt-4 sm:pl-4 sm:pt-0 md:flex-shrink-0">
                                <img class="mx-auto h-14 w-14 rounded-full" src="images/avatar-vb.png" alt="" />
                            </div>
                            <div class="mt-3 text-center md:mt-0 md:ml-4 md:flex md:items-center">
                                <div class="text-base leading-6 font-medium text-gray-900">Dr Bailly Vincent</div>
                            </div>
                        </div>
                    </footer>
                </blockquote>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('partials.footer')
</body>
