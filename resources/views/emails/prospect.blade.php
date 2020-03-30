@component('mail::message')
{{-- # {{ $details['title'] }} --}}

# INVITATION Chef d'etab

invitation de chef d'établissemnet
{{-- $prospect->makeSignedUrl('register') --}}
@component('mail::button', ['url' => $prospect->makeTemporarySignedUrl('register', 7, [ "prospect" => $prospect->id ]) ])
{{-- @component('mail::button', ['url' => route('register', ['prospect' => $prospect->id, 'token' => ]) ]) --}}
{{-- @component('mail::button', ['url' => route('invite.accept', ['token' => $invite->token, 'etablissement_id' => $invite->etablissement_id, 'email' => $invite->email ]) ]) --}}
Activer mon compte
@endcomponent

@endcomponent
