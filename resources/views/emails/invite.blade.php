@component('mail::message')
{{-- # {{ $details['title'] }} --}}

# Activez votre compte Covid-moi-un-lit.com

Bonjour,

Vous avez été invité à rejoindre **gratuitement** l'application [covid-moi-un-lit.com](https://covid-moi-un-lit.com) afin de vous aider à trouver des lits plus facilement pour vos malades covid+ (intubés ou non intubés).

Vous pourrez également mettre à jour en temps réel le nombre de lits disponibles pour votre unité.

@component('mail::button', ['url' => route('invite.accept', ['token' => $invite->token, 'etablissement_id' => $invite->etablissement_id, 'email' => $invite->email ]) ])
Activer mon compte
@endcomponent

Vous pourrez également indiquer et mettre à jour le nombre de lits disponibles pour votre unité.

{{ config('app.name') }}
@endcomponent
