<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'website' => $faker->url,
        'description' => $faker->paragraph(),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'type' => $faker->randomElement(['shop', 'eat_out', 'have_a_drink', 'beauty', 'groceries', 'alcohol', 'pets', 'exercise']),
        'lat' => $faker->latitude,
        'long' => $faker->longitude
    ];
});
