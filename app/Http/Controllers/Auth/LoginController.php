<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getUser(){
        return $request->user();
    }

    public function home() {
        return redirect('/auctions/2');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/home');
      }

    // /**
    //  * Get the failed login response instance.
    //  *
    //  * @param \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // protected function sendFailedLoginResponse(Request $request)
    // {
    //     return redirect()->route('login')
    //         ->withInput($request->only($this->username(), 'remember'))
    //         ->withErrors([
    //             $this->username() => Illuminate\Support\Facades\Lang::get('auth.failed'),
    //         ]);
    // }
}
