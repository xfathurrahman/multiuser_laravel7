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
use App\Exceptions\CustomException;
use App\Http\Resources\ClientsResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Carbon;

class ClientsController extends Controller
{
    public function profile($id)
    {
        $clients       = User::find($id);
        if (!is_null($clients)) {
            $countryname   = $clients->country;
            $statename     = $clients->states;
        } else {
            $countryname   = null;
            $statename     = null;
        }
        
        // dd($clients, $countryname, $statename);
        return view('clients.show')->with(
            ['clients'     => $clients,
            'country'   => $countryname,
            'state'     => $statename
            ]
        );
    }
    
    public function register()
    {
        $countries  = Country::all();
        return view('clients.register', compact('countries'));
    }

    public function registration(Request $request)
    {
        try {
            $input      = $request->all();
            $validator  = Validator::make($input, Clients::$rules);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator->errors())->withInput();
                // return $this->sendError('Validation Error.', $validator->errors());
            }
        
            if ($request->hasFile('profile_image')) {
                Clients::uploadAvatar($request->profile_image, $input);
                return redirect()->route('user.index')->with('success', 'Customer created successfully');
            } else {
                $input['hobbies']   = implode(",", $input["hobbies"]);
                $input['password']  = Hash::make($input['password']);
                $Client             = Clients::create($input);
            }
        } catch (CustomException $exception) {
            $exception->report($request);
            // return back()->withError($exception->getMessage())->withInput();
        }
        
        return redirect('login')->with(
            [
            'success'=>true,
            'message'=>'Client Registered Successfully'
            ]
        );
    }

    public function login(Request $request)
    {
        $login=$request->only(['email', 'password']);

        $validator = Validator::make($login, Clients::$loginrules);
        if ($validator->fails()) {
            // redirect()->back()->with(['status']);
            return redirect('login/clients')
                ->withError($validator->errors())
                ->withInput();
        }
        if (Auth::attempt($login)) {
            $user = Auth::user();
            // dd($user);
            // $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
            $success['email'] =  $user->email;
            $success['id'] =  $user->id;
            $success['client_id'] =$user->client_id;
            $userlist=Clients::where('email', $user->email)->update(
                [
                   'last_login' => Carbon::now()->toDateTimeString(),
                   'ip_address' => $request->getClientIp()
                ]
            );
            /* $userlist=User::where('email', $user->email)->update(
                [
                    'last_login'=> date('Y-m-d H:i:s')
                ]
            ); */
                    
                return redirect('clientsprofile/'.$user->id)
                    ->with(['status'=>'Successfully Logged in as Client!']);
            // return $this->sendResponse($success, 'User login successfully.');
        } else {
            return redirect('login/clients')
                ->withError('Fail to login / Unauthorised Acccess')
                ->withInput();
        }
    }
    public function allclients()
    {
        $clients=Clients::all();
        $clients=ClientsResource::collection($clients);
        return response()->json(['success'=>true, 'data'=>$clients], 200);
    }
    
    public function userlist()
    {
        $users=User::where('role', '3')->get();
        return view('user.index')->with(
            ['users'=>UserResource::collection($users)]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients=Clients::all();
        return view('clients.index')->with(
            ['clients'=>ClientsResource::collection($clients)]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=Country::all();
        // $states=State::all();
        return view('clients.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //Form serialization used in Ajax form submission
            $input=$request->except('_token');
            $validator = Validator::make($input, Clients::$rules);
            if ($validator->fails()) {
                //Ajax method of form submission.
                return response()->json(['success'=> false, 'message'=>$validator->errors()], 201);
                            
                /* Normal Form Submission
                return redirect('clients/create')
                            ->withErrors($validator->errors())
                            ->withInput();*/
                /* API Method Submission
                return $this->sendError('Validation Error.',$validator->errors());
                */
            }
            $input['password']=Hash::make($input['password']);
            $Client = Clients::create($input);
        } catch (CustomException $exception) {
            return response()->json(
                [
                'success'=> false,
                'message'=>$exception->getMessage()],
                201
            );
            // report($exception);
            // return back()->withError($exception->getMessage())->withInput();
        }
        return response()->json(
            [
                'success'=> true,
                'message'=>'Client Account Created Successfully..'
            ],
            200
        );
                
        // return back()->with(['message'=>'Client Account Created Successfully..']);
        // return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Clients $clients
     * @return \Illuminate\Http\Response
     */
    public function show(Clients $client)
    {
        $clients       = $client;//Clients::find($id);
        // $country_name   = Country::find($users->country_id);
        $countryname   = $client->country;
        // $state_name     = State::find($users->state_id);
        $statename     = $client->states;

        // dd($clients, $countryname, $statename);
        return view('clients.show')->with(
            ['clients'     => $clients,
            'country'   => $countryname,
            'state'     => $statename
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Clients $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(Clients $clients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\Clients       $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clients $clients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Clients $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clients $clients)
    {
        //
    }
}
