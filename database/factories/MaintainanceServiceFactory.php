<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MaintainanceService;
use Faker\Generator as Faker;

$factory->define(MaintainanceService::class, function (Faker $faker) {
    return [
        'title' => $faker->randomElement(['Laundry', 'Cleaining', 'Maid Service', 'Movers', 'Air Conditioner', 'Plumbing', 'Electircal', 'Pest Control']),
    ];
});
