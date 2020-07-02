<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $tables = "states";
    protected $guarded = [];
    protected $fillable = ['country_id', 'name'];

    public function conutry()
    {
        return $this->belongsTo('App\Model\Country');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Model\Clients');
    }
}
