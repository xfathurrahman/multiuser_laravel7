<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Clients;
use Faker\Generator as Faker;

$factory->define(Clients::class, function (Faker $faker) {
    return [
        'name'=> $faker->unique()->name,
        'email'=> $faker->unique()->safeEmail,
        'password'=> Hash::make('San123'),
        'is_editor' => true
    ];
});
