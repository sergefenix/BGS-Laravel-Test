<?php

/** @var Factory $factory */

use App\Event;
use App\Participant;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Participant::class, static function (Faker $faker) {
    return [
        'name'    => $faker->firstName,
        'surname' => $faker->lastName,
        'event_id' => static function () {
            return Event::inRandomOrder()->first()->id;
        },
        'email'   => $faker->unique()->safeEmail,
    ];
});
