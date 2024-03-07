<?php

use Facade\FlareClient\View;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// AUTH

Route::get('login', 'Admin\AdminController@index')->name('login')->middleware('checklogin');
Route::post('post-login', 'Admin\AdminController@login')->name('post-login')->middleware('checklogin');
Route::get('forgot-password', 'Admin\manage\ForgotPasswordController@index')->name('forgot');
Route::get('change-password', 'Admin\manage\ForgotPasswordController@viewChangePass')->name('changePass');
Route::post('check-phone', 'Admin\AdminController@checkphone');
Route::post('post-change-password', 'Admin\AdminController@ChangePassphone');

Route::get('logout', 'Admin\AdminController@logout')->name('logout');

Route::get('/', 'Dashboard\HomeController@index')->name('Dashboard');

Route::group(['namespace' => 'Admin'], function () {
    // branch
    Route::get('branches', 'Manage\BranchesController@index')->name('get-branches');
    Route::get('branches-data', 'Manage\BranchesController@data');
    Route::post('create-branch', 'Manage\BranchesController@create');
    Route::get('branch-data-update', 'Manage\BranchesController@dataupdate');
    Route::post('edit-branch', 'Manage\BranchesController@update');
    Route::post('change-status', 'Manage\BranchesController@changestatus');
    Route::get('branch-detail', 'Manage\BranchesController@detail');

    // teacher
    Route::get('teacher', 'Manage\TeachersController@index')->name('get-teachres');
    Route::get('teacher-data', 'Manage\TeachersController@data');
    Route::get('branch-data', 'Manage\TeachersController@databranch');
    Route::post('create-teachers', 'Manage\TeachersController@create');
    Route::get('teacher-data-update', 'Manage\TeachersController@dataupdate');
    Route::post('edit-teachers', 'Manage\TeachersController@update');
    Route::post('change-status-teachers', 'Manage\TeachersController@changestatus');

    // employee
    Route::get('employee', 'Manage\EmployeeController@index')->name('get-employee');
    Route::get('employee-data', 'Manage\EmployeeController@data');
    Route::post('create-employee', 'Manage\EmployeeController@create');
    Route::get('employee-data-update', 'Manage\EmployeeController@dataupdate');
    Route::post('edit-employee', 'Manage\EmployeeController@update');
    Route::post('change-status-employee', 'Manage\EmployeeController@changestatus');
    Route::get('profile', 'Manage\EmployeeController@profile')->name('profile');
    Route::post('change-profile', 'Manage\EmployeeController@changeprofile');
    Route::post('change-password', 'Manage\EmployeeController@changepassword');

    // TimeKeeping
    Route::get('time-keeping', 'Manage\TimeKeepingController@index')->name('get-timekeeping');
    Route::get('time-keeping-data', 'Manage\TimeKeepingController@data');
    Route::get('timekeeping-data-update', 'Manage\TimeKeepingController@dataupdate');
    Route::post('edit-timekeeping', 'Manage\TimeKeepingController@update');
    Route::get('export-excel', 'Manage\TimeKeepingController@export')->name('excel');

    // Layout Api
    Route::get('api', 'ApiController@index')->name('api');

});

Auth::routes();
