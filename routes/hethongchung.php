<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Danhmuc\DmdonviController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Hethong\ChucnangController;
use App\Http\Controllers\Danhmuc\danhmuchanhchinhController;

//Đăng nhập
Route::get('/',[UserController::class,'dashboard']);
Route::get('/DangNhap',[UserController::class,'show_login']);
Route::post('/DangNhap',[UserController::class,'DangNhap']);
Route::post('/DangKy',[UserController::class,'DangKy']);
Route::get('/DangXuat',[UserController::class,'logout']);


//dmdonvi
Route::prefix('dmdonvi')->group(function () {
    Route::get('/danh_sach', [DmdonviController::class, 'index']);
    Route::get('/danh_sach_don_vi/{id}', [DmdonviController::class, 'detail']);
    Route::get('/create', [DmdonviController::class, 'create']);
    Route::post('/store', [DmdonviController::class, 'store']);
    Route::get('/edit/{id}', [DmdonviController::class, 'edit']);
    Route::post('/update/{id}', [DmdonviController::class, 'update']);
    Route::get('/delete/{id}', [DmdonviController::class, 'destroy']);
    Route::get('/dvql/{id}', [DmdonviController::class, 'dvql']);
    Route::post('/update_dvql/{id}', [DmdonviController::class, 'update_dvql']);
});

//Tài khoản đơn vị nhà nước
Route::prefix('TaiKhoan')->group(function () {
    Route::get('/ThongTin', [UserController::class, 'index_nn']);
    Route::get('/DanhSach', [UserController::class, 'chitiet']);
    Route::get('/ThemMoi', [UserController::class, 'create']);
    Route::post('/store', [UserController::class, 'store']);
    Route::get('/delete/{id}', [UserController::class, 'destroy']);
    Route::get('/edit_tk/{id}', [UserController::class, 'edit_tk']);
    Route::post('/update_tk/{id}', [UserController::class, 'update_tk']);
});

//danh mục chức năng
Route::prefix('Chuc_nang')->group(function () {
    Route::get('/Thong_tin', [ChucnangController::class, 'index']);
    Route::get('/create', [ChucnangController::class, 'create']);
    Route::post('/store', [ChucnangController::class, 'store']);
    Route::get('/edit/{id}', [ChucnangController::class, 'edit']);
    Route::post('/update/{id}', [ChucnangController::class, 'update']);
    Route::get('/destroy/{id}', [ChucnangController::class, 'destroy']);
});

Route::prefix('dia_ban')->group(function () {
    Route::get('/danhsach', [danhmuchanhchinhController::class, 'index']);
    Route::get('/edit/{id}', [danhmuchanhchinhController::class, 'edit']);
    Route::post('/store', [danhmuchanhchinhController::class, 'store']);
    Route::post('/update/{id}', [danhmuchanhchinhController::class, 'update']);
    Route::get('/delete/{id}', [danhmuchanhchinhController::class, 'destroy']);
});