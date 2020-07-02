<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $tables = "countries";
    protected $guarded = [];
    protected $fillable = ['name', 'sortname', 'phonecode'];

    public function users()
    {
        return $this->hasOne('App\Model\Country');
    }

    public function clients()
    {
        return $this->hasOne('App\Model\Country');
    }

    public function states()
    {
        return $this->hasMany('App\Model\State');
    }
}
