@component('mail::message')
{{-- # {{ $details['title'] }} --}}

# Madame la Directrice / Monsieur le Directeur, Cher collègue, 

{{-- $prospect->makeSignedUrl('register') --}}
@component('mail::button', ['url' => $prospect->makeTemporarySignedUrl('register', 7, [ "prospect" => $prospect->id ]) ])
Activer mon compte
@endcomponent


Covid moi un lit est la première application dédiée aux professionnels de santé
à la recherche d’un lit de réanimation pour leurs malades COVID+.

Cet outil GRATUIT et COLLABORATIF, développé par des médecins pour des médecins,
propose un mode de communication réactif, efficient.

L’objectif n’est pas de concurrencer ou de parasiter les systèmes actuels mis en place mais d’apporter une aide supplémentaire pour la gestion opérationnelle de cette crise.


## FACILE À UTILISER:

Covid moi un lit est accessible sur PC, mac et smartphone.

Vos chefs de services (ou référents) renseignent eux-mêmes les lits disponibles dans leur unité en 30 secondes chrono.
La procédure simplissime leur permet d’actualiser plusieurs fois par jour l’état des lits pour une meilleure information de vos confrères et des centres de régulation.


## ALLER À L’ESSENTIEL (et vite):

Vous disposez en un coup d’oeil d'un panorama géo-localisé des lits de réanimation disponibles
autour de votre établissement.

Avec Covid moi un lit les informations sont issues directement du terrain et sont instantanément disponibles et exploitables pour l’ensemble des acteurs de la chaine de prise en charge des malades (médecins, bed managers, centres de crise…)


## NON COMMERCIAL:

Covid moi un lit est entièrement gratuit et n’a en aucun cas été développé dans un but commercial. 
Nous aidons simplement nos confrères à la gestion opérationnelle de la crise.
Inutile de préciser que nous ne vendrons en aucun cas les adresses mails collectées.
Aucune donnée de santé ne sont requises. Uniquement des chiffres.

Nous pensons que notre outil peut aider nos confrères, nos patients, nos concitoyens.

En permettant de gagner du temps aux médecins, Covid moi un lit vous aide à sauver des vies !

Plus la communauté Covid moi un lit sera importante, plus l’information sera pertinente!


Pour démarrer l'utilisation de Covid moi un lit au sein de votre établissement, il vous suffit de cliquer sur ce lien :  Activer mon compte

Pour toute question concernant l'outil ou son utilisation, vous pouvez nous joindre par email à contact@covid-moi-un-lit.com ou 06 61 08 40 24

En vous remerciant et restant à votre disposition.


Dr Romain Léger & Dr Vincent Bailly 

Avec le soutien de: Hacking Health Besançon, Silicon Comté, CCI du Doubs

@endcomponent
