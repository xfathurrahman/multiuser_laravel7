<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Model\Clients;
use App\Model\Country;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    public $clients;
    public $countries;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->clients=Clients::all();
        $this->countries=Country::all();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
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
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data);
        if (isset($data['profile_image'])) {
            User::uploadAvatarOnly($data['profile_image']);
            //redirect()->route('user.index')->with('success', 'User created successfully');
        }
            $data['hobbies']      = implode(",", $data["hobbies"]);
            return User::create(
                [
                'role' => '3',
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'client_id' => $data['client_id'],
                // 'dob' => $data['dob'],
                'address' => $data['address'],
                'city' => $data['city'],
                'state_id' => $data['state_id'],
                'country_id' => $data['country_id'],
                'mobile' => $data['mobile'],
                'gender' => $data['gender'],
                'hobbies' => $data['hobbies'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                ]
            );
    }
}
