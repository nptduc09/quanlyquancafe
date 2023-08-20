<?php

namespace App\Http\Controllers;

use App\Http\Requests\danhmuc\CreatedanhmucRequest;
use App\Http\Requests\danhmuc\UpdatedanhmucRequest;
use App\Models\danhmuc;
use App\Models\menu;
use Illuminate\Http\Request;

class DanhmucController extends Controller
{
    public function index()
    {
        
        return view('admin.page.danhmuc.index');
    }

    public function getDaTa()
    {
        $data = danhmuc::get();  //danhmuc::all()
        return response()->json([
            'data' => $data
        ]);
    }

    //-----------doitrangthai-------
    public function doitrangthai(Request $request)
    {
        $danhmuc = danhmuc::find($request->id);

        if ($danhmuc) {
            $danhmuc->tinh_trang = !$danhmuc->tinh_trang;
            $danhmuc->save();

            return response()->json([
                'status'   => true,
                'message'  => 'Đã đổi trạng thái thành công! '
            ]);
        } else {
            return response()->json([
                'status'   => false,
                'message'  => 'Danh mục không tồn tại! '
            ]);
        }
    }

    //---------nhap---------
    public function nhap(CreatedanhmucRequest $request)
    {
        $data = $request->all();
        danhmuc::create($data);
        return response()->json([
            'status' => true,
            'message'  => 'đã tạo Danh mục mới thành công'
        ]);
    }

    // -------xoa----
    public function xoa(Request $request)
    {
        // $danhmuc = danhmuc::find($request->id);
        // if ($danhmuc) {
        //     $danhmuc->delete();
        //     return response()->json([
        //         'status'   => true,
        //         'message'  => 'đã xóa Danh mục thành công !'
        //     ]);
        // } else {
        //     return response()->json([
        //         'status'   => false,
        //         'message'  => 'Danh mục không tồn tại! '
        //     ]);
        // }



        $danhmuc = danhmuc::find($request->id);

        if($danhmuc) {
            $menu = menu::where('id_danh_muc', $request->id)->first();

            if($menu) {
                return response()->json([
                    'status'    => 2,
                    'message'   => 'Khu vực này đang có bàn, bạn không thể xóa!'
                ]);
            } else {
                $danhmuc->delete();

                return response()->json([
                    'status'    => true,
                    'message'   => 'Đã xóa khu vực thành công!'
                ]);
            }
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Khu vực không tồn tại!'
            ]);
        }


    }

    //----cập nhập----
    public function capnhap(UpdatedanhmucRequest $request)
    {
        $danhmuc = danhmuc::where('id', $request->id)->first();
        $data = $request->all();
        $danhmuc->update($data);
        return response()->json([
            'status' => true,
            'message' => 'đã cập nhập được khu vực'
        ]);
    }

    //------check-slug-----
    public function checkslug(Request $request)
    {
        if (isset($request->id)) {
            $check = danhmuc::where('slug_danh_muc', $request->slug_danh_muc)
                ->where('id', '<>', $request->id)
                ->first();
        } else {
            $check = danhmuc::where('slug_danh_muc', $request->slug_danh_muc)->first();
        }

        $check = danhmuc::where('slug_danh_muc', $request->slug_danh_muc)->first();
        if ($check) {
            return response()->json([
                'status' => false,
                'message' => 'tên bàn đã tồn tại'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'tên Danh mục có thể sử dụng '
            ]);
        }
    }
}
