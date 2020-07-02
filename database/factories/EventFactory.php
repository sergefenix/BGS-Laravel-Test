<?php

/** @var Factory $factory */

use App\City;
use App\Event;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Event::class, static function (Faker $faker) {
    return [
        'name'       => $faker->company,
        'date_start' => $faker->date(),
        'city_id'   => static function () {
            return City::inRandomOrder()->first()->id;
        },
    ];
});
