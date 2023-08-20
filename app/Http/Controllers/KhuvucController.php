<?php

namespace App\Http\Controllers;

use App\Http\Requests\khuvuc\CreatekhuvucRequest;
use App\Http\Requests\khuvuc\UpdatekhuvucRequest;
use App\Models\ban;
use App\Models\khuvuc;
use Illuminate\Http\Request;

class KhuvucController extends Controller
{

    public function index()
    {
        return view('admin.page.khuvuc.index');
    }

    public function getDaTa()
    {
        $data = khuvuc::get();  //khuvuc::all()
        return response()->json([
            'data' => $data
        ]);
    }

    //-----------doitrangthai-------
    public function doitrangthai(Request $request)
    {
        $khuvuc = khuvuc::find($request->id);

        if ($khuvuc) {
            $khuvuc->tinh_trang = !$khuvuc->tinh_trang;
            $khuvuc->save();

            return response()->json([
                'status'   => true,
                'message'  => 'Đã đổi trạng thái thành công! '
            ]);
        } else {
            return response()->json([
                'status'   => false,
                'message'  => 'khu vực không tồn tại! '
            ]);
        }
    }

    //---------nhap---------
    public function nhap(CreatekhuvucRequest $request)
    {
        $data = $request->all();
        khuvuc::create($data);
        return response()->json([
            'status' => true,
            'message'  => 'đã tạo khu vực mới thành công '
        ]);
    }

    // -------xoa----
    public function xoa(Request $request)
    {
        // $khuvuc =khuvuc::find($request->id);
        // if ($khuvuc) {
        //     $khuvuc->delete();
        //     return response()->json([
        //         'status'   => true,
        //         'message'  => 'đã xóa khu vực thành công !'
        //     ]);
        // } else {
        //     return response()->json([
        //         'status'   => false,
        //         'message'  => 'khu vực không tồn tại! '
        //     ]);
        // }
        $khuVuc = KhuVuc::find($request->id);

        if($khuVuc) {
            $ban = ban::where('id_khu_vuc', $request->id)->first();

            if($ban) {
                return response()->json([
                    'status'    => 2,
                    'message'   => 'Khu vực này đang có bàn, bạn không thể xóa!'
                ]);
            } else {
                $khuVuc->delete();

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
    public function capnhap(UpdatekhuvucRequest $request)
    {
        $khuvuc = khuvuc::where('id', $request->id)->first();
        $data = $request->all();
        $khuvuc->update($data);
        return response()->json([
            'status' => true,
            'message' => 'đã cập nhập được khu vực'
        ]);
    }

    //------check-slug-----
    public function checkslug(Request $request)
    {
        if (isset($request->id)) {
            $check = khuvuc::where('slug_khu', $request->slug_khu)
                ->where('id', '<>', $request->id)
                ->first();
        } else {
            $check = khuvuc::where('slug_khu', $request->slug_khu)->first();
        }

        $check = khuvuc::where('slug_khu', $request->slug_khu)->first();
        if ($check) {
            return response()->json([
                'status' => false,
                'message' => 'tên bàn đã tồn tại'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'tên khu vực có thể sử dụng '
            ]);
        }
    }

}


