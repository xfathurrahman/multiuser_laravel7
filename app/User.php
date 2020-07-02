<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// use App\Events\UserCreatedEvent;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'client_id',
        'state_id', 'country_id', 'dob', 'address', 'pincode',
        'name', 'email', 'password'
    ];

    //Event Listener for user creation
    // protected $dispatchesEvents = [
    //     'created' => UserCreatedEvent::calss
    // ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //User Creation rules
    public static $rules =[
        'first_name'=> 'required|string|max:191',
        'middle_name'=> 'required|string|max:191',
        'last_name'=> 'required|string|max:191',
        'client_id'=> 'required|integer',
        'dob'=> 'required|date',
        'state_id'=> 'required|integer',
        'country_id'=> 'required|integer',
        'address'=> 'required|max:200',
        'name'=> 'required|string|unique:users|max:191',
        'email'=> 'required|string|email|unique:users|max:191',
        'password'=> 'required|string|max:15'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasRole($role)
    {
        $roles = $this->roles()->where('name', $role)->count();
        if ($roles == 1) {
            return true;
        }
        return false;
    }

    public function clients()
    {
        return $this->hasOne('App\Model\Clients', 'client_id');
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
