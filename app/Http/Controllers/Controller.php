<?php

namespace App\Http\Controllers;

use App\Models\quyen;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


        // $id_fun   = 1;
        // $login  = Auth::guard('thienduc')->user();
        // $list_quyen = quyen::find($login->id_quyen)->list_id_quyen;
        // $arr_quyen  = explode(",", $list_quyen);
        // if(!in_array($id_fun, $arr_quyen)){

        //     //get dùng link này
        //     toastr()->error('Bạn Không Đủ Quyền Truy Cập');
        //     return redirect('/');

        //     //post dùng link này
        //     return response()->json([
        //         'status'    => 0,
        //         'message'   => 'Đã tạo tài khoản thành công!'
        //     ]);
        // }

    public function checkquyen($id_fun)
    {
        $login  = Auth::guard('thienduc')->user();
        $list_quyen = quyen::find($login->id_quyen)->list_id_quyen;
        $arr_quyen  = explode(",", $list_quyen);
        if(!in_array($id_fun, $arr_quyen)){
            return true;
        } else{
            return  false;
        }
    }
    //get dùng link này
    // $x      = $this -> checkquyen(1);
    // if($x){
    //     toastr()->error('Bạn Không Đủ Quyền Truy Cập');
    //     return redirect('/');
    // }

    // //post dùng link này
    // $x      = $this -> checkquyen(1);
    // if($x){
    // return response()->json([
    //     'status'    => 0,
    //     'message'   => 'Đã tạo tài khoản thành công!'
    // ]);




}
