<?php

namespace App\Http\Controllers;

use App\Http\Requests\hoadon\addmenuchitiethoadonRequest;
use App\Http\Requests\hoadon\CheckidhoadonbanhangRequest;
use App\Http\Requests\hoadon\getdanhsachmenutheohoadonRequest;
use App\Http\Requests\hoadon\updatechitietbanhangRequest;
use Illuminate\Support\Str;
use App\Models\ban;
use App\Models\chitietbanhang;
use App\Models\hoadonbanhang;
use App\Models\khuvuc;
use App\Models\menu;
use Carbon\Carbon;
// use PHPViet\NumberToWords\Transformer;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Solutions\SolutionTransformers\LaravelSolutionTransformer;

class HoadonbanhangController extends Controller
{
    public function index(){
        $khuvuc = khuvuc::where('tinh_trang', 1)->get();
        return view('admin.page.banhang.index', compact('khuvuc'));
    }

    public function getbankv(Request $request)
    {

        $ban = ban::join('khuvucs', 'bans.id_khu_vuc', 'khuvucs.id')
                    ->where('bans.id_khu_vuc', $request->id)
                    ->where('bans.tinh_trang', 1)
                    ->where('khuvucs.tinh_trang', 1)
                    ->select('bans.*', 'khuvucs.ten_khu')
                    ->get();

        return response()->json([
            'data' => $ban,
        ]);
    }


    public function store(Request $request)
    {
        $ban = ban::find($request->id_ban );
        if ($ban && $ban->tinh_trang == 1 && $ban->trang_thai == 0) {
            $ban->trang_thai = 1; //lên màu xanh
            $ban->save();

            $hoadon = hoadonbanhang::create([
                'ma_hoa_don_ban_hang'       => Str::uuid(),
                'id_ban'                    => $request->id_ban,

            ]);
            return response()->json([
                'status'    =>true,
                'message'   => 'Đã mở bàn',
                'id_hoa_don_ban_hang'  => $hoadon->id,
            ]);

        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Bàn không thể mở',
            ]);

        }
    }


    //id
    public function findidbyidban(Request $request){

        $hoadon = hoadonbanhang::where('id_ban', $request->id_ban)->where('trang_thai',0)->first();

        if($hoadon){
            return response()->json([
                'status'       => true,
                'id_hoa_don'   => $hoadon->id,
            ]);
        } else {
            return response()->json([
                'status'       => false,
                'id_hoa_don'   => 0,
            ]);
        }
    }

    public function addmenuchitiethoadon(addmenuchitiethoadonRequest $request){
        // dd($request->all());
        $hoadon = hoadonbanhang::find($request->id_hoa_don_ban_hang);
        if($hoadon->trang_thai){
            return response()->json([
                'status'       => 0,
                'id_hoa_don'   => "hóa đơn này đã tính tiền",
            ]);
        } else {
            $menu = menu::find($request->id_menu);

            $check = chitietbanhang::where("id_hoa_don_ban_hang",$request->id_hoa_don_ban_hang)
                                    ->where("id_menu",$request->id_menu)
                                    ->first();
            if($check && $check->is_in_bep ==0){
                $check->so_luong_ban    = $check->so_luong_ban + 1;
                $check->thanh_tien      = $check->so_luong_ban * $check->don_gia_ban - $check->tien_chiet_khau;
                $check->save();

            }
            else{
                chitietbanhang::create([
                    'id_hoa_don_ban_hang'   => $request->id_hoa_don_ban_hang ,
                    'id_menu'               =>$request->id_menu,
                    'ten_mon'              =>$menu->ten_mon,
                    'so_luong_ban'          => 1,
                    'don_gia_ban'           => $menu->gia_ban ,
                    'tien_chiet_khau'       => 0,
                    'thanh_tien'            => $menu->gia_ban,
                ]);
            }
            return response()->json([
                'status'       => 1,
                'message'   => "đã thêm món thành công",
            ]);
        }
    }


    public function getdanhsachmenutheohoadon(getdanhsachmenutheohoadonRequest $request){
        $hoadon = hoadonbanhang::find($request->id_hoa_don_ban_hang);
        if($hoadon -> trang_thai){
            return response()->json([
                'status'       => 0,
                'id_hoa_don'   => "hóa đơn này đã tính tiền",
            ]);
        } else {
            $data = chitietbanhang::where('id_hoa_don_ban_hang', $request->id_hoa_don_ban_hang)->get();
            $tong_tien  = 0;
            foreach($data as $key => $value) {
                $tong_tien += $value->thanh_tien;
            }
            // $transformer = new Transformer();

            $giam_gia    = $hoadon->giam_gia;
            $thanh_tien  = $tong_tien - $giam_gia;

            return response()->json([
                'status'        => 1,
                'data'          => $data,
                'tong_tien'     => $tong_tien,
                'thanh_tien'    => $thanh_tien,

            ]);
        }
    }

    //update
    public function update(updatechitietbanhangRequest $request){
        $chitietbanhang = chitietbanhang::find($request->id);
        $hoadonbanhang  = hoadonbanhang::find($request->id_hoa_don_ban_hang);

        if($hoadonbanhang && $hoadonbanhang->trang_thai == 0 && $chitietbanhang->is_in_bep==0) {
            $chitietbanhang->so_luong_ban         = $request->so_luong_ban;
            $chitietbanhang->thanh_tien           = $chitietbanhang->so_luong_ban * $request->don_gia_ban;
            $chitietbanhang->ghi_chu              = $request->ghi_chu;
            $chitietbanhang->tien_chiet_khau     = $request->tien_chiet_khau;


            if($request->tien_chiet_khau > $chitietbanhang->thanh_tien){
                return response()->json([
                    'status'   => 0 ,
                    'message'  => 'tiền chiết khấu chỉ dc tối đa' . number_format($chitietbanhang->thanh_tien, 0 ,'.','.') . 'đ',
                ]);
            } else{
                $chitietbanhang->thanh_tien = $chitietbanhang->thanh_tien - $request->tien_chiet_khau;
                $chitietbanhang->save();
                return response()->json([
                    'status'   => 1 ,
                    'message'  => 'đã cập nhập',
                ]);
            }

            return response()->json([
                'status'   => 1 ,
                'message'  => 'đã cập nhập số lượng thành công',
            ]);
        } else {
            return response()->json([
                'status'   => 0 ,
                'message'  => 'có lỗi không mong muốn sảy ra',
            ]);
        }

    }
    //inbep
    public function inbep(CheckidhoadonbanhangRequest $request){
        $hoadonbanhang  = hoadonbanhang::find($request->id_hoa_don_ban_hang);

        if($hoadonbanhang && $hoadonbanhang->trang_thai == 0) {
           chitietbanhang::where('id_hoa_don_ban_hang',$request->id_hoa_don_ban_hang)

                          ->update([
                            'is_in_bep' =>1,
                          ]);
            return response()->json([
                'status'   => 1 ,
                'message'  => 'đã in bếp thành công',
            ]);
        } else {
            return response()->json([
                'status'   => 0 ,
                'message'  => 'hóa đơn này đã tính tiền',
            ]);
        }
    }
    public function xoachitietdonhang(updatechitietbanhangRequest $request){
        $chitietbanhang = chitietbanhang::find($request->id);
        $hoadonbanhang  = hoadonbanhang::find($request->id_hoa_don_ban_hang);

        if($hoadonbanhang && $hoadonbanhang->trang_thai == 0 && $chitietbanhang->is_in_bep==0) {
            $chitietbanhang->delete();
            return response()->json([
                'status'   => 1 ,
                'message'  => 'đã xóa',
            ]);
        } else {
            return response()->json([
                'status'   => 0 ,
                'message'  => 'có lỗi không mong muốn sảy ra',
            ]);
        }
    }


    //thanh toán
    public function tinhTongDaBanTheoIdMonAn($id_menu)
    {
        $menu   =  chitietbanhang::join('hoadonbanhangs', 'id_hoa_don_ban_hang', 'hoadonbanhangs.id')
                                     ->where('id_menu', $id_menu)
                                     ->where('hoadonbanhangs.trang_thai', 1)
                                     ->sum('so_luong_ban');

        $menu              =  menu::find($id_menu);

        $menu->save();
    }

    public function thanhtoan(Request $request)
    {
        $hoadonbanhang = hoadonbanhang::find($request->id_hoa_don_ban_hang);
        if($hoadonbanhang && $hoadonbanhang->trang_thai == 0) {
            $data = chitietbanhang::where('id_hoa_don_ban_hang', $request->id_hoa_don_ban_hang)->get();
            $tong_tien  = 0;
            foreach($data as $key => $value) {
                $tong_tien += $value->thanh_tien;
                $this->tinhTongDaBanTheoIdMonAn($value->id_menu);
            }
            chitietbanhang::where('id_hoa_don_ban_hang', $request->id_hoa_don_ban_hang)
                          ->update([
                                'is_che_bien'    =>  1,
                                'is_in_bep'      =>  1,
                          ]);

            $hoadonbanhang->trang_thai = 1;
            $hoadonbanhang->ngay_thanh_toan = Carbon::now();
            $hoadonbanhang->tong_tien       = $tong_tien - $hoadonbanhang->tien_giam_gia;
            $hoadonbanhang->save();

            $ban                =   ban::find($request->id_ban);
            $ban->trang_thai    =   0;

            $ban->save();

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã thanh toán thành công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này đã tính tiền!',
            ]);
        }
    }

    public function inBill($id)
    {
        $chitiet = chitietbanhang::where('id_hoa_don_ban_hang', $id)->get();
        $tong_tien  = 0;
        foreach($chitiet as $key => $value) {
            $tong_tien += $value->thanh_tien;
        }
        $hoadon      = hoadonbanhang::find($id);
        $giam_gia    = $hoadon->giam_gia;
        $thanh_tien  = $tong_tien - $giam_gia;
        $ngay        = $hoadon->ngay_thanh_toan ? Carbon::parse($hoadon->ngay_thanh_toan)->format('H:i d/m/Y')  : 'Hóa đơn tạm tính';
        return view('admin.page.banhang.inbill', compact('chitiet', 'tong_tien', 'thanh_tien','giam_gia','ngay' ));
    }

    public function giamgia(Request $request)
    {
        $hoadonbanhang = hoadonbanhang::find($request->id);
        if($hoadonbanhang && $hoadonbanhang->trang_thai == 0) {
            $hoadonbanhang->giam_gia = $request->giam_gia;
            $hoadonbanhang->save();
            return response()->json([
                'status'    => 1,
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Hóa đơn này đã tính tiền!',
            ]);
        }
    }


    // public function getdanhsachmenutheohoadondathanhtoan(Request $request)
    // {
    //     $hoaDon     = hoadonbanhang::find($request->id);
    //     if($hoaDon->trang_thai == 0) {
    //         return response()->json([
    //             'status'    => 0,
    //             'message'   => 'Hóa đơn này chưa tính tiền!',
    //         ]);
    //     } else {
    //         $data = ChiTietBanHang::where('id_hoa_don_ban_hang', $request->id)->get();
    //         $tong_tien  = 0;
    //         foreach($data as $key => $value) {
    //             $tong_tien += $value->thanh_tien;

    //         }
    //         // $transformer = new Transformer();

    //         $giam_gia    = $hoaDon->giam_gia;
    //         $thanh_tien  = $tong_tien - $giam_gia;

    //         return response()->json([
    //             'status'        => 1,
    //             'data'          => $data,
    //             'tong_tien'     => $tong_tien,
    //             'thanh_tien'    => $thanh_tien,
    //         ]);
    //     }
    // }
    public function getdanhsachmenutheohoadondathanhtoan(Request $request)
{
    $hoaDon = hoadonbanhang::find($request->id);
    if ($hoaDon->trang_thai == 0) {
        return response()->json([
            'status'    => 0,
            'message'   => 'Hóa đơn này chưa tính tiền!',
        ]);
    } else {
        $data = ChiTietBanHang::where('id_hoa_don_ban_hang', $request->id)->get();
        $tong_tien = 0;
        $tien_chiet_khau = 0; // Khởi tạo giá trị tien_chiet_khau ban đầu là 0

        foreach ($data as $key => $value) {
            $tong_tien += $value->thanh_tien;
            $tien_chiet_khau += $value->tien_chiet_khau; // Cộng dồn giá trị tien_chiet_khau từng dòng
            $value->gia_ban = $value->don_gia_ban;
        }

        // $transformer = new Transformer();

        $giam_gia = $hoaDon->giam_gia;
        $thanh_tien = $tong_tien - $giam_gia;

        return response()->json([
            'status'        => 1,
            'data'          => $data,
            'tong_tien'     => $tong_tien,
            'thanh_tien'    => $thanh_tien,
            'tien_chiet_khau' => $tien_chiet_khau, // Trả về giá trị tien_chiet_khau
        ]);
    }
}

}
