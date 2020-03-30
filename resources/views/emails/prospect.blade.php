@component('mail::message')

# Madame, Monsieur le Directeur,

[Covid moi un lit](https://covid-moi-un-lit.com) est la première application dédiée aux **professionnels de santé** à la recherche d’un **lit de réanimation** pour leurs malades COVID+. Trouver un lit, c'est sauver une vie.

Cet outil GRATUIT et COLLABORATIF, développé par des médecins pour des médecins, propose un mode de communication réactif et efficient.

{{-- $prospect->makeSignedUrl('register') --}}
@component('mail::button', ['url' => $prospect->makeTemporarySignedUrl('register', 7, [ "prospect" => $prospect->id ]) ])
Activer mon compte
@endcomponent


## FACILE À UTILISER

- Le praticien renseigne lui-même les lits disponibles dans son unité en **30 secondes chrono** depuis un PC, mac ou smartphone.
- La procédure simplissime leur permet d’actualiser plusieurs fois par jour l’état des lits

@component('mail::panel')
    30 secondes chrono
@endcomponent

## ALLER À L’ESSENTIEL (et vite)

- Panorama **géolocalisé** des lits disponibles en un coup d'oeil
- Données issues directement du terrain

@component('mail::panel')
    En un coup d'oeil
@endcomponent

## NON COMMERCIAL ET SECURISE

- [Covid moi un lit](https://covid-moi-un-lit.com) est **entièrement gratuit**
- Aucune donnée de santé n'est requise

@component('mail::panel')
    Gratuit et sans spam
@endcomponent

Pour toute question concernant l'outil ou son utilisation, vous pouvez nous joindre par email à [mail@covid-moi-un-lit.com](mailto:mail@covid-moi-un-lit.com).

En vous remerciant de votre participation.

Dr Romain Léger & Dr Vincent Bailly 

Avec le soutien de: Hacking Health Besançon, Silicon Comté, CCI du Doubs
@endcomponent
