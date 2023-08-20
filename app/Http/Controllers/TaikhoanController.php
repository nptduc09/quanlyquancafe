<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\ChangePassWordAdminRequest;
use App\Http\Requests\admin\CreateAdminRequest;
use App\Http\Requests\admin\UpdateAdminRequest;
use App\Http\Requests\taikhoan\ChangePassWordTaikhoanRequest;
use App\Http\Requests\taikhoan\CreateTaikhoanRequest;
use App\Http\Requests\taikhoan\UpdateTaikhoanRequest;
use App\Mail\quenmatkhau;
use App\Models\quyen;
use App\Models\taikhoan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TaiKhoanController extends Controller
{
    //tài khoản
    public function index()
    {

        $x      = $this -> checkquyen(1);
        if($x){
            toastr()->error('Bạn Không Đủ Quyền Truy Cập');
            return redirect('/admin/ban-hang');
        }

        $quyen = quyen::get();
        return view('admin.page.taikhoan.index', compact('quyen'));
    }
    //getdata
    public function getData()
    {
        $data = taikhoan::leftjoin('quyens', 'taikhoans.id_quyen', 'quyens.id')
                        ->select('taikhoans.*', 'quyens.ten_quyen')
                        ->get();
        return response()->json([
            'data'      => $data,
        ]);
    }
    //nhap
    public function nhap(CreateTaikhoanRequest $request)
    {

        $x      = $this -> checkquyen(2);
        if($x){
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn Không Đủ Quyền Để Thêm Mới Tài Khoản!'
            ]);
        }

        $data = $request->all();
        $data['password'] =  bcrypt($request->password);
        taikhoan::create($data);
        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo tài khoản thành công!'
        ]);
    }
    //xóa
    public function xoa(Request $request)
    {
        $x      = $this -> checkquyen(5);
        if($x){
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn Không Đủ Quyền Để Xóa!'
            ]);
        }

        $taikhoan = taikhoan::where('id', $request->id)->first();
        $taikhoan->delete();
        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa thành công!',
        ]);
    }
    //cập nhập
    public function capnhap(UpdateTaikhoanRequest $request)
    {

        $x      = $this -> checkquyen(4);
        if($x){
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn Không Đủ Quyền Để Cập Nhập!'
            ]);
        }


        $data    = $request->all();
        $taikhoan = taikhoan::find($request->id);
        $taikhoan->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật thành công!',
        ]);
    }
    //đổi mật khẩu
    public function changePassword(ChangePassWordTaikhoanRequest $request)
    {

        $x      = $this -> checkquyen(3);
        if($x){
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn Không Đủ Quyền Để Đổi Mật Khẩu!'
            ]);
        }

        $data = $request->all();
        if(isset($request->password)){
            $taikhoan = taikhoan::find($request->id);
            $data['password'] = bcrypt($data['mat_khau_moi']);
            $taikhoan->password  = $data['password'];
            $taikhoan->save();
        }
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã cập nhật mật khẩu thành công!',
        ]);
    }



    // đăng nhập
    public function viewLogin()
    {
        $check = Auth::guard('thienduc')->check();
        if($check) {
            return redirect('/admin/ban-hang');
        } else {
            return view('admin.page.login');
        }
        // return view('admin.page.login');
    }
    public function actionLogin(Request $request)
    {
        // dd($request->all());

        $check =  Auth::guard('thienduc')->attempt(['email'  => $request->email, 'password' => $request->password]);
        if($check) {
            toastr()->success("Đã đăng nhập thành công!");
            return redirect('/admin/ban-hang');
        } else {
            toastr()->error("Tài khoản hoặc mật khẩu không đúng!");
            return redirect('/login');
        }
    }
    public function actionLogout()
    {
        Auth::guard('thienduc')->logout();
        toastr()->error("Tài khoản đã đăng xuất!");
        return redirect('/login');
    }


    //quên mật khẩu
    public function viewforgotpass()
    {
        return view('admin.page.forgotpassword');
    }
    public function actionforgotpass(Request $request)
    {
        $taiKhoan   = taikhoan::where('email', $request->email)->first();
        if($taiKhoan) {
            $now    = Carbon::now();
            $time   = $now->diffInMinutes($taiKhoan->updated_at);
            if(!$taiKhoan->hash_reset || $time > 0) {
                $taiKhoan->hash_reset = Str::uuid();  //chuổi romdum
                $taiKhoan->save();

                $link    = env('APP_URL') . '/admin/update-password/' . $taiKhoan->hash_reset;

                mail::to($taiKhoan->email)->send(new quenmatkhau($link));
            }
            toastr()->success("Vui lòng kiểm tra email!");
            return redirect('/login');

        } else {
            toastr()->error("Tài khoản không tồn tại!");
            return redirect('/admin/forgotpassword');
        }
    }

    //update pass
    public function viewUpdatePass($hash_reset){
        $taiKhoan = taikhoan::where('hash_reset', $hash_reset)->first();
        if($taiKhoan) {
            return view('admin.page.update_pass',compact('hash_reset'));
        } else {
            toastr()->error('Dữ liệu không tồn tại!');
            return redirect('/login');
        }
        // return view('admin.page.update_pass',compact('hash_reset'));
    }
    public function actionUpdatePass(Request $request)
    {


        if($request->password != $request->kt_mat_khau) {
            toastr()->error('Mật khẩu không trùng nhau!');
            return redirect()->back();
        }
        $taiKhoan = taikhoan::where('hash_reset', $request->hash_reset)->first();
        if(!$taiKhoan) {
            toastr()->error('Dữ liệu không tồn tại!');
            return redirect()->back();
        } else {
            $taiKhoan->password   = bcrypt($request->password);
            $taiKhoan->hash_reset = NULL;
            $taiKhoan->save();
            toastr()->success('Đã đổi mật khẩu thành công!');
            return redirect('/login');
        }
    }


}
