<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    return [
        'regular_link' => $faker->url,
        'short_link' => 'http://localhost/'.str_random(5),
        'number_of_transitions' => 10,
    ];
});
