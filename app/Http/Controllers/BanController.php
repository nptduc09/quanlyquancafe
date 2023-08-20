<?php

namespace App\Http\Controllers;

use App\Http\Requests\ban\CreatebanRequest;
use App\Http\Requests\ban\UpdatebanRequest;
use App\Models\ban;
use App\Models\khuvuc;
use Illuminate\Http\Request;

class BanController extends Controller
{
    public function index(){
        $khuvuc = khuvuc::all();
        return view('admin.page.ban.index', compact('khuvuc'));

    }

    public function getDaTa(){

        $data = ban::join('khuvucs','bans.id_khu_vuc', 'khuvucs.id')
                    ->select('bans.*','khuvucs.ten_khu')
                    ->get();
        return response()->json([
            'data' => $data
        ]);
    }

    //----doitrangthai
    public function doiTrangThai(Request $request){
        $ban = ban::find($request->id);

        if($ban){
            $ban->tinh_trang = !$ban->tinh_trang;
            $ban->save();

            return response()->json([
                'status'   => true,
                'message'  => 'Đã đổi trạng thái thành công! '
            ]);
        } else{
            return response()->json([
                'status'   => false,
                'message'  => 'Bàn không tồn tại! '
            ]);
        }
    }
    //----doitrangthai2
    public function doiTrangThai2(Request $request){
        $ban = ban::find($request->id);

        if($ban){
            $ban->trang_thai = !$ban->trang_thai;
            $ban->save();

            return response()->json([
                'status'   => true,
                'message'  => 'Đã đổi trạng thái thành công! '
            ]);
        } else{
            return response()->json([
                'status'   => false,
                'message'  => 'Bàn không tồn tại! '
            ]);
        }
    }

    // -------delete----
    public function delete(Request $request)
    {
        $Ban = ban::find($request->id);
        if ($Ban) {
            if ($Ban) {
                $Ban->delete();
                return response()->json([
                    'status' => true,
                    'message' => "Đã xoá bàn thành công"
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Bàn không tồn tại"
            ]);
        }
    }

    // ----edit----
    public function edit(Request $request){
        $ban = ban::find($request->id);
        if($ban){

            return response()->json([
                'status'   => true,
                'message'  => 'Đã lấy được dữ liệu! ',
                'ban'     => $ban,
            ]);
        } else{
            return response()->json([
                'status'   => false,
                'message'  => 'Bàn không tồn tại! '
            ]);
        }
    }

    //-----nhap----
    public function store(CreatebanRequest $request){
        $data = $request->all();
        ban::create($data);
        return response()->json([
            'status' => true,
            'message'  => 'đã tạo bàn mới thành công '
        ]);
    }

    public function checkslug(Request $request){
        if(isset($request->id)){
            $check = ban::where('slug_ban',$request->slug_ban)
                          ->where('id' , '<>', $request ->id)
                          ->first();
        } else {
            $check = ban::where('slug_ban',$request->slug_ban)->first();
        }

        $check = ban::where('slug_ban',$request->slug_ban)->first();
        if ($check){
            return response()->json([
                'status' => false,
                'message' => 'tên bàn đã tồn tại'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'tên bàn có thể sử dụng '
            ]);
        }
    }

    //----update----
    public function update(UpdatebanRequest $request){
        $ban = ban::where('id',$request->id)->first();
        $data = $request->all();
        $ban->update($data);
        return response()->json([
            'status' => true,
            'message' => 'đã cập nhập được thông tin'
        ]);
    }
}
