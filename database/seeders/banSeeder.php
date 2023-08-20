<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class banSeeder extends Seeder
{
    public function run()
    {
        DB::table('bans')->delete();
        DB::table('bans')->truncate();

        DB::table('bans')->insert([
            // [
            //     'ten_ban'       => 'Bàn1',
            //     'slug_ban'      => 'ban1',
            //     'id_khu_vuc'    =>  1,
            //     'tinh_trang'    => random_int(0, 1),
            //     'trang_thai'    => random_int(0, 1),
            // ],
            [
                'ten_ban'       => 'Bàn1',
                'slug_ban'      => 'ban1',
                'id_khu_vuc'    => 1,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn2',
                'slug_ban'      => 'ban2',
                'id_khu_vuc'    => 1,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn3',
                'slug_ban'      => 'ban3',
                'id_khu_vuc'    => 1,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn4',
                'slug_ban'      => 'ban4',
                'id_khu_vuc'    => 1,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn5',
                'slug_ban'      => 'ban5',
                'id_khu_vuc'    => 1,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn6',
                'slug_ban'      => 'ban6',
                'id_khu_vuc'    => 1,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn7',
                'slug_ban'      => 'ban7',
                'id_khu_vuc'    => 1,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn8',
                'slug_ban'      => 'ban8',
                'id_khu_vuc'    => 1,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn9',
                'slug_ban'      => 'ban9',
                'id_khu_vuc'    => 1,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn10',
                'slug_ban'      => 'ban10',
                'id_khu_vuc'    => 1,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
                ////////////////////////////////////////////
            [
                'ten_ban'       => 'Bàn1',
                'slug_ban'      => 'ban1',
                'id_khu_vuc'    =>  2,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn2',
                'slug_ban'      => 'ban2',
                'id_khu_vuc'    => 2,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn3',
                'slug_ban'      => 'ban3',
                'id_khu_vuc'    => 2,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn4',
                'slug_ban'      => 'ban4',
                'id_khu_vuc'    => 2,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn5',
                'slug_ban'      => 'ban5',
                'id_khu_vuc'    => 2,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn6',
                'slug_ban'      => 'ban6',
                'id_khu_vuc'    => 2,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn7',
                'slug_ban'      => 'ban7',
                'id_khu_vuc'    => 2,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn8',
                'slug_ban'      => 'ban8',
                'id_khu_vuc'    => 2,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn9',
                'slug_ban'      => 'ban9',
                'id_khu_vuc'    => 2,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn10',
                'slug_ban'      => 'ban10',
                'id_khu_vuc'    => 2,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
                //////////////////////////////////////
            [
                'ten_ban'       => 'Bàn1',
                'slug_ban'      => 'ban1',
                'id_khu_vuc'    => 3,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn2',
                'slug_ban'      => 'ban2',
                'id_khu_vuc'    => 3,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn3',
                'slug_ban'      => 'ban3',
                'id_khu_vuc'    => 3,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn4',
                'slug_ban'      => 'ban4',
                'id_khu_vuc'    => 3,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],

            [
                'ten_ban'       => 'Bàn5',
                'slug_ban'      => 'ban5',
                'id_khu_vuc'    => 3,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn6',
                'slug_ban'      => 'ban6',
                'id_khu_vuc'    => 3,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn7',
                'slug_ban'      => 'ban7',
                'id_khu_vuc'    => 3,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn8',
                'slug_ban'      => 'ban8',
                'id_khu_vuc'    => 3,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn9',
                'slug_ban'      => 'ban9',
                'id_khu_vuc'    => 3,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
            [
                'ten_ban'       => 'Bàn10',
                'slug_ban'      => 'ban10',
                'id_khu_vuc'    => 3,
                'tinh_trang'    => 1,
                'trang_thai'    => 0,
            ],
        ]);
    }
}
