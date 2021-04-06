<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'start_date' => Carbon::today()->startOfMonth()->toDateString(),
        'end_date' => Carbon::today()->endOfMonth()->toDateString(),
        'monthly_rent' => $faker->unique()->numberBetween($min = 5000, $max = 10000),
        'monthly_maintainance_rent' => $faker->unique()->numberBetween($min = 500, $max = 4000)
    ];
});
