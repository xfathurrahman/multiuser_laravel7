<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    $rec_date = $faker->date;
    $del_date = ($rec_date < $faker->date)? $faker->date: $rec_date;
    return [
        'book_name'=> $faker->name,
        'isbn_number'=> rand(10000, 999999),
        'received_date'=> $rec_date,
        'delivery_date'=> $del_date,
        'author_first_name'=> $faker->name,
        'author_last_name'=> $faker->name
    ];
});
