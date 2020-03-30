<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Prospect;
use Faker\Generator as Faker;

$factory->define(Prospect::class, function (Faker $faker) {
    return [
        'etab_name'              => $faker->randomElement(['Hopital', 'Clinique']).' '.$faker->name,
        'etab_type'              => $faker->randomElement(config('covidrea.enums.etablissement.type')),
        'etab_adresse'           => $faker->streetAddress,
        'etab_codepostal'        => $faker->postcode,
        'etab_ville'             => $faker->city,
        'etab_region'            => $faker->departmentName,
        'etab_long'              => $faker->longitude(41, 51),
        'etab_lat'               => $faker->latitude(2, 10),
        'user_name'              => $faker->name,
        'user_email'             => $faker->unique()->safeEmail,
        'user_phone'             => $faker->mobileNumber,
    ];
});
