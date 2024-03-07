<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffJobBranch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\Facades\DataTables;

use function GuzzleHttp\json_decode;

class TeachersController extends Controller
{
    function index(){
        $active = 'manage.teacher';
        return view('Admin.manage.teachers.index', compact('active'));
    }
    function data(){
        // if(Redis::get(url()->full()) !== null)
        // {
        //     return json_decode(Redis::get(url()->full()), true);
        // }else{
            $user =  Staff::all()->where('status','=','1')->toArray();
            $user_off =  Staff::all()->where('status','=','0')->toArray();

            $dataTable = DataTables::of($user)
                    ->addColumn('name', function (   $row) {
                        return $row['name'] . '<input class="d-none" value="' . $row['id'] . ' "/>';
                    })
                    ->addColumn('action', function (   $row) {
                        return ' <div class="btn-group">
                                <button type="button" class="btn btn-circle btn-outline-warning mr-5 mb-5" data-toggle="tooltip" title="Cập nhật" onclick="openModalEditTeachres('.$row['id'].')">
                                    <i class="si si-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5" data-toggle="tooltip" title="Trạng thái" onclick="changStatus(1,'.$row['id'].')">
                                    <i class="fa fa-close fa-1x"></i>
                                </button>
                            </div>';
                    })
                    ->rawColumns(['name','action'])
                    ->addIndexColumn()
                    ->make(true);
            $dataTable_off = DataTables::of($user_off)
                    ->addColumn('name', function (   $row) {
                        return $row['name'] . '<input class="d-none" value="' . $row['id'] . ' "/>';
                    })
                    ->addColumn('action', function ($row) {
                        return ' <div class="btn-group">
                                <button type="button" class="btn btn-circle btn-outline-success mr-5 mb-5" data-toggle="tooltip" title="Trạng thái" onclick="changStatus(0,'.$row['id'].')">
                                    <i class="fa fa-check fa-1x"></i>
                                </button>
                                </div>';
                    })
                    ->rawColumns(['name','action'])
                    ->addIndexColumn()
                    ->make(true);
                    // Redis::set(url()->full(), json_encode([$dataTable,'Đã Redis']));
            return [$dataTable,$dataTable_off,'Chưa Redis'];
        // }
    }


    function databranch()
    {
        $select = '<option value="" disabled >Vui lòng chọn trường</option>';
        $branch =DB::select('select * from school ');

        foreach($branch as $item){
            $select .= '<option value="'. $item->id .'">'. $item->school_name .'</option>';
        }
        return $select;
    }

    function create(Request $request)
    {
        $school = $request->get('branch');
        try{
            if(Staff::where('phone',$request->get('phone'))->exists()){
                return response()->json(['success' => '500','error' => 'Số điện thoại đã tồn tại']);
            }else{
                $password = mt_rand(100000, 999999);
                $teacher = new Staff;
                $teacher->name = $request->get('name');
                $teacher->email = $request->get('email');
                $teacher->password = base64_encode($password);
                $teacher->phone = $request->get('phone');
                $teacher->address = $request->get('address');
                $teacher->save();
                for($i = 0 ; $i < count($school); $i++)
                {
                    $teacher_branch = new StaffJobBranch;
                    $teacher_branch->staff_id = $teacher->id;
                    $teacher_branch->school_id = $school[$i];
                    $teacher_branch->save();
                }

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
        $user = Staff::find($request->get('id'));
        $select = '<option value="" disabled>Vui lòng chọn chi nhánh</option>';
        $branch = DB::select('select id as school_id, school_name  from school');
        $branch_data =  DB::select("SELECT DISTINCT school_id,school_name FROM school, Staff_job_branch WHERE school.id  = Staff_job_branch.school_id AND Staff_job_branch.status = 1 AND staff_id = ? " , [$user->id]);
        // Not select
        $data = (array_udiff($branch, $branch_data, function ($obj_a, $obj_b) {
            return $obj_a->school_id - $obj_b->school_id;
        }));
        $select = '';
        foreach($data as $item){
            $select .= '<option value="'. $item->school_id .'">'. $item->school_name .'</option>';
        }
        foreach($branch_data as $item){
            $select .= '<option value="'. $item->school_id .'" selected>'. $item->school_name .'</option>';
        }

        return response()->json(['data' => $user, 'branch' => $select]);
    }

    public function update(Request $request)
    {
        // try{
            $user = Staff::findOrFail($request->get('id'));
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->phone = $request->get('phone');
            $user->address = $request->get('address');
            DB::table('Staff_job_branch')
            ->where('staff_id', $request->get('id'))
            ->update(['status' => 0]);
            foreach($request->get('branch') as $item ){
                $data = DB::table('Staff_job_branch')
                        ->where('school_id', $item)
                        ->where('staff_id', $request->get('id'))
                        ->get();
                if($data->toArray() === []){
                    $teacher_branch = new StaffJobBranch;
                    $teacher_branch->staff_id = $request->get('id');
                    $teacher_branch->school_id = $item;
                    $teacher_branch->save();
                }
                else{
                    foreach($data as $item_data){
                        if($item_data->school_id == $item ){
                            DB::table('Staff_job_branch')
                            ->where('school_id', '=' , $item)
                            ->where('staff_id', $request->get('id'))
                            ->update(['status' => 1]);
                        }
                    }

                }
            }
            $user->save();
            return response()->json(['success' => '200']);
        // } catch (Exception $e) {
        //     $error = [
        //         "status" => 500,
        //         "message" =>  $e->getMessage(),
        //         'Line' => $e->getLine(),
        //     ];
        //     return $error;
        // }
    }

    function changestatus(Request $request)
    {
        try{
            if($request->get('status') === '1'){
                $id = $request->get('id');
                $user = Staff::find($id);
                $user->status = '0';
                $user->save();
                return response()->json(['success' => '200']);
            }else{
                $id = $request->get('id');
                $user = Staff::find($id);
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
}
