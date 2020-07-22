<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Controllers\BaseController;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Model\Clients;
use App\Model\State;
use App\Model\Country;
use Validator;
use App\User;
use DB;

class UserController extends BaseController
{
    public function index(Request $request)
    {
        $loginid=Auth::user()->id;
        $data = User::where('id', '<>', $loginid)->orderBy('id', 'DESC')->paginate(5);
        return view('user.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = Role::pluck('name', 'name')->all();
        $countries=Country::all();
        return view('user.create', compact('countries'));
    }
    
    /**
     ** Store a newly created resource in storage.
     ** @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $input      = $request->all();
        if ($request->hasFile('profile_image')) {
            User::uploadAvatar($request->profile_image, $input);
            return redirect()->route('user.index')->with('success', 'User created successfully');
        } else {
            $input['hobbies']      = implode(",", $input["hobbies"]);
            $input['password']     = Hash::make($input['password']);
            $input['role']         = '3';
            $input['client_id']    = Auth::user()->client_id;
            $user                  = User::create($input);
            return redirect()->route('user.index')->with('success', 'User created successfully');
        }
    }
    
    /**
     * Display the specified resource.
     * @param  int  $id* @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $countries  = Country::find($user->country_id);
        $states     = State::find($user->state_id);
        return view('user.show', compact('user', 'countries', 'states'));
    }
    
    /**
     * Show the form for editing the specified resource.
     * @param  int  $id* @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $countries=Country::all();
        $states=State::find($user->state_id);
        return view('user.edit', compact('user', 'countries', 'states'));
    }
    
    /**;
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $input      = $request->except(['_method', '_token']);
        // dd($input, $request->hasFile('profile_image'));
        if ($request->hasFile('profile_image')) {
            User::uploadAvatar($request->profile_image, null);
        } else {
            $input['hobbies']      = implode(",", $input["hobbies"]);
            User::where('id', $user->id)->update($input);
        }
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }
    
    /*** Remove the specified resource from storage.** @param  int  $id
     * * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('user.index'))->with('success', 'User deleted successfully');
    }

    //If User.Index Route unable to access then use userlist function
    //(client & admin users point of view of normal users)
    public function userlist()
    {
        $loginuser=Auth::user();
        if ($loginuser->role === 2) {
            $clients=Clients::where('email', Auth::user()->email)->first();
            if (!is_null($clients)) {
                $data=User::where('client_id', $clients->id)->get();
            } else {
                $data=null;
            }
        }
        if ($loginuser->role === 1) {
            $data=User::where('role', '3')->get();
        }
        if (!is_null($data)) {
            return view('user.index')->with(
                ['data'=>UserResource::collection($data)]
            );
        } else {
            return view('user.index')->with(
                ['data'=>UserResource::collection([])]
            );
        }
    }
    
    public function profile($id)
    {
        $users          = User::find($id);
        // $country_name   = Country::find($users->country_id);
        $countryname   = $users->country;
        // $state_name     = State::find($users->state_id);
        $statename      = $users->states;
        $clients        = $users->clients;
        return view('user.profile', [
            "user"=>$users,
            "country"=>$countryname,
            "state"=>$statename,
            "clients"=>$clients]);
    }
}
