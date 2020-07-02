<?php

/** @var Factory $factory */

use App\City;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(City::class, static function (Faker $faker) {
    return ['name' => $faker->city];
});
