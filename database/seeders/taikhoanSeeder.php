<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class taikhoanSeeder extends Seeder
{

    public function run()
    {
        DB::table('taikhoans')->delete();
        DB::table('taikhoans')->truncate();

        DB::table('taikhoans')->insert([
            [
                'id'             =>1,
                'ho_va_ten'      =>'Thiên Đức',
                'email'          =>'duc09092001@gmail.com',
                'so_dien_thoai'  =>'0935874992',
                'ngay_sinh'      => date('Y-m-d H:i:s'),
                'password'       => bcrypt('duc09092001'),
                'id_quyen'       =>1,

            ],

        ]);
    }
}
