<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    // $url = URL::temporarySignedRoute('test', now()->addMinutes(60), ['id' => 20, 'email' => 'garsi.soltani@gmail.com']);
    // dd($url);
})->name('home');

Route::prefix('auth')->group(function (){
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('auth.register.form');
    Route::post('register', [RegisterController::class, 'register'])->name('auth.register');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('auth.login.form');
    Route::post('login', [LoginController::class, 'login'])->name('auth.login');
    Route::get('logout', [LoginController::class, 'logout'])->name('auth.logout');
    Route::get('email/send-verification', [VerificationController::class, 'send'])->name('auth.email.send.verification');
});

Route::get('logout', function(){
    Auth::logout();
});

// Route::get('verify', function(Request $request){
//     // return 'hello garsi';
//     Url::hasValidSignature($request);
// })->name('test');