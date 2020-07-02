<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table="books";
    protected $guarded = [];

    public static $rules= [
        'book_name'=> 'required|string|max:50',
        'isbn_number'=> 'required|string|max:14',
        'received_date'=> 'required|date',
        'delivery_date'=> 'required|date',
        'author_first_name'=> 'required|string|max:50',
        'author_last_name'=> 'required|string|max:50'
    ];
}
