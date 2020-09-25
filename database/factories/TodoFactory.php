<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Todo;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {
    return [

            'title' => $faker->sentence(3),
            'content' => $faker->sentence(10),
            'done'=>$faker->numberBetween(0,1)

    ];
});
