<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    //Security reason throttle
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 1; // Default is 1

    //Multiple User Role based Login To dashboard
    public function redirectTo()
    {
        switch (Auth::user()->role) {
            case 1:
                $this->redirectTo= '/admin';
                return $this->redirectTo;
                break;
            case 2:
                $this->redirectTo= '/clientsprofile/'.Auth::user()->id;
                return $this->redirectTo;
                break;
            case 3:
                $this->redirectTo= '/userprofile/'.Auth::user()->id;
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo= '/login';
                return $this->redirectTo;
                break;
        }
    }
    
    protected function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login' => Carbon::now()->toDateTimeString(),
            'ip_address' => $request->getClientIp()
        ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
