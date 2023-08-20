<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class quyenSeeder extends Seeder
{

    public function run()
    {
        DB::table('quyens')->delete();
        DB::table('quyens')->truncate();

        DB::table('quyens')->insert([
            [
                'id'              =>1,
                'ten_quyen'       =>'ADMIN',
                'list_id_quyen'   =>'1,2,3,4,5,6,7,8,9,10,11',


            ],

        ]);
    }
}
