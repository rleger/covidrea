<?php

return [

    'admin' => [
        'email' => 'legerrom@gmail.com'
    ],

    'email' => [
        'default_sender' => 'mail@covid-moi-un-lit.com',
    ],
    'regions-france' => [
        "alsace" =>"Alsace, Champagne-Ardenne et Lorraine",
        "aquitaine" =>"Aquitaine, Limousin et Poitou-Charentes",
        "auvergne" =>"Auvergne et Rhône-Alpes",
        "bfc" =>"Bourgogne et Franche Comté",
        "languedoc" =>"Languedoc-Roussillon et Midi-Pyrénées",
        "npdc" =>"Nord-Pas-de-Calais et Picardie",
        "normandie" =>"Basse-Normandie et Haute-Normandie",
        "bretagne" =>"Bretagne",
        "corse" =>"Corse",
        "centre" =>"Centre",
        "idf" =>"Île-de-France",
        "loire" =>"Pays de la Loire",
        "paca" =>"Provence-Alpes-Côte d'Azur.  ",
        "suisse" =>"Suisse",
        "allemagne" =>"Allemagne",
        "belgique" =>"Belgique",
        "autre" =>"Autre",
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
