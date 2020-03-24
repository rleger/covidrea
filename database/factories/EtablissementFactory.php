<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Etablissement;
use Faker\Generator as Faker;

$factory->define(Etablissement::class, function (Faker $faker) {
    return [
        'name'       => $faker->randomElement(['Hopital', 'Clinique']).' '.$faker->name,
        'type'       => $faker->randomElement(config('covidrea.enums.etablissement.type')),
        'adresse'    => $faker->streetAddress,
        'codepostal' => $faker->postcode,
        'ville'      => $faker->city,
        'region'     => $faker->departmentName,
        'long'       => $faker->longitude(41, 51),
        'lat'        => $faker->latitude(2, 10),
        'user_id'    => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});
