<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class menuSeeder extends Seeder
{
    public function run()
    {
        DB::table('menus')->delete();
        DB::table('menus')->truncate();

        // $faker = Faker::create();
        DB::table('menus')->insert([
            // Trà Sữa
            [
                'ten_mon'       =>  'Trà Sữa Truyền Thống',
                'slug_mon'      =>  Str::slug('Trà Sữa Truyền Thống'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  1,
            ],
            [
                'ten_mon'       =>  'Trà Sữa Thái Xanh',
                'slug_mon'      =>  Str::slug('tra-sua-thai-xanh'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  1,
            ],
            [
                'ten_mon'       =>  'Trà Sữa Khoai Môn',
                'slug_mon'      =>  Str::slug('tra-sua-khoai-menu'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  1,
            ],
            [
                'ten_mon'       =>  'Trà Sữa Kem Plan',
                'slug_mon'      =>  Str::slug('tra-sua-kem-plan'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  1,
            ],
            [
                'ten_mon'       =>  'Trà Sữa Kem Cheese',
                'slug_mon'      =>  Str::slug('tra-sua-kem-cheese'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  1,
            ],
            [
                'ten_mon'       =>  'Trà Sữa Kem Trứng',
                'slug_mon'      =>  Str::slug('tra-sua-kem-trung'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  1,
            ],
            [
                'ten_mon'       =>  'Sữa Tươi Trân Châu Đường Đen',
                'slug_mon'      =>  Str::slug('sua-tuoi-tran-chau-duong-den'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  1,
            ],


            // Đá Xay
            [
                'ten_mon'       =>  'Socola Đá Xay',
                'slug_mon'      =>  Str::slug('socola-da-xay'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  2,
            ],
            [
                'ten_mon'       =>  'Trà Xanh Đá Xay',
                'slug_mon'      =>  Str::slug('tra-xanh-da-xay'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  2,
            ],
            [
                'ten_mon'       =>  'Ổi Hồng Đá Xay',
                'slug_mon'      =>  Str::slug('oi-hong-da-xay'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  2,
            ],
            [
                'ten_mon'       =>  'Xoài Đá Xay',
                'slug_mon'      =>  Str::slug('xoai-da-xay'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  2,
            ],


            //Trà Trái Cây
            [
                'ten_mon'       =>  'Lục Trà Dưa Lưới',
                'slug_mon'      =>  Str::slug('luc-tra-dua-luoi'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  3,
            ],
            [
                'ten_mon'       =>  'Lục Trà Cam Xoài',
                'slug_mon'      =>  Str::slug('luc-tra-cam-xoai'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  3,
            ],
            [
                'ten_mon'       =>  'Trà Vải',
                'slug_mon'      =>  Str::slug('tra-vai'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  3,
            ],
            [
                'ten_mon'       =>  'Trà Đào',
                'slug_mon'      =>  Str::slug('tra-dao'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  3,
            ],
            [
                'ten_mon'       =>  'Trà Táo Xanh',
                'slug_mon'      =>  Str::slug('tra-tao-xanh'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  3,
            ],
            [
                'ten_mon'       =>  'Trà Bưởi Hồng',
                'slug_mon'      =>  Str::slug('tra-buoi-hong'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  3,
            ],
            [
                'ten_mon'       =>  'Trà Đào Cam Sả',
                'slug_mon'      =>  Str::slug('tra-dao-cam-sa'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  3,
            ],


            //Cà Phê
            [
                'ten_mon'       =>  'Cà Phê Sài Gòn',
                'slug_mon'      =>  Str::slug('ca-phe-sai-gon'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  4,
            ],
            [
                'ten_mon'       =>  'Cà Phê Cốt Dừa',
                'slug_mon'      =>  Str::slug('ca-phe-cot-dua'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  4,
            ],
            [
                'ten_mon'       =>  'Cà Phê Kem Muối',
                'slug_mon'      =>  Str::slug('ca-phe-kem-muoi'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  4,
            ],
            [
                'ten_mon'       =>  'Cà Phê Kem Trứng',
                'slug_mon'      =>  Str::slug('ca-phe-kem-trung'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  4,
            ],


            //món khác
            [
                'ten_mon'       =>  'Nước Cam',
                'slug_mon'      =>  Str::slug('nuoc-cam'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  5,
            ],
            [
                'ten_mon'       =>  'Sữa Chua',
                'slug_mon'      =>  Str::slug('sua-chua'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  5,
            ],
            [
                'ten_mon'       =>  'Nước Ngọt',
                'slug_mon'      =>  Str::slug('nuoc-ngot'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  5,
            ],


            //Thức Ăn Nhanh
            [
                'ten_mon'       =>  'Mỳ Trứng',
                'slug_mon'      =>  Str::slug('mi-trung'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  5,
            ],
            [
                'ten_mon'       =>  'Mỳ Bò',
                'slug_mon'      =>  Str::slug('mi-bo'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  5,
            ],
            [
                'ten_mon'       =>  'Khoai Tây Chiên',
                'slug_mon'      =>  Str::slug('khoai-tay-chien'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  5,
            ],
            [
                'ten_mon'       =>  'Cá Viên Chiên',
                'slug_mon'      =>  Str::slug('ca-vien-chien'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  5,
            ],
            [
                'ten_mon'       =>  'Xúc Xích',
                'slug_mon'      =>  Str::slug('xuc-xich'),
                'gia_ban'       =>  random_int(10, 50) * 1000,
                'tinh_trang'    =>  random_int(0, 1),
                'hinh_anh'      =>  Str::uuid() . '-' . Str::slug('') . '.' . 'jpg',
                'id_danh_muc'   =>  5,
            ],

        ]);
    }
}
