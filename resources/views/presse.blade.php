@extends('layouts.static')

@section('meta_desc', 'Revue de presse de covid moi un lit. Ils parlent de nous.');
@section('page_title', 'Revue de presse')

@section('content')
    <div class="bg-gray-50 pt-12 sm:pt-16">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl leading-9 font-extrabold text-gray-900 sm:text-4xl sm:leading-10">
                   Revue de presse
                </h2>
                <p class="mt-3 text-xl leading-7 text-gray-500 sm:mt-4">
                    Ils parlent de nous
                </p>
            </div>
        </div>
        <div class="mt-10">
            <ul class="md:grid md:grid-cols-2 md:col-gap-8 md:row-gap-10">
                <li>
                <div class="flex">
                    <div class="ml-4">
                        <a href="https://www.lesechos.fr/pme-regions/innovateurs/covid-moi-un-lit-lappli-qui-recense-en-temps-reel-les-places-en-reanimation-1190691" target="_blank">
                            <img src="{{ asset('images/partners/les-echos.jpg') }}">
                            <p class="mt-2 text-base leading-6 text-gray-500">
                                "Covid-moi-un-lit, l'appli qui recense en temps réel les places en réanimation"
                            </p>
                        </a>
                    </div>
                </div>
                </li>
                <li>
                <div class="flex">
                    <div class="ml-4">
                        <a href="https://www.infos-dijon.com/news/bourgogne-franche-comte/bourgogne-franche-comte/numerique-lancement-de-l-application-covid-moi-un-lit.html" target="_blank">
                            <img src="{{ asset('images/partners/tec-hopital.jpg') }}">
                            <p class="mt-2 text-base leading-6 text-gray-500">
                                "NUMÉRIQUE : Lancement de l'application Covid-Moi-Un-Lit"
                            </p>
                        </a>
                    </div>
                </div>
                </li>
                <li>
                <div class="flex">
                    <div class="ml-4">
                        <a href="">
                            <img src="{{ asset('images/partners/quotidien-medecin.jpg') }}">
                            <p class="mt-2 text-base leading-6 text-gray-500">
                            </p>
                        </a>
                    </div>
                </div>
                </li>
                <li>
                <div class="flex">
                    <div class="ml-4">
                        <a href="https://france3-regions.francetvinfo.fr/bourgogne-franche-comte/doubs/besancon/coronavirus-covid-19-deux-medecins-creent-application-recenser-lits-reanimation-disponibles-1807296.html" target="_blank">
                            <img src="{{ asset('images/partners/france-3.jpg') }}">
                            <p class="mt-2 text-base leading-6 text-gray-500">
                                "Coronavirus Covid-19 : deux médecins créent une application pour recenser les lits de réanimation disponibles"
                            </p>
                        </a>
                    </div>
                </div>
                </li>
                <li>
                <div class="flex">
                    <div class="ml-4">
                        <a href="https://www.macommune.info/covid-moi-un-lit-com-une-application-lancee-a-besancon-pour-aider-les-professionnels-de-sante-a-trouver-des-lits-de-reanimation/" target="_blank">
                            <img src="{{ asset('images/partners/ma-commune.jpg') }}">
                            <p class="mt-2 text-base leading-6 text-gray-500">
                                "covid-moi-un-lit.com : une application pour trouver des lits de réanimation"
                            </p>
                        </a>
                    </div>
                </div>
                </li>
                <li>
                <div class="flex">
                    <div class="ml-4">
                        <a href="https://www.estrepublicain.fr/sante/2020/03/30/coronavirus-une-appli-pour-gerer-les-lits-de-reanimation-creee-en-six-jours-a-besancon" target="_blank">
                            <img src="{{ asset('images/partners/est-republicain.jpg') }}">
                            <p class="mt-2 text-base leading-6 text-gray-500">
                                "Coronavirus : une appli pour gérer les lits de réanimation créée en six jours à Besançon"
                            </p>
                        </a>
                    </div>
                </div>
                </li>
                <li>
                <div class="flex">
                    <div class="ml-4">
                        <a href="https://www.infos-dijon.com/news/bourgogne-franche-comte/bourgogne-franche-comte/numerique-lancement-de-l-application-covid-moi-un-lit.html" target="_blank">
                            <img src="{{ asset('images/partners/infos-dijon.jpg') }}">
                            <p class="mt-2 text-base leading-6 text-gray-500">
                                "NUMÉRIQUE : Lancement de l'application Covid-Moi-Un-Lit
"</a>
                            </p>
                        </a>
                    </div>
                </div>
                </li>
                <li>
                <div class="flex">
                    <div class="ml-4">
                        <a href="">
                            <img src="{{ asset('images/partners/la-presse-bisontine.jpg') }}">
                            <p class="mt-2 text-base leading-6 text-gray-500">

                            </p>
                        </a>
                    </div>
                </div>
                </li>
                <li>
                <div class="flex">
                    <div class="ml-4">
                        <a href="">
                            <img src="{{ asset('images/partners/france-bleu.jpg') }}">
                            <p class="mt-2 text-base leading-6 text-gray-500">

                            </p>
                        </a>
                    </div>
                </div>
                </li>
            </ul>
        </div>
    </div>
@endsection
