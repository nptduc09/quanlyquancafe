<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class danhmucSeeder extends Seeder
{
    public function run()
    {
        DB::table('danhmucs')->delete();
        DB::table('danhmucs')->truncate();

        DB::table('danhmucs')->insert([

            [
                'ten_danh_muc'  => 'Trà Sữa',
                'slug_danh_muc' => 'tra-sua',
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_danh_muc'  => 'Đá Xay',
                'slug_danh_muc' => 'da-xay',
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_danh_muc'  => 'Trà Trái Cây',
                'slug_danh_muc' => 'tra-trai-cay',
                'tinh_trang'    => random_int(0, 1),
            ],
            [
                'ten_danh_muc'  => 'Cà Phê',
                'slug_danh_muc' => 'ca-phe',
                'tinh_trang'    => random_int(0, 1),
            ],

            [
                'ten_danh_muc'  => 'Món Khác',
                'slug_danh_muc' => 'mon-khac',
                'tinh_trang'    => random_int(0, 1),
            ],

            [
                'ten_danh_muc'  => 'Thức Ăn Nhanh',
                'slug_danh_muc' => 'thuc-an-nhanh',
                'tinh_trang'    => random_int(0, 1),
            ],

        ]);
    }
}
