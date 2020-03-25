<?php

return [

    'admin' => [
        'email' => 'legerrom@gmail.com'
    ],

    'email' => [
        'default_sender' => 'mail@covid-moi-un-lit.com',
    ],
    'enums' => [
        'service' => [
            'type' => [
                'reanimation',
                'conventionnel',
            ],
            'gravite' => [
                'intube',
                'non-intube',
            ],
        ],
        'etablissement' => [
            'type' => [
                'public',
                'prive',
                'temporaire',
            ],
        ],
    ],
];
