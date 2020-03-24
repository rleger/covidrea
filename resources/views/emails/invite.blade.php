@component('mail::message')
{{-- # {{ $details['title'] }} --}}

# Activez votre compte covid-moi-un-lit.com


Bonjour,

Vous avez été invité à rejoindre **gratuitement** l'application covid-moi-un-lit.com afin de vous aider à trouver des lits plus facilement pour vos malades covid+ (intubés ou non intubés).

Cette application est **collaborative**.

@component('mail::button', ['url' => route('invite.accept', ['token' => $invite->token, 'etablissement_id' => $invite->etablissement_id, 'email' => $invite->email ]) ])
Activer mon compte
@endcomponent

Nous comptons sur vous pour mettre à jour en temps réel le nombre de lits disponibles pour votre unité.

L'équipe covid moi un lit
@endcomponent
