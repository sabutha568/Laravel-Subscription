<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Coupon;
use Faker\Generator as Faker;

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'coupon_code' => $faker->uuid,
        'email' => $faker->safeEmail,
    ];
});
