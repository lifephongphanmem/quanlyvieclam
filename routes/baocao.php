<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\baocaotonghopController;


Route::prefix('bao_cao')->group(function () {
    Route::prefix('nguoi_su_dung_lao_dong')->group(function () {
        Route::get('dn_bao_cao', [baocaotonghopController::class, 'dnbaocao']);
        Route::get('dn_tong_hop', [baocaotonghopController::class, 'dntonghop']);
    });
    Route::prefix('so_lao_dong_thuong_binh_xa_hoi')->group(function () {
        Route::get('ldtbxh_bao_cao', [baocaotonghopController::class, 'ldtbxhbaocao']);
        Route::get('ldtbxh_tong_hop', [baocaotonghopController::class, 'ldtbxhtonghop']);
    });
});
