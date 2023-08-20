<?php

namespace App\Http\Controllers;

use App\Models\danhsachchucnang;
use App\Models\quyen;
use Illuminate\Http\Request;

class QuyenController extends Controller
{
    public function index()
    {

        $x      = $this -> checkquyen(6);
        if($x){
            toastr()->error('Bạn Không Đủ Quyền Truy Cập');
            return redirect('/admin/ban-hang');
        }

        return view('admin.page.quyen.index');
    }

    //lấy dữ liệu
    public function getData()
    {
        $data = quyen::get();

        return response()->json([
            'data'      => $data,
        ]);
    }

    //xóa
    public function destroy(Request $request)
    {

        $x      = $this -> checkquyen(9);
        if($x){
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn Không Đủ Quyền Để Xóa!'
            ]);
        }

        if($request->id == 1){
            return response()->json([
                'status'    => false,
                'message'   => 'Không thể xóa quyền ADMIN!'
            ]);
        }
        Quyen::find($request->id)->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa quyền thành công!'
        ]);
    }
    //nhap
    public function nhap(Request $request)
    {
        $x      = $this -> checkquyen(7);
        if($x){
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn Không Đủ Quyền Để Thêm!'
            ]);
        }

        $data = $request->all();
        quyen::create($data);
        return response()->json([
            'status' => true,
            'message'  => 'đã tạo Quyền mới thành công '
        ]);
    }
    //update
    public function update(Request $request){

        $x      = $this -> checkquyen(8);
        if($x){
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn Không Đủ Quyền Để Xóa!'
            ]);
        }

        $quyen = quyen::where('id',$request->id)->first();
        $data = $request->all();
        $quyen->update($data);
        return response()->json([
            'status' => true,
            'message' => 'đã cập nhập được thông tin'
        ]);
    }

    public function danhsachchucnang(){
        $danhsachchucnang = danhsachchucnang::get();
        return response()->json([
            'danhsachchucnang'      => $danhsachchucnang,
        ]);
    }
}
