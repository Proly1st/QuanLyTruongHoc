<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Exports\TimeKeepingExport;
use App\Http\Controllers\Controller;
use App\Models\TimeKeeping;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class TimeKeepingController extends Controller
{
    //
    public function index()
    {
        $active = 'manage.timekeeping';
        return view('Admin.manage.timekeeping.index', compact('active'));
    }

    function data(Request $request){
        if(Redis::get(url()->full()) !== null)
        {
            return json_decode(Redis::get(url()->full()), true);
        }else{
            $timekeep =  TimeKeeping::all()->toArray();
            $dataTable = DataTables::of($timekeep)
                    ->addColumn('staff_name', function (   $row) {
                        return $row['staff_name'] . '<input class="d-none" value="' . $row['id'] . ' "/>';
                    })
                    ->addColumn('signature', function (   $row) {
                        return '<img class="img-avatar" src="data:image/webp;base64,'.$row['signature'].'" value="'. $row['id'].'" alt="">';
                    })
                    ->addColumn('action', function (   $row) {
                        return ' <div class="btn-group">
                                <button type="button" class="btn btn-circle btn-outline-warning mr-5 mb-5" data-toggle="tooltip" title="Cập nhật" onclick="openModalEditTimeKeeping('.$row['id'].')">
                                    <i class="si si-pencil"></i>
                                </button>
                            </div>';
                    })
                    ->rawColumns(['staff_name','action','signature'])
                    ->addIndexColumn()
                    ->make(true);
                    // Redis::set(url()->full(), json_encode([$dataTable,'Đã Redis']));
            return [$dataTable,'Chưa Redis'];
        }
    }

    function dataupdate(Request $request)
    {

        $time = TimeKeeping::find($request->get('id'));
        return response()->json(['data' => $time]);

    }

    public function update(Request $request)
    {
        try{
            $time = TimeKeeping::findOrFail($request->get('id'));
            $time->date_in = $request->get('time_in');
            $time->date_out = $request->get('time_out');
            $time->save();
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

    public function export()
    {

        return Excel::download(new TimeKeepingExport, 'timekeeping.xlsx');
    }
}
