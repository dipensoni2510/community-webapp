<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MaintainanceProvider;
use App\MaintainanceService;
use Faker\Generator as Faker;

$factory->define(MaintainanceProvider::class, function (Faker $faker) {
    return [
        'maintainance_service_id' => MaintainanceService::all()->random()->id,
        'name' => $faker->company,
        'website' => $faker->url,
        'description' => $faker->paragraph(),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'lat' => $faker->latitude,
        'long' => $faker->longitude,
    ];
});
