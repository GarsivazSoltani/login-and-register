<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showForgetForm()
    {
        return view('auth.forget-password');
    }

    public function sendResetLink(Request $request)
    {
        // validate
        $this->validateForm($request);
        // create livk
        // send link
        $response = Password::broker()->sendResetLink($request->only('email'));
        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('resetLinkSent');
        }
        return back()->with('resetLinkFailed', true);
        // redirect
    }

    protected function validateForm($request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users']
        ]);
    }
}
