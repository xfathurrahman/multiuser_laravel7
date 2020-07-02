<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Clients extends Authenticatable //Model
{
    use Notifiable;
    protected $table="clients";
    protected $guarded = [];
    
    protected $fillable = ['first_name', 'middle_name', 'last_name',
                       'dob', 'address', 'state_id', 'country_id', 'pincode',
                       'name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public static $loginrules = [
        'email'=> 'required|email|max:191',
        'password'=> 'required|string|max:15'
    ];

    public static $rules =[
        'first_name'=> 'required|string|max:191',
        'middle_name'=> 'required|string|max:191',
        'last_name'=> 'required|string|max:191',
        'dob'=> 'required|date',
        'address'=> 'required|max:200',
        'state_id'=> 'required',
        'country_id'=> 'required',
        'name'=> 'required|string|unique:clients|max:191',
        'email'=> 'required|string|unique:clients|max:191',
        'password'=> 'required|string|max:15'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'client_id');
    }
    
    public function country()
    {
        return $this->belongsTo('App\Model\Country', 'country_id');
    }

    public function states()
    {
        return $this->belongsTo('App\Model\State', 'state_id');
    }
}
