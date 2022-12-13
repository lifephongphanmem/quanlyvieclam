<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




use App\Http\Controllers\messageCotroller;
use App\Http\Controllers\nguoilaodongController;
use App\Http\Controllers\nhucautuyendung;
use App\Http\Controllers\nhucautuyendungController;
use App\Http\Controllers\nhucautuyendungctController;
use App\Models\thongbao;
use PHPUnit\TextUI\XmlConfiguration\Group;


include('route_cu.php');

include('cunglaodong.php');
include('danhmuc.php');
include('caulaodong.php');
include('hethongchung.php');
include('tinhhinhsudunglaodong.php');
include('nguoilaodong.php');
include('doanhnghiep.php');
include('baocao.php');
include('thongbao.php');
include('tracuu.php');
include('dubao.php');






















// Tuyển dụng

// thông báo 

// Route::prefix('thong_bao')->group(function () {
//     //người gửi
//     Route::get('', [thongbaoController::class, 'index']);
//     Route::get('/them_moi', [thongbaoController::class, 'create']);
//     Route::post('/store', [thongbaoController::class, 'store']);
//     Route::get('/chinh_sua', [thongbaoController::class, 'edit']);
//     Route::post('/update', [thongbaoController::class, 'update']);
//     Route::get('/delete/{id}', [thongbaoController::class, 'delete']);
//     Route::post('/chuyen', [thongbaoController::class, 'chuyen']);
//     // người nhận
//     Route::get('danhsach', [thongbaoController::class, 'danhsach']);
// });

// báo cáo tổng hợp








