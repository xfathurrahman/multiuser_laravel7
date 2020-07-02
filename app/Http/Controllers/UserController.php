<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Clients;
use App\Model\State;
use App\Model\Country;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Controllers\BaseController;

class UserController extends BaseController //Controller
{
    //User Creation Form Show
    public function register()
    {
        $clients   = Clients::all();
        $countries = Country::all();
        $states    = State::all();
        return view('user.register', compact('clients', 'countries', 'states'));
    }

    //User Creation Store in DB both Client and Admin Login
    public function registerstore(Request $request)
    {
        try {
            $input      = $request->all();
            $validator  = Validator::make($input, User::$rules);
            if ($validator->fails()) {
                return $this->sendError('Validation Errors', [$validator->errors()], 201);
            }
            $input['role']      = '3';
            $input['password']  = Hash::make($input['password']);
            $Client             = User::create($input);
        } catch (CustomException $exception) {
            $exception->report($request);
            return $this->sendError($exception->getMessage(), [$exception->getMessage()], 201);
        }
        return $this->sendResponse(['id'=>$Client->id], 'User created Successfully..');
    }

    //User Registration Before Login
    public function registration(Request $request)
    {
        try {
            $input      = $request->all();
            $validator  = Validator::make($input, User::$rules);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator->errors())->withInput();
            }
            $input['role']      = '3';
            $input['password']  = Hash::make($input['password']);
            $Client             = User::create($input);
        } catch (CustomException $exception) {
            // dd($exception);
            $exception->report($request);
        }
        
        return redirect('login')->with(
            [
                'success'=>true,
                'message'=>'User created Successfully']
        );
    }
    
    //User Login Profile(home) Landing Page
    public function profile($id)
    {
        $users          = User::find($id);
        if (!is_null($users) && is_object($users)) {
            $countryname   = $users->country;
            $statename     = $users->states;
        } else {
            $countryname   = null;
            $statename     = null;
        }
        return view('user.profile')->with(
            ['user'     => $users,
            'country'   => $countryname,
            'state'     => $statename
            ]
        );
    }

    /*If User.Index Route unable to access then use userlist function
    (client & admin users point of view of normal users)*/
    public function userlist()
    {
        $loginuser=Auth::user();
        if ($loginuser->role === 2) {
            $clients=Clients::where('email', Auth::user()->email)->first();
            if (!is_null($clients)) {
                $users=User::where('client_id', $clients->id)->get();
            } else {
                $users=null;
            }
        }
        if ($loginuser->role === 1) {
            $users=User::where('role', '3')->get();
        }

        if (!is_null($users)) {
            return view('user.index')->with(
                ['users'=>UserResource::collection($users)]
            );
        } else {
            return view('user.index')->with(
                ['users'=>UserResource::collection([])]
            );
        }
    }

    //Client Role Users able to see the Users list
    public function clientindex()
    {
        $loginuser=Auth::user();
        $users=User::where('role', '3')->where('client_id', $loginuser->id)->get();
        return view('user.index')->with(
            ['users'=>UserResource::collection($users)]
        );
    }

    //Still not used
    public function index()
    {
        $loginuser=Auth::user();
        if (!is_null($loginuser)) {
            // if($loginuser->role === 3)normal user show only self profile
            if ($loginuser->role === 2) {
                $users=User::where('role', '3')
                    ->where('client_id', $loginuser->id)->get();
            }
            if ($loginuser->role === 1) {
                $users=User::where('role', '3')->get();
            }
            //$users=User::where('role', '3')->get();
        } else {
            $users= [];
        }
        
        return view('user.index')->with(
            ['users'=>UserResource::collection($users)]
        );
    }

    //Still not used
    public function create()
    {
        $countries=Country::all();
        $states=State::all();
        return view('clients.create', compact('countries', 'states'));
    }

    public function store(Request $request)
    {
        try {
            $input      = $request->all();
            $validator  = Validator::make($input, User::$rules);
            if ($validator->fails()) {
                return $this->sendError('Validation Errors', [$validator->errors()], 201);
            }
            $input['role']      = 3;
            $input['password']  = Hash::make($input['password']);
            $Client             = User::create($input);
        } catch (CustomException $exception) {
            $exception->report($request);
            return $this->sendError($exception->getMessage(), [$exception->getMessage()], 201);
        }
        return $this->sendResponse(
            ['id'=>$Client->id],
            'User created Successfully..'
        );
    }

    public function show($id)
    {
        $users          = User::find($id);
        if (!is_null($users) && is_object($users)) {
            $countryname   = $users->country;
            $statename     = $users->states;
        } else {
            $countryname   = null;
            $statename     = null;
        }
        return view('user.show')->with(
            ['user'     => $users,
            'country'   => $countryname,
            'state'     => $statename
            ]
        );
    }
}
