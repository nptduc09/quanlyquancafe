<?php

namespace App\Http\Controllers;

use App\Models\chitietbanhang;
use App\Models\hoadonbanhang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThongkeController extends Controller
{
    public function viewThongKeBanHang()
    {

        $x      = $this -> checkquyen(10);
        if($x){
            toastr()->error('Bạn Không Đủ Quyền Truy Cập');
            return redirect('/admin/ban-hang');
        }

        return view('admin.page.thongke.banhang');
    }

    public function actionThongKeBanHang(Request $request)
    {
        $data   = hoadonbanhang::where('trang_thai', 1)
                               ->whereDate('ngay_thanh_toan', '>=', $request->begin)
                               ->whereDate('ngay_thanh_toan', '<=', $request->end)
                               ->get();
        foreach ($data as $item) {
            $item->tong_tien_sau_giam_gia = $item->tong_tien - $item->giam_gia;
        }
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã lấy dữ liệu',
            'data'      => $data,
        ]);
    }


    public function viewThongKeMonAn()
    {

        $x      = $this -> checkquyen(11);
        if($x){
            toastr()->error('Bạn Không Đủ Quyền Truy Cập');
            return redirect('/admin/ban-hang');
        }

        return view('admin.page.thongke.monan');
    }

    public function actionThongKeMonAn(Request $request)
    {
        $data = chitietbanhang::join('hoadonbanhangs', 'hoadonbanhangs.id', 'chitietbanhangs.id_hoa_don_ban_hang')
                              ->whereDate('hoadonbanhangs.ngay_thanh_toan', '>=', $request->begin)
                              ->whereDate('hoadonbanhangs.ngay_thanh_toan', '<=', $request->end)
                              ->where('hoadonbanhangs.trang_thai', 1)
                              ->select('chitietbanhangs.ten_mon',
                                       'chitietbanhangs.id_menu',
                                        DB::raw('SUM(chitietbanhangs.so_luong_ban) as tong_so_luong_ban'),
                                        DB::raw('SUM(chitietbanhangs.thanh_tien) as tong_tien_thanh_toan')
                                    )
                              ->groupBy('chitietbanhangs.ten_mon',
                                            'chitietbanhangs.id_menu')
                              ->get();
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã lấy dữ liệu',
            'data'      => $data,
        ]);
    }


    // public function actionChiTietMonAn(Request $request)
    // {
    //     $data = chitietbanhang::where('id_menu', $request->id_menu)
    //                           ->join('hoadonbanhangs', 'hoadonbanhangs.id', 'chitietbanhangs.id_hoa_don_ban_hang')
    //                           ->where('hoadonbanhangs.trang_thai', 1)
    //                           ->whereDate('hoadonbanhangs.ngay_thanh_toan', '>=', $request->begin)
    //                           ->whereDate('hoadonbanhangs.ngay_thanh_toan', '<=', $request->end)
    //                           ->join('bans', 'bans.id', 'hoadonbanhangs.id_ban')
    //                           ->join('khuvucs', 'khuvucs.id', 'bans.id_khu_vuc')
    //                           ->select('bans.ten_ban', 'khuvucs.ten_khu',
    //                                     DB::raw('SUM(chitietbanhangs.so_luong_ban) as tong_so_luong'),
    //                                     DB::raw('SUM(chitietbanhangs.thanh_tien) as tong_tien_thanh_toan'),
    //                                 )
    //                           ->groupBy('bans.ten_ban', 'khuvucs.ten_khu')
    //                           ->get();
    //     return response()->json([
    //         'status'    => 1,
    //         'message'   => 'Đã lấy dữ liệu',
    //         'data'      => $data,
    //     ]);
    // }
    public function actionChiTietMonAn(Request $request)
{
    $data = chitietbanhang::where('id_menu', $request->id_menu)
                          ->join('hoadonbanhangs', 'hoadonbanhangs.id', 'chitietbanhangs.id_hoa_don_ban_hang')
                          ->where('hoadonbanhangs.trang_thai', 1)
                          ->whereDate('hoadonbanhangs.ngay_thanh_toan', '>=', $request->begin)
                          ->whereDate('hoadonbanhangs.ngay_thanh_toan', '<=', $request->end)
                          ->join('bans', 'bans.id', 'hoadonbanhangs.id_ban')
                          ->join('khuvucs', 'khuvucs.id', 'bans.id_khu_vuc')
                          ->join('menus', 'menus.id', 'chitietbanhangs.id_menu')
                          ->select('bans.ten_ban', 'khuvucs.ten_khu',
                                    DB::raw('SUM(chitietbanhangs.so_luong_ban) as tong_so_luong'),
                                    DB::raw('SUM(chitietbanhangs.thanh_tien) as tong_tien_thanh_toan'),
                                    DB::raw('SUM(chitietbanhangs.don_gia_ban * chitietbanhangs.so_luong_ban) as gia_ban'),
                                    DB::raw('SUM(chitietbanhangs.tien_chiet_khau) as tien_chiet_khau')
                                )
                          ->groupBy('bans.ten_ban', 'khuvucs.ten_khu')
                          ->get();

    return response()->json([
        'status'    => 1,
        'message'   => 'Đã lấy dữ liệu',
        'data'      => $data,
    ]);
}

}
