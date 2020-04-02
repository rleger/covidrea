@component('mail::message')
{{-- # {{ $details['title'] }} --}}

# Activez votre compte covid-moi-un-lit.com

Bonjour,

Nous avons envoyé un email aux utilisateurs suivants:
@foreach($emails as $key => $email)
 * {{ $email }}
@endforeach


Nous comptons sur vous pour mettre à jour en temps réel le nombre de lits disponibles pour votre unité.

L'équipe covid moi un lit
@endcomponent
