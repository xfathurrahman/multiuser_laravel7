<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Admins;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Admins::class, function (Faker $faker) {
    return [
        'name'=> $faker->name,
        'email'=> $faker->unique()->safeEmail,
        'password'=> Hash::make('San123'),
        'is_super' => true
    ];
});
