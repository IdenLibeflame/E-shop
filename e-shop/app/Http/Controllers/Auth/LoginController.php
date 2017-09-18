<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

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
     * @return \Illuminate\Http\RedirectResponse
     */
    protected $redirectTo = '/';

//    protected function redirectTo()
//    {
//        return redirect(session()->pull('from',$this->redirectTo));
//    }
//
//    protected function authenticated(Request $request, $user)
//    {
//        dd($request->url());
//
//        return redirect()->back();
//    }

//    public function authenticate()
//    {
//        if (Auth::attempt(['email' => $email, 'password' => $password])) {
//            // Аутентификация успешна...
//            return redirect()->intended();
//        }
//    }

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
