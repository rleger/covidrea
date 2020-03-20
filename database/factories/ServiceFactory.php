<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Service;
use Faker\Generator as Faker;


$factory->define(Service::class, function (Faker $faker) {
    return [
        'name'                          => $faker->name,
        'type'                          => $faker->randomElement(['reanimation', 'conventionnel']),
        'gravite'                       => $faker->randomElement(['intube', 'non-intube']),
        'place_disponible'              => $faker->numberBetween(0, 50),
        'place_bientot_disponible'      => $faker->numberBetween(0, 50),
        'place_preparation'             => $faker->numberBetween(0, 50),
        'etablissement_id'                       => function () {
            return factory(App\Etablissement::class)->create()->id;
        },
    ];
});
