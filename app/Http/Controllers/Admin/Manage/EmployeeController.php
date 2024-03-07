<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    function index(){
        $active = 'manage.employee';
        return view('Admin.manage.employee.index', compact('active'));
    }

    function data(Request $request){
            $user =  DB::select('select * from users where status = 1');
            $user_off =  DB::select('select * from users where status = 0');
            $data_off_employee = DataTables::of($user_off)
                    ->addColumn('Name', function ($row) {
                        return $row->Name . '<input class="d-none" value="' . $row->id . ' "/>';
                    })
                    ->addColumn('action', function ($row) {
                        return ' <div class="btn-group">
                                <button type="button" class="btn btn-circle btn-outline-success mr-5 mb-5" data-toggle="tooltip" title="Trạng thái" onclick="changStatus(0,'.$row->id.')">
                                    <i class="fa fa-check fa-1x"></i>
                                </button>
                                </div>';
                    })
                    ->rawColumns(['Name','action'])
                    ->addIndexColumn()
                    ->make(true);
            $dataTable = DataTables::of($user)
                    ->addColumn('Name', function ($row) {
                        return $row->Name . '<input class="d-none" value="' . $row->id . ' "/>';
                    })
                    ->addColumn('action', function ($row) {
                        if($row->admin != 1){
                            $data = ' <div class="btn-group">
                                <button type="button" class="btn btn-circle btn-outline-warning mr-5 mb-5" data-toggle="tooltip" title="Cập nhật" onclick="openModalEditEmployee('.$row->id.')">
                                    <i class="si si-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5" data-toggle="tooltip" title="Trạng thái" onclick="changStatus(1,'.$row->id.')">
                                <i class="fa fa-close fa-1x"></i>
                                </button>
                            </div>';
                        }else{
                            $data = '<span class="badge badge-danger">Admin</span>';
                        }
                        return $data;
                    })
                    ->rawColumns(['Name','action'])
                    ->addIndexColumn()
                    ->make(true);
            return [$dataTable,$data_off_employee,'Chưa Redis'];
    }

    function create(Request $request)
    {
        try{
            if(User::where('phone',$request->get('phone'))->exists()){
                return response()->json(['success' => '500','error' => 'Số điện thoại đã tồn tại']);
            }else{
                $password = mt_rand(100000, 999999);
                $employee = new User();
                $employee->school_id = '1';
                $employee->name = $request->get('name');
                $employee->username = $request->get('email');
                $employee->password = bcrypt($password);
                $employee->phone = $request->get('phone');
                $employee->address = $request->get('address');
                $employee->save();
                return response()->json(['success' => '200', 'phone' => $request->get('phone'), 'password' => $password]);
            }

        } catch (Exception $e) {
            $error = [
                "status" => 500,
                "message" =>  $e->getMessage(),
                'Line' => $e->getLine(),
            ];
            return $error;
        }
    }

    public function dataupdate(Request $request)
    {
        $user = User::find($request->get('id'));
        $select = '<option value="" disabled>Vui lòng chọn chi nhánh</option>';
        $branch = DB::select('select * from school');
        foreach($branch as $item){
            if($item->id === $user->school_id){
                $select .= '<option value="'. $item->id .'" selected>'. $item->school_name .'</option>';
            }else{
                $select .= '<option value="'. $item->id .'">'. $item->school_name .'</option>';
            }

        }
        return response()->json(['data' => $user, 'branch' => $select]);
    }

    public function update(Request $request)
    {
        try{
            $user = User::findOrFail($request->get('id'));
            $user->school_id = 1;
            $user->Name = $request->get('name');
            $user->username = $request->get('email');
            $user->phone = $request->get('phone');
            $user->address = $request->get('address');
            $user->save();
            return response()->json(['success' => '200']);
        } catch (Exception $e) {
            $error = [
                "status" => 500,
                "message" =>  $e->getMessage(),
                'Line' => $e->getLine(),
            ];
            return $error;
        }
    }

    function changestatus(Request $request)
    {
        try{
            if($request->get('status') === '1'){
                $id = $request->get('id');
                $user = User::find($id);
                $user->status = '0';
                $user->save();
                return response()->json(['success' => '200']);
            }else{
                $id = $request->get('id');
                $user = User::find($id);
                $user->status = '1';
                $user->save();
                return response()->json(['success' => '200']);
            }

        }catch(Exception $e){
            $error = [
                "status" => 500,
                "message" =>  $e->getMessage(),
                'Line' => $e->getLine(),
            ];
            return $error;
        }
    }

    function profile()
    {
        $data = Auth::user();
        return view('Admin.manage.employee.profile',compact('data',$data));
    }

    public function changeprofile(Request $request)
    {
        try{
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->Name = $request->get('name');
            $user->phone = $request->get('phone');
            $user->username = $request->get('email');
            $user->address = $request->get('address');
            $user->save();
            return response()->json(['success' => '200']);
        } catch (Exception $e) {
            $error = [
                "status" => 500,
                "message" =>  $e->getMessage(),
                'Line' => $e->getLine(),
            ];
            return $error;
        }

    }

    public function changepassword(Request $request)
    {
        try{
            $id = Auth::user()->id;
            $user = User::find($id);
            if (Hash::check($request->get('password'),  $user->password)) {
                if($request->get('password_new') === $request->get('re_password_new')){
                    $user->password = bcrypt($request->get('password_new'));
                    $user->save();
                    Auth::logout();
                    return response()->json(['success' => '200']);
                }else{
                    return response()->json(['success' => '500','error' => 'Xác nhận mật khẩu không chính xác']);
                }
            }else{
                return response()->json(['success' => '500','error' => 'Mật khẩu không chính xác']);
            }
        } catch (Exception $e) {
            $error = [
                "status" => 500,
                "message" =>  $e->getMessage(),
                'Line' => $e->getLine(),
            ];
            return $error;
        }
    }
}


