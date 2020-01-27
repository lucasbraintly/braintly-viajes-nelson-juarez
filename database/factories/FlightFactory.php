<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Flight::class, function (Faker $faker) {
    $flightTimeMinutes = random_int(0, 120) + 60;
    $price = random_int(0, 2000) + 2000;
    $date = now()->addDays(random_int(0, 7));
    return [
        'departure_airport_id' => \App\Models\Airport::all()->random()->id,
        'departure_date' => $date,
        'arrival_airport_id' => \App\Models\Airport::all()->random()->id,
        'arrival_date' => (clone $date)->addMinutes($flightTimeMinutes),
        'airplane_id' => \App\Models\Airline::all()->random()->id,
        'duration' => $flightTimeMinutes,
        'base_price' => $price,
        'created_at' => now(),
        'updated_at' => now()
    ];
});
