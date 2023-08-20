<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class danhsachchucnangSeeder extends Seeder
{

    public function run()
    {
        DB::table('danhsachchucnangs')->delete();
        DB::table('danhsachchucnangs')->truncate();

        DB::table('danhsachchucnangs')->insert([
            // câu lệnh ex       = " [ 'id' => ' "&B3&" ' , 'danh_sach_chuc_nang' => ' "&C3&" ' ] ,           "
            [ 'id' => '1','danh_sach_chuc_nang' =>'View Tạo Tài Khoản'],
            [ 'id' => '2','danh_sach_chuc_nang' =>'Thêm Mới Tài Khoản'],
            [ 'id' => '3','danh_sach_chuc_nang' =>'Đổi Mật Khẩu'],
            [ 'id' => '4','danh_sach_chuc_nang' =>'Cập Nhập Mật Khẩu'],
            [ 'id' => '5','danh_sach_chuc_nang' =>'Xóa Tài Khoản'],
            [ 'id' => '6','danh_sach_chuc_nang' =>'View Phân Quyền'],
            [ 'id' => '7','danh_sach_chuc_nang' =>'Thêm Mới Phân Quyền'],
            [ 'id' => '8','danh_sach_chuc_nang' =>'Cập Nhập Phân Quyền'],
            [ 'id' => '9','danh_sach_chuc_nang' =>'Xóa Phân Quyền'],
            [ 'id' => '10','danh_sach_chuc_nang' =>'Xem Thống Kê Bán Hàng'],
            [ 'id' => '11','danh_sach_chuc_nang' =>'Xem Thống Kê Món'],
        ]);
    }
}
