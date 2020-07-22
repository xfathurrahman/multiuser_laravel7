<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Clients extends Authenticatable //Model
{
    use Notifiable;
    protected $table="clients";
    protected $guarded = [];
    
    protected $fillable = ['first_name', 'middle_name', 'last_name',
                       'address', 'state_id', 'country_id', 'mobile', 'gender',
                       'name', 'email', 'password', 'city', 'profile_image'];
    protected $hidden = ['password', 'remember_token'];

    public static $loginrules = [
        'email'=> 'required|email|max:191',
        'password'=> 'required|string|max:15'
    ];

    public static $rules =[
        'name'=> 'required|string|unique:clients|max:50',
        'email'=> 'required|string|unique:clients|max:191',
        'password'=> 'required|string|min:8|max:15',
        'password_confirmation' => 'required|string|min:8|max:15|same:password',
        'first_name'=> 'max:191',
        'middle_name'=> 'max:191',
        'last_name'=> 'max:191',
        'address'=> 'required|max:200',
        'mobile' => 'required|numeric',
        'country_id'=> 'required|integer',
        'state_id'=> 'required|integer',
        'city' => 'string|max:100',
        'profile_image'=> 'mimes:jpg,jpeg,png',
        'gender' => 'required|string|max:15',
        'hobbies' => 'max:100',
    ];

    public static function uploadAvatar($image, $create)
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
            $create['hobbies']      = implode(",", $create["hobbies"]);
            $create['password']     = Hash::make($create['password']);
            (new self())::create($create);
            /* After create Client User same data inset also users table through trigger  */
        }
    }

    public function users()
    {
        return $this->hasMany('App\User', 'client_id');
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
