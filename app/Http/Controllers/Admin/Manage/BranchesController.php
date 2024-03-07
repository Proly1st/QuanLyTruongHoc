<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Staff;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\Facades\DataTables;

class BranchesController extends Controller
{
    function index(){
        $active = 'manage.branches';
        return view('Admin.manage.branch.index', compact('active'));
    }

    function data(){
        // if(Redis::get(url()->full()) !== null)
        // {
        //     return json_decode(Redis::get(url()->full()), true);
        // }else{
            $School =  School::all()->toArray();
            $School_off = School::onlyTrashed()->get()->toArray();
            $dataTable = $this->drawTableBranch($School);
            $dataTable_off = $this->drawTableBranchOff($School_off);
                    // Redis::set(url()->full(), json_encode([$dataTable,'Đã Redis']));
            return [$dataTable,$dataTable_off,'Chưa Redis'];
        // }
    }

    function drawTableBranch($data){
        return DataTables::of($data)
                    ->addColumn('Name', function ($row) {
                        return $row['school_name'] . '<input class="d-none" value="' . $row['id'] . ' "/>';
                    })
                    ->addColumn('action', function ($row) {
                        return '<div class="btn-group">
                                <button type="button" class="btn btn-circle btn-outline-primary mr-5 mb-5" data-toggle="tooltip" title="Qrcode" data-id="' . $row['id'].'" data-address="' . $row['address'].'" data-branch="' . $row['school_name'].'" onclick="openModalQrcode('.$row['id'].')">
                                    <i class="fa fa-qrcode fa-1x"></i>
                                </button>
                                <button type="button" class="btn btn-circle btn-outline-warning mr-5 mb-5" data-toggle="tooltip" title="Cập nhật" onclick="openModalEditBranch('.$row['id'].')">
                                    <i class="si si-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5" data-toggle="tooltip" title="Trạng thái" onclick="changStatus(1,'.$row['id'].')">
                                    <i class="fa fa-close fa-1x"></i>
                                </button>
                            </div>';
                    })
                    ->rawColumns(['Name','action'])
                    ->addIndexColumn()
                    ->make(true);
    }

    function drawTableBranchOff($data){
        return DataTables::of($data)
                    ->addColumn('Name', function (   $row) {
                        return $row['school_name'] . '<input class="d-none" value="' . $row['id'] . ' "/>';
                    })
                    ->addColumn('action', function (   $row) {
                        return ' <div class="btn-group">
                                <button type="button" class="btn btn-circle btn-outline-success mr-5 mb-5" data-toggle="tooltip" title="Trạng thái" onclick="changStatus(0,'.$row['id'].')">
                                    <i class="fa fa-check fa-1x"></i>
                                </button>
                            </div>';
                    })
                    ->rawColumns(['Name','action'])
                    ->addIndexColumn()
                    ->make(true);
    }

    function create(Request $request){
        try{
                $branch = new School();
                $branch->school_name = $request->get('name');
                $branch->email = $request->get('email');
                $branch->phone = $request->get('phone');
                $branch->address = $request->get('address');
                $branch->lat = $request->get('local')[0]['lat'];
                $branch->lng = $request->get('local')[0]['lng'];
                $branch->save();
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
    function dataupdate(Request $request){
        $School = School::find($request->get('id'));
        return response()->json(['data' => $School]);
    }

    public function update(Request $request)
    {
        try{
            $School = School::findOrFail($request->get('id'));
            $School->school_name = $request->get('name');
            $School->email = $request->get('email');
            $School->phone = $request->get('phone');
            $School->address = $request->get('address');
            $School->save();
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
                $School = School::find($id)->delete();
                return response()->json(['success' => '200']);
            }else{
                $id = $request->get('id');
                $School = School::withTrashed()->find($id)->restore();
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

    function detail(Request $request)
    {
        $School = DB::table('school')->select('id')->where('id', $request->get('id'))->get();
        return $School;
    }

}
