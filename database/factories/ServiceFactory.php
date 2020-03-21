<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'name'                                     => $faker->name,
        'type'                                     => $faker->randomElement(config('covidrea.enums.service.type')),
        'gravite'                                  => $faker->randomElement(config('covidrea.enums.service.gravite')),
        'place_totales'                            => $faker->numberBetween(0, 50),
        'place_disponible'                         => $faker->numberBetween(0, 50),
        'place_bientot_disponible'                 => $faker->numberBetween(0, 50),
        'contact'                                  => $faker->phoneNumber(),
        'etablissement_id'                         => function () {
            return factory(App\Etablissement::class)->create()->id;
        },
    ];
});
