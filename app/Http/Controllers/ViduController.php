<?php

namespace App\Http\Controllers;

use App\Http\Requests\danhmuc\CreatedanhmucRequest;
use App\Http\Requests\danhmuc\UpdatedanhmucRequest;
use App\Http\Requests\danhmuc\CreatekhuvucRequest;
use App\Http\Requests\danhmuc\UpdatekhuvucRequest;
use App\Http\Requests\menu\CreatemenuRequest;
use App\Http\Requests\menu\UpdatemenuRequest;
use App\Models\danhmuc;
use App\Models\danhsachchucnang;
use App\Models\khuvuc;
use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ViduController extends Controller
{
    public function index(){
        return view('admin.page.vidu.index');
    }

    public function getdata(){
        $danhsachchucnang = danhsachchucnang::get();
        return response()->json([
            'danhsachchucnang'      => $danhsachchucnang,
        ]);
    }

}
