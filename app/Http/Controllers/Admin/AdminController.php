<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
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

    function index()
    {
        Session::put('url.intended',URL::previous());
        return view('Auth.login');
    }

    function login(Request $request)
    {
        // return DB::select('select * from users');
        $data = [
            'phone' => $request->get('phone'),
            'password' => $request->get('password'),
        ];
        if (Auth::attempt($data)) {
            return response()->json([
                "status" => '200',
                "message" => 'Đăng nhập thành công'
            ]);
        } else {
            return response()->json([
                "status" => '500',
                "message" => 'Số điện thoại hoặc mật khẩu không chính xác'
            ]);
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    function checkphone(Request $request)
    {
        $user = DB::table('users')
                ->select('*')
                ->where('phone', '=', $request->get('phone'))->count();
        if($user === 0){
            return response()->json([
                "status" => '500',
                "message" => 'Số điện thoại không tồn tại'
            ]);
        }else{
            return response()->json([
                "status" => '200',
                "message" => $request->get('phone')
            ]);
        }
    }

    public function ChangePassphone(Request $request)
    {
        try{
            $user = DB::table('users')
            ->select('*')
            ->where('phone', '=', $request->get('sdt'))
            ->update(['password' => bcrypt($request->get('password_new'))]);

            return response()->json([
                "status" => '200',
                "message" => 'Cập nhật thành công '
            ]);
        }catch(Exception $e){
            return $e;
        }

    }
}
