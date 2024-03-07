<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// API
Route::post('login', 'api\UserController@login');
Route::post('register', 'api\UserController@register');

Route::middleware(['auth:sanctum'])->group(function () {
    //  Lấy profile nhân viên
    Route::get('profile', 'api\UserController@getprofile');
    // Checkin
    Route::post('check-in', 'api\UserController@checkin');
    // CheckOut
    Route::post('check-out', 'api\UserController@checkout');
    // Get list check in
    Route::get('get-check-in', 'api\UserController@getCheckin');
    // Get list School

    Route::get('get-list-school', 'api\UserController@getListSchool');

    // Cout Timekeeping
    Route::get('cout-timekeeping', 'api\UserController@coutTimeKeeping');

    // Check Phone
    Route::post('check-phone', 'api\UserController@checkphone');

    Route::post('change-password', 'api\UserController@changPass');

    Route::post('change-profile', 'api\UserController@updateProfile');
    // logout
    Route::post('logout', 'api\UserController@logout');
});


