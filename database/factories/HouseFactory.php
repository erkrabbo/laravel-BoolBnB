<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\House;
use Faker\Generator as Faker;

$factory->define(House::class, function (Faker $faker) {
    $availability_start = $faker->dateTimeInInterval('-30 year', '+30 year');
    $n_months = rand(1,11);

    return [
        'user_id' => User::inRandomOrder()->first()->id,
        'Poster' => $faker->image(),
        'Title' => $faker->word(rand(1, 5), true),
        'N_of_rooms' => $faker->randomDigit(10),
        'N_of_beds' => $faker->randomDigit(10),
        'N_of_baths' => $faker->randomDigit(10),
        'Mq' => $faker->randomDigit(10, 300),
        'Available_from' => $availability_start,
        'Available_to' => date('Y-m-d', strtotime($availability_start->format('Y-m-d') . "+ $n_months month")),
        'Address' => $faker->address(),
        'Lat' => 1,
        'Lng' => 5,
    ];
});
