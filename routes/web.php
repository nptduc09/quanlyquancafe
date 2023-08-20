<?php

use App\Http\Controllers\BanController;
use App\Http\Controllers\ChitietbanhangController;
use App\Http\Controllers\DanhmucController;

use App\Http\Controllers\HoadonbanhangController;
use App\Http\Controllers\KhuvucController;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\QuyenController;
use App\Http\Controllers\TaikhoanController;
use App\Http\Controllers\ThongkeController;
use App\Http\Controllers\TrangchuController;
use App\Http\Controllers\ViduController;
use Illuminate\Support\Facades\Route;



Route::get('/', [TrangchuController::class, 'index']);
Route::get('/test', [HoadonbanhangController::class, 'test']);

Route::get('/login', [TaikhoanController::class, 'viewLogin']);

Route::post('/admin/login', [TaikhoanController::class, 'actionLogin']);


Route::get('/admin/forgotpassword', [TaikhoanController::class, 'viewforgotpass']);
Route::post('/admin/forgotpassword', [TaikhoanController::class, 'actionforgotpass']);

Route::get('/admin/update-password/{hash_reset}', [TaikhoanController::class, 'viewUpdatePass']);
Route::post('/admin/update-password', [TaikhoanController::class, 'actionUpdatePass']);





Route::group(['prefix' => '/admin','middleware' => 'CheckTaiKhoanLogin'], function () {
// Route::group(['prefix' => '/admin'], function () {

    Route::get('/logout', [TaikhoanController::class, 'actionLogout']);



    //Khu Vực
    Route::group(['prefix' => '/khu-vuc'], function () {
        Route::get('/', [KhuvucController::class, 'index']);
        Route::get('/data', [KhuvucController::class, 'getData']);
        Route::post('/doi-trang-thai', [KhuvucController::class, 'doitrangthai']);
        Route::post('/nhap', [KhuvucController::class, 'nhap']);
        Route::post('/xoa', [KhuvucController::class, 'xoa']);
        Route::post('cap-nhap', [KhuvucController::class, 'capnhap']);
        Route::post('/check-slug', [KhuvucController::class, 'checkslug']);
    });
    //Bàn
    Route::group(['prefix' => '/ban'], function () {
        Route::get('/', [BanController::class, 'index']);
        Route::get('/data', [BanController::class, 'getData']);
        Route::post('/doi-trang-thai', [BanController::class, 'doiTrangThai']);
        Route::post('/doi-trang-thai-2', [BanController::class, 'doiTrangThai2']);
        Route::post('/delete', [BanController::class, 'delete']);
        Route::post('/update', [BanController::class, 'update']);
        Route::post('/nhap', [BanController::class, 'store']);
        Route::post('/check-slug', [BanController::class, 'checkslug']);
    });

    //Danh Mục
    Route::group(['prefix' => '/danh-muc'], function () {
        Route::get('/', [DanhmucController::class, 'index']);
        Route::get('/data', [DanhmucController::class, 'getData']);
        Route::post('/doi-trang-thai', [DanhmucController::class, 'doitrangthai']);
        Route::post('/nhap', [DanhmucController::class, 'nhap']);
        Route::post('/xoa', [DanhmucController::class, 'xoa']);
        Route::post('cap-nhap', [DanhmucController::class, 'capnhap']);
        Route::post('/check-slug', [DanhmucController::class, 'checkslug']);

    });
    //menu
    Route::group(['prefix' => '/menu'], function () {
        Route::get('/', [MenuController::class, 'index']);
        Route::get('/data', [MenuController::class, 'getData']);
        Route::post('/doi-trang-thai', [MenuController::class, 'doitrangthai']);
        Route::post('/nhap', [MenuController::class, 'nhap']);
        Route::post('/xoa', [MenuController::class, 'xoa']);
        Route::post('/cap-nhap', [MenuController::class, 'capnhap']);
        Route::post('/check-slug', [MenuController::class, 'checkslug']);

        Route::post('/search', [MenuController::class, 'search']);
    });


    //code của bán hàng
    Route::group(['prefix' => '/ban-hang'], function () {


        Route::get('/', [HoadonbanhangController::class, 'index']);
        Route::post('/get-bankv', [HoadonbanhangController::class, 'getbankv']);
        Route::post('/tao-hoa-don', [HoadonbanhangController::class, 'store']);

        Route::post('/find-id-by-idban', [HoadonbanhangController::class, 'findidbyidban']);
        Route::post('/them-menu', [HoadonbanhangController::class, 'addmenuchitiethoadon']);
        Route::post('/danh-sach-menu-theo-hoa-don', [HoadonbanhangController::class, 'getdanhsachmenutheohoadon']);

        Route::post('/update', [HoadonbanhangController::class, 'update']);
        Route::post('/in-bep', [HoadonbanhangController::class, 'inbep']);
        Route::post('/xoa-chi-tiet', [HoadonbanhangController::class, 'xoachitietdonhang']);


        Route::post('/chi-tiet/update-chiet-khau', [ChitietbanhangController::class, 'UpdateChietKhau'])->name('1');
        Route::post('/danh-sach-menu-theo-id-ban', [ChitietbanhangController::class, 'getDanhSachMenuTheoIdBan'])->name('2');
        Route::post('/chuyen-menu', [ChitietbanhangController::class, 'ChuyenMenuQuaBanKhac'])->name('3');

        Route::post('/thanh-toan', [HoadonbanhangController::class, 'thanhtoan'])->name('6');
        Route::get('/in-bill/{id}', [HoadonbanhangController::class, 'inBill']);
        Route::post('/update-hoa-don', [HoadonbanhangController::class, 'giamgia'])->name('7');

    });

    Route::group(['prefix' => '/thong-ke'],function(){

        Route::get('/ban-hang',[ThongkeController::class,'viewThongKeBanHang']);
        Route::post('/ban-hang', [ThongkeController::class, 'actionThongKeBanHang'])->name('8');
        Route::post('/danh-sach-mon-theo-hoa-don-da-thanh-toan', [HoadonbanhangController::class, 'getdanhsachmenutheohoadondathanhtoan'])->name('9');

        Route::get('/mon-an',[ThongkeController::class,'viewThongKeMonAn']);
        Route::post('/mon-an', [ThongkeController::class, 'actionThongKeMonAn'])->name('10');
        Route::post('/chi-tiet-mon-an', [ThongkeController::class, 'actionChiTietMonAn'])->name('11');
    });

    // menu bep
    Route::group(['prefix' => '/bep'], function () {
        Route::get('/', [ChitietbanhangController::class, 'indexBep']);
        Route::get('/data-bep', [ChitietbanhangController::class, 'getDataBep']);
        Route::post('/update-bep', [ChitietbanhangController::class, 'updateBep']);
    });

    Route::group(['prefix' => '/quyen'], function () {
        Route::get('/', [QuyenController::class, 'index']);
        Route::get('/data', [QuyenController::class, 'getData']);
        Route::post('/delete', [QuyenController::class, 'destroy']);
        Route::post('/nhap', [QuyenController::class, 'nhap']);
        Route::post('update', [QuyenController::class, 'update']);

        Route::get('/danh-sach-chuc-nang',[QuyenController::class, 'danhsachchucnang']);
    });

    Route::group(['prefix' => '/tai-khoan'],function(){
        Route::get('/',[TaikhoanController::class,'index']);
        Route::get('/data', [TaikhoanController::class, 'getData']);
        Route::post('/nhap', [TaikhoanController::class, 'nhap']);
        Route::post('/xoa', [TaikhoanController::class, 'xoa']);
        Route::post('/capnhap', [TaikhoanController::class, 'capnhap']);
        Route::post('/change-password', [TaikhoanController::class, 'changePassword']);
    });

    //Khu Vực
    Route::group(['prefix' => '/vi-du'], function () {
        Route::get('/', [ViduController::class, 'index']);
        Route::get('/data', [ViduController::class, 'getData']);
        
    });


});
