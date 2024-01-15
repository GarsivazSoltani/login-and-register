<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // use AuthenticatesUsers;
    use ThrottlesLogins;
    // protected $maxAttempts = 5;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // validation
        $this->validateForm($request);


        if ($this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        // check user and password
        if ($this->attemptLogin($request)) {
            return $this->sendSuccessResponse();
        }

        $this->incrementLoginAttempts($request);
        return $this->sendLoginFaileResponse();
    }

    protected function sendSuccessResponse()
    {
        session()->regenerate();
        return redirect()->intended();
    }

    protected function sendLoginFaileResponse()
    {
        return back()->with('wrongCredentials', true);
    }

    protected function validateForm(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required']
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        return Auth::attempt($request->only('email', 'password'), $request->filled('remember'));
    }

    public function logout()
    {
        session()->invalidate();
        Auth::logout();
        return redirect()->route('home');
    }

    protected function userName()
    {
        return 'email';
    }
}
