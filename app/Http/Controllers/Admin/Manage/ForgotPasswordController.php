<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ForgotPasswordController extends Controller
{
    //
    use AuthenticatesUsers;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            try {
                session_start();
            } catch (\ErrorException $e) {

            }
        }
        $this->middleware('guest')->except('logout');
    }
    function index(Request $request)
    {
        return view('Auth.forgot_password');
    }

    function viewChangePass(Request $request)
    {
        return view('Auth.change_password');
    }
}
