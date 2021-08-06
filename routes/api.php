<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CitiesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);
    
    // User Management api
    Route::prefix('users')->group(function ()
    {
        Route::get('/', [UserController::class, 'getAllUsers']);
        Route::post('/', [UserController::class, 'createUser']);
    });
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
});

Route::get('country/getdata', 'App\Http\Controllers\CountryController@index');
Route::post('country/create', 'App\Http\Controllers\CountryController@store');
Route::post('country/update/{id}', 'App\Http\Controllers\CountryController@update');
Route::post('country/delete/{id}', 'App\Http\Controllers\CountryController@destroy');
Route::get('country/filterdata/{data}', 'App\Http\Controllers\CountryController@filterdata');

Route::get('state/getdata', 'App\Http\Controllers\StateController@index');
Route::post('state/create', 'App\Http\Controllers\StateController@store');
Route::post('state/update/{id}', 'App\Http\Controllers\StateController@update');
Route::post('state/delete/{id}', 'App\Http\Controllers\StateController@destroy');
Route::post('state/filterdata', 'App\Http\Controllers\StateController@filterdata');

Route::get('city/getdata', 'App\Http\Controllers\CitiesController@index');
Route::post('city/create', 'App\Http\Controllers\CitiesController@store');
Route::post('city/update/{id}', 'App\Http\Controllers\CitiesController@update');
Route::post('city/delete/{id}', 'App\Http\Controllers\CitiesController@destroy');
Route::post('city/filterdata', 'App\Http\Controllers\CitiesController@filterdata');