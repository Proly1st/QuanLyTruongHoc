<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Staff;
use App\Models\StaffJobBranch;
use App\Models\TimeKeeping;
use App\User;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class UserController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->middleware('checkApi');

    }
    public $successStatus = 200;

    public function login(Request $request)
    {
        try {
            $user = Staff::where('phone', '=', $request->get('phone'))->first();

            if (!$user) {
                return $this->sendError([],'Tài khoản không hợp lệ','500');
            }
            if ($user->status === 0){
                return $this->sendError([],'Tài khoản của bạn đã bị khoá','500');
            }
            if ($user->password != $request->password) {
                return response()->json(['success'=> 500, 'message' => 'Mật khẩu không chính xác']);
            }else{
                $token = $user->createToken('token')->plainTextToken;
                $data = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email'=> $user['email'],
                    'phone'=> $user['phone'],
                    'address' => $user['address'],
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ];
                return $this->sendResponse($data,'success');
            }
        } catch (\Throwable $th) {
            return $this->sendError( $th ,'error','500');
        }
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['loyout','201']);
    }
    // Lấy thông tin nhân viên
    public function getprofile(Request $request)
    {
        try {
            $user = Auth::user();
            $user = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email'=> $user['email'],
                'phone'=> $user['phone'],
                'address' => $user['address']
            ];
            return $this->sendResponse($user,'success');
        } catch (\Throwable $th) {
            return $this->sendError( $th,'','500');
        }

    }

    public function checkin(Request $request)
    {
//        DB::table('timekeeping')->delete();
//        return false;
        try {
            $date = getdate();
            $data = DB::select("SELECT * FROM timekeeping WHERE school_id = " .$request->get('school_id') . " and staff_id = ". Auth::user()->id ." AND date = CAST(CURRENT_TIMESTAMP AS DATE)");
            $user = StaffJobBranch::where('school_id', '=' , $request->get('school_id'))->where('staff_id','=', Auth::user()->id)->first();
            $user_check_out = DB::select('SELECT school_name FROM school ,timekeeping WHERE date = CAST(CURRENT_TIMESTAMP AS DATE) AND school.id = timekeeping.school_id and date_out = 0 and staff_id = ' . Auth::user()->id);
            if( $user_check_out == [])
                if($data !== []){
                    return response()->json([
                        "status" => 205,
                        "message" => 'Bạn đã check in',
                        "data" => [],
                    ]);
                }else{
                    if($user !== null){
                        $timeKeeping = new TimeKeeping;
                        $timeKeeping->staff_id = Auth::user()->id;
                        $timeKeeping->staff_name = Auth::user()->name;
                        $timeKeeping->school_id = $request->get('school_id');
                        $timeKeeping->address = $request->get('address');
                        $timeKeeping->date_in = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s');
                        $timeKeeping->date_out = "0";
                        $timeKeeping->time = "0";
                        $timeKeeping->date = $date['year'] . "/" . $date['mon'] . "/". $date['mday'];
                        // if($this->checkDistance($request->get('school_id'),$request->get('lat'),$request->get('lng'))){
                        //     $timeKeeping->save();
                        //     return $this->sendResponse([],'Check in thành công');
                        // }
//                         if($this->checkDistance($request->get('school_id'),'10.8202189','106.6916772')){
                            $timeKeeping->save();
                            return $this->sendResponse([],'Check in thành công');
//                        }
//                        else{
//                            return $this->sendError( [],'Check in ở khu vực không hợp hệ','500');
//                        }
                    }else{
                        return $this->sendError( [],'Bạn không có phân công dạy trường này','500');
                    }
                }
            else{
                return $this->sendError( [],'Bạn chưa check out tại trường '. $user_check_out[0]->school_name ,'400');
            }
        } catch (\Throwable $th) {
            return $this->sendError( $th,'error','500');
        }
    }

    public function checkout(Request $request)
    {
        $data = TimeKeeping::where('staff_id','=', Auth::user()->id)
                            ->where('school_id','=',$request->get('school_id'))
                            ->where('date', '=', Carbon::today()->format('Y-m-d'))
                            ->first();
        $user = StaffJobBranch::where('school_id', '=' , $request->get('school_id'))->where('staff_id','=',Auth::user()->id)->first();
        $branch = School::find($request->get('school_id'));
        if($data === null){
            return $this->sendError( [],'Bạn chưa check in !!!','500');
        }else{
            if($user !== null){
                if((int)$data->date_out == "0"){
                    $data->staff_id = Auth::user()->id;
                    $data->staff_name = Auth::user()->name;
                    $data->school_id = $request->get('school_id');
                    $data->date_out = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s');
                    $data->working_session_minutes = $request->get('working_session_minutes');
                    $time = explode(':', date('H:i:s',strtotime($data->date_out) - strtotime($data->date_in)));
                    $sumTime = 0;
                    for($i = 0 ; $i < count($time); $i++){
                        $sumTime = ((int)$time[0] * 60)  + (int)$time[1];
                    }
                    $data->time = $sumTime;
                    $data->signature = $request->get('signature');
                    // if($this->checkDistance($request->get('school_id'),$request->get('lat'),$request->get('lng'))){
                        $data->save();
                        return $this->sendResponse($branch,'Check out thành công');
                    // }
                    // else{
                    //     return $this->sendError( [],'Check out ở khu vực không hợp lệ','500');

                    // }
                }
                else{
                    return $this->sendError( [],'Bạn đã check out rồi !!!','205');
                }
            }else{
                return $this->sendError( [],'Bạn không có phân công dạy trường này','405');
            }
        }
    }

    public function getListSchool(Request $request){
        // try {
            $data = [];
            $school = DB::table('Staff_job_branch')->distinct('id')
                        ->select('school.id', 'school.school_name', 'school.address', 'Staff_job_branch.staff_id')
                        ->join('school','Staff_job_branch.school_id','school.id')
                        ->where('Staff_job_branch.staff_id', '=' , Auth::user()->id)->get();

            for($i = 0 ; $i < count($school); $i++){
                $school[$i]->total_timekeeping = $cout = DB::table('timekeeping')
                                                        ->select('school_id')
                                                        ->where('school_id' , '=' ,$school[$i]->id)
                                                        ->where('staff_id','=', Auth::user()->id)
                                                        ->count();
            }
            // $time = DB::table('timekeeping')->distinct('staff_id')
            // ->select(DB::raw('staff_id, staff_name,branch_name,phone,count(staff_id) as periods'))
            // ->join('school','timekeeping.school_id','=','school.id')
            // ->join('Staff_job_branch','school.id','=','Staff_job_branch.sco')
            // // ->where('date_out', '!=' , '0')
            // ->where('staff_id','=', Auth::user()->id)
            // ->whereRaw("DATE_FORMAT(date, '%Y-%m') = DATE_FORMAT(NOW(), '%Y-%m')")
            // ->groupBy('staff_id','staff_name','branch_name','phone')
            // ->get();
            return $this->sendResponse($school, 'success');
        // } catch (\Throwable $th) {
        //     return $this->sendError( $th,'','500');
        // }

    }

    public function getCheckin(Request $request)
    {
        // try {
            $type = $request->get('type');
            $data = '';
            switch ($type) {
                case '-1':
                    $data = DB::select("select * from timekeeping where staff_id = " . Auth::user()->id );
                    foreach($data as $item){
                        if ($item->working_session_minutes === null) $item->working_session_minutes = 0;
                        if((int)$item->date_out == 0)
                        {
                            $item->is_checkout = 0;
                        }
                        else{
                            $item->is_checkout = 1;
                        }

                    }
                    break;
                case '0':
                    $data = DB::select("SELECT * FROM timekeeping WHERE staff_id = " .Auth::user()->id . " AND DATE_FORMAT(date,'%Y-%m') = '".$request->get('time')."' ORDER BY date_out != 0 DESC ");
                    foreach($data as $item){
                        if ($item->working_session_minutes === null) $item->working_session_minutes = 0;
                        if((int)$item->date_out == 0)
                        {
                            $item->is_checkout = 0;
                        }
                        else{
                            $item->is_checkout = 1;
                        }
                    }
                    break;
                case '1':
                    $data = DB::select("SELECT * FROM timekeeping WHERE staff_id = " .Auth::user()->id . " AND DATE_FORMAT(date,'%Y-%m-%d') = '".$request->get('time')."'");
                    foreach($data as $item){
                        if ($item->working_session_minutes === null) $item->working_session_minutes = 0;
                        if((int)$item->date_out == 0)
                        {
                            $item->is_checkout = 0;
                        }
                        else{
                            $item->is_checkout = 1;
                        }
                    }
                    break;
                default:
                    # code...
                    break;
            }
            return $this->sendResponse($data, 'success');
        // } catch (\Throwable $th) {
        //     return $this->sendError( $th,'','500');
        // }
    }

    public function checkDistance($id, $lat , $lng)
    {
        $branch = School::find($id);
        $theta    = (float)$branch->lng - (float)$lng;
        $dist    = sin(deg2rad((float)$branch->lat)) * sin(deg2rad((float)$lat)) +  cos(deg2rad((float)$branch->lat)) * cos(deg2rad((float)$lat)) * cos(deg2rad((float)$theta));
        $dist    = acos($dist);
        $dist    = rad2deg($dist);
        $miles    = (float)$dist * 60 * 1.1515;
        if(round((float)$miles * 1609.344, 2) > 200){
            return false;
        }
        return true;
    }

    public function coutTimeKeeping(Request $request)
    {
        try {
            $cout_staff = DB::table('timekeeping')
                ->select('staff_id')
                ->where('staff_id','=', Auth::user()->id)
                ->whereRaw("DATE_FORMAT(date, '%Y-%m') = DATE_FORMAT(NOW(), '%Y-%m')")->count();
            $cout_school = DB::table('Staff_job_branch')
            ->select('staff_id')
            ->where('staff_id','=', Auth::user()->id)->count();
            $data = [
                "total_school" => $cout_school,
                "total_timekeeping" => $cout_staff
            ];
            return $this->sendResponse($data, 'success');
        } catch (\Throwable $th) {
            return $this->sendError( $th,'','500');
        }
    }

    public function checkphone(Request $request)
    {
        $user = DB::table('staff')
                ->select('*')
                ->where('phone', '=' , $request->get('phone'))->first();
        if($user != null)
            return $this->sendResponse([],'success');
        else
            return $this->sendError( [],'Số điện thoại không hợp lệ','500');
    }

    public function changPass(Request $request)
    {
        $user = Staff::find(Auth::user()->id);
        if($request->get('old_password') === $user->password){
            if ($request->get('password') === $request->get('password_confirmation')) {
                $user->password = $request->get('password');
                $user->save();
                return $this->sendResponse( [],'Đổi mật khẩu thành công','200');

            }
            else{
                return $this->sendError( [],'Xác nhận mật khẩu mới trong trùng nhau','500');
            }
        }else{
            return $this->sendError( [],'Mật khẩu cũ không đúng','500');
        }

    }

    public function updateProfile(Request $request)
    {
        try {
            $user = Staff::find(Auth::user()->id);
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->address = $request->get('address');
            $user->save();

            return $this->sendResponse( [],'Cập nhật thành công','200');
        } catch (\Throwable $th) {
            return $this->sendError( $th,'','500');
        }
    }
}
