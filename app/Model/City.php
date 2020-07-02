<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $tables = "cities";
    protected $guarded = [];
    protected $fillable = ['name', 'state_id'];
}
