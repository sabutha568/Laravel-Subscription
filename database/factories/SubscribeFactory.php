<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscribe;
use Faker\Generator as Faker;

$factory->define(Subscribe::class, function (Faker $faker) {
    return [
        'email' => $faker->safeEmail,
        'coupon_code' => $faker->uuid,
        'date' => $faker->date(),
    ];
});
