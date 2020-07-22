<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        'state_id', 'country_id', 'address', 'mobile', 'gender',
        'name', 'email', 'password', 'city', 'profile_image'
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
    /* public static $rules =[
        'first_name'=> [ 'string', 'max:191'],
        'middle_name'=> [ 'string', 'max:191'],
        'last_name'=> [ 'string', 'max:191'],
        'client_id'=> ['required', 'integer'],
        'state_id'=> ['required', 'integer'],
        'country_id'=> ['required', 'integer'],
        'address'=> ['required', 'max:200'],
        'name'=> ['required', 'string', 'max:191', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'max:15'],
        'password_confirmation' => ['required', 'string', 'min:8', 'max:15', 'same:password'],
    ]; */
    public function uploadAvatarOnly($image)
    {
        $filename = $image->getClientOriginalName();
        //store new file
        $image->storeAs('profile_images', $filename, 'public');
    }
    public static function uploadAvatar($image, $create = null)
    {
        $filename = $image->getClientOriginalName();
        (isset($create['name']))? null: (new self())->deleteOldImage();
        
        $create['profile_image'] = $filename;
        //store new file
        $image->storeAs('profile_images', $filename, 'public');
        if (!isset($create['name'])) {
            $id=Auth::user()->id;
            User::where('id', $id)->update(['profile_image'=>$filename]);
        } else {
            $id=isset($create['client_id'])?$create['client_id']: Auth::user()->client_id;
            $create['hobbies']      = implode(",", $create["hobbies"]);
            $create['password']     = Hash::make($create['password']);
            $create['role']         = isset($create['role'])? $create['role']: '3';
            $create['client_id']    = $id;
            (new self())::create($create);
        }
    }

    protected function deleteOldImage()
    {
        //Delete existing profile image file
        if (Auth::user()->profile_image) {
            Storage::delete('/public/profile_images/'.Auth::user()->profile_image);
        }
    }

    protected function deleteImage()
    {
        //Delete existing profile image file
        if (Auth::user()->profile_image) {
            Storage::delete('/public/profile_images/'.Auth::user()->profile_image);
        }
    }

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
        return $this->belongsTo('App\Model\Clients', 'client_id');
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
