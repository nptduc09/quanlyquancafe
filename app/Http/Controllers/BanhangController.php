<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BanhangController extends Controller
{
    public function index(){
        return view('admin.page.banhang.index');
    }
}
