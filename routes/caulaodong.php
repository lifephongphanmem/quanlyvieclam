<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\khaibaotuyendungController;
use App\Http\Controllers\thongbaoController;
use App\Http\Controllers\thongtintuyendungController;




Route::prefix('tuyen_dung')->group(function () {

//thông tin tổng hợp
Route::prefix('/thong_tin_tong_hop')->group(function () {
    Route::get('', [thongtintuyendungController::class, 'index']);
    Route::get('/edit/{id}', [thongtintuyendungController::class, 'edit']);
    Route::post('/store_update', [thongtintuyendungController::class, 'store_update']);
    Route::get('/delete/{id}', [thongtintuyendungController::class, 'delete']);
    //chi tiết
    Route::get('/chi_tiet', [thongtintuyendungController::class, 'detail']);
    Route::post('/tralai', [thongtintuyendungController::class, 'tralai']);
});

//  Khai báo tổng hợp
Route::prefix('/khai_bao_tong_hop')->group(function () {
    Route::get('', [khaibaotuyendungController::class, 'index']);
    //chi tiết
    Route::get('chi_tiet', [khaibaotuyendungController::class, 'detail']);
    Route::get('/them_moi', [khaibaotuyendungController::class, 'create']);
    Route::get('/chinh_sua', [khaibaotuyendungController::class, 'edit']);
    Route::post('/store_update', [khaibaotuyendungController::class, 'store_update']);
    Route::get('/xem', [khaibaotuyendungController::class, 'show']);
    Route::get('/delete/{id}', [khaibaotuyendungController::class, 'delete']);
    Route::get('/chuyen/{id}', [khaibaotuyendungController::class, 'chuyen']);
});
});

// thông báo 

Route::prefix('thong_bao')->group(function () {
    //người gửi
    Route::get('', [thongbaoController::class, 'index']);
    Route::get('/them_moi', [thongbaoController::class, 'create']);
    Route::post('/store', [thongbaoController::class, 'store']);
    Route::get('/chinh_sua', [thongbaoController::class, 'edit']);
    Route::post('/update', [thongbaoController::class, 'update']);
    Route::get('/delete/{id}', [thongbaoController::class, 'delete']);
    Route::post('/chuyen', [thongbaoController::class, 'chuyen']);
    // người nhận
    Route::get('danhsach', [thongbaoController::class, 'danhsach']);
});