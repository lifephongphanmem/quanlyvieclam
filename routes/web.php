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
use App\Http\Controllers\UserController; 
use App\Http\Controllers\CompanyController; 
use App\Http\Controllers\EmployerController; 
use App\Http\Controllers\ReportController; 
use App\Http\Controllers\TuyendungController; 
use App\Http\Controllers\MessagesController; 
use App\Http\Controllers\DichvuController; 

use App\Http\Controllers\AdminController; 
use App\Http\Controllers\AdminCompany; 
use App\Http\Controllers\AdminTuyendung; 
use App\Http\Controllers\AdminDanhmuchanhchinh; 
use App\Http\Controllers\AdminParamtype; 
use App\Http\Controllers\AdminParam; 
use App\Http\Controllers\AdminUser; 
use App\Http\Controllers\AdminReport; 
use App\Http\Controllers\AdminMessages; 
use App\Http\Controllers\AdminDichvu; 
use App\Http\Controllers\AdminEmployer;
use App\Http\Controllers\ChucnangController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\cunglaodong_huyenController;
use App\Http\Controllers\cunglaodong_tinh;
use App\Http\Controllers\cunglaodong_tinhController;
use App\Http\Controllers\cunglaodongController;
use App\Http\Controllers\danhmuchanhchinhController;
use App\Http\Controllers\dmchuyenmondaotaoController;
use App\Http\Controllers\DmdonviController;
use App\Http\Controllers\dmhinhthuclamviecController;
use App\Http\Controllers\messageCotroller;
use App\Http\Controllers\nghecongviecController;
use App\Http\Controllers\nguoilaodongController;
use App\Models\dmdonvi;
use PHPUnit\TextUI\XmlConfiguration\Group;

// Frontend SECTION


Route::get('/', [UserController::class, 'show_login' ]);

Route::get('/home',[UserController::class, 'show_login' ]);

Route::post('/login-user', [UserController::class, 'auth' ]);
Route::post('/signup', [UserController::class, 'signup' ]);
Route::get('/logout', [UserController::class, 'logout' ]);
Route::get('/user-fe',[UserController::class, 'edit' ]);
Route::post('/user-fu',[UserController::class, 'update' ]);

// Nguoi dung


// Doanh nghiep
Route::get('/doanhnghiep/thongtin',[CompanyController::class,'show']);
Route::get('/doanhnghiep/nguoilaodong',[CompanyController::class,'nguoilaodong']);
Route::get('/companydownload',[CompanyController::class,'download']);
Route::post('/doanhnghiep-fu',[CompanyController::class,'update']);

// nguoi lao dong
Route::get('/laodong-fa/{action?}', [EmployerController::class,'show_all']);
Route::post('/laodong-fs', [EmployerController::class,'save']);
Route::get('/laodong-fn', [EmployerController::class,'new']);
Route::get('/laodong-fe/{eid?}/{action?}', [EmployerController::class,'edit']);
Route::post('/laodong-fu', [EmployerController::class,'update']);
Route::post('/laodong-fi', [EmployerController::class,'import']);
Route::get('laodong-ex/', [EmployerController::class,'export']);
Route::get('laodong-fnothing/', [EmployerController::class,'noreport']);

// bao cao
Route::get('/report-fa', [ReportController::class,'show_all']);

//tuyen dung
Route::get('/tuyendung-fa', [TuyendungController::class,'show_all']);
Route::get('/tuyendung-fn', [TuyendungController::class,'new']);
Route::get('/tuyendung-fe/{tdid}', [TuyendungController::class,'edit']);
Route::post('/tuyendung-fs', [TuyendungController::class,'save']);
Route::post('/tuyendung-fru', [TuyendungController::class,'updatebaocao']);
Route::get('/tuyendung-fr/{tdid}', [TuyendungController::class,'baocao']);
// messenger

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', [MessagesController::class,'index'])->name('messages');
    Route::get('create', [MessagesController::class,'create']);
    Route::post('store', [MessagesController::class,'store']);
    Route::get('{id}', [MessagesController::class,'show'])->name('messages.show');
    Route::put('{id}', [MessagesController::class,'update'])->name('messages.update');
});


//tuyen dung
Route::get('/dichvu-fa', [DichvuController::class,'show_all']);
Route::get('/dichvu-fr/{eid?}', [DichvuController::class,'dangky']);
// messenger





// Backend SECTION

Route::get('/admin', [AdminController::class, 'login' ])->name('login');
Route::get('/dashboard', [AdminController::class, 'dashboard' ]);

Route::post('/login-admin', [AdminController::class, 'auth' ]);
Route::get('/logout-admin', [AdminController::class, 'logout' ]);

// Doanh nghiep

Route::get('/doanhnghiep-ba',[AdminCompany::class,'show_all']);
Route::get('/doanhnghiep-bs',[AdminCompany::class,'save']);
Route::get('/ doanhnghiep-bn',[AdminCompany::class,'new']);
Route::get('/doanhnghiep-be/{cid}',[AdminCompany::class,'edit']);
Route::post('/doanhnghiep-bu/{cid}',[AdminCompany::class,'update']);
Route::get('/doanhnghiep-br/{cid}',[AdminCompany::class,'baocao145']);

// Người lao động

Route::get('/employer-ba/{cid?}',[AdminEmployer::class,'show_all']);
Route::get('/employer-bs',[AdminEmployer::class,'save']);
Route::get('/ employer-bn',[AdminEmployer::class,'new']);
Route::get('/employer-be/{cid}',[AdminEmployer::class,'edit']);
Route::post('/employer-bu/{cid}',[AdminEmployer::class,'update']);

// Tuyen dụng 

Route::get('/tuyendung-ba/{cid?}',[AdminTuyendung::class,'show_all']); // all

Route::get('/tuyendung-bu/{tdid}',[AdminTuyendung::class,'duyet']); // duyet

Route::get('/tuyendung-be/{tdid}',[AdminTuyendung::class,'edit']); // edit

// Tham số

Route::get('/ptype-ba',[AdminParamtype::class,'show_all']);

Route::get('/ptype-be/{catid}',[AdminParamtype::class,'edit']);

Route::get('/ptype-bd/{catid}',[AdminParamtype::class,'delete']);

Route::get('/ptype-bn/',[AdminParamtype::class,'new']);

Route::post('/ptype-bs/',[AdminParamtype::class,'save']);

Route::post('/ptype-bu/',[AdminParamtype::class,'update']);

// gia tri tham so

Route::get('/param-ba/{catid}',[AdminParam::class,'show_all']);

Route::get('/param-be/{pid}',[AdminParam::class,'edit']);

Route::get('/param-bd/{pid}',[AdminParam::class,'delete']);

Route::get('/param-bn/{catid}',[AdminParam::class,'new']);

Route::post('/param-bs/',[AdminParam::class,'save']);

Route::post('/param-bu/',[AdminParam::class,'update']);


// Ngươi dung

Route::get('/user-ba/',[AdminUser::class,'show_all']);

Route::get('/user-be/{uid}',[AdminUser::class,'edit']);

Route::get('/user-bd/{uid}',[AdminUser::class,'delete']);

Route::get('/user-bn/',[AdminUser::class,'new']);

Route::post('/user-bs/',[AdminUser::class,'save']);

Route::post('/user-bu/',[AdminUser::class,'update']);


// danh muc hanh chinh

Route::get('/dmhc-ba',[AdminDanhmuchanhchinh::class,'show_all']);

Route::get('/dmhc-bac/{catid}',[AdminDanhmuchanhchinh::class,'show_allchild']);

Route::get('/dmhc-be/{catid}',[AdminDanhmuchanhchinh::class,'edit']);

Route::get('/dmhc-bd/{catid}',[AdminDanhmuchanhchinh::class,'delete']);

Route::get('/dmhc-bn/',[AdminDanhmuchanhchinh::class,'new']);
Route::get('/dmhc-bnc/{catid}',[AdminDanhmuchanhchinh::class,'newchild']);

Route::post('/dmhc-bs/',[AdminDanhmuchanhchinh::class,'save']);

Route::post('/dmhc-bi/',[AdminDanhmuchanhchinh::class,'import']);

Route::post('/dmhc-bu/',[AdminDanhmuchanhchinh::class,'update']);

// Lao động Biến động
Route::get('/report-ba/{cid?}',[AdminReport::class,'show_all']);

Route::get('/report-be/{id}',[AdminReport::class,'edit']);


Route::group(['prefix' => 'admessages'], function () {
    Route::get('/', [AdminMessages::class,'index'])->name('admessages');
    Route::get('create', [AdminMessages::class,'create'])->name('admessages.create');
    Route::post('/', [AdminMessages::class,'store'])->name('admessages.store');
    Route::get('{id}', [AdminMessages::class,'show'])->name('admessages.show');
    Route::put('{id}', [AdminMessages::class,'update'])->name('admessages.update');
});


Route::get('/dichvu-ba/{cid?}',[AdminDichvu::class,'show_all']);
Route::get('/dichvudk-ba/{dvid}',[AdminDichvu::class,'show_dk']);
Route::get('/dichvu-be/{uid}',[AdminDichvu::class,'edit']);
Route::get('/dichvu-bd/{uid}',[AdminDichvu::class,'delete']);
Route::get('/dichvu-bn/',[AdminDichvu::class,'new']);
Route::post('/dichvu-bs/',[AdminDichvu::class,'save']);
Route::post('/dichvu-bu/',[AdminDichvu::class,'update']);

//Danh mục chuyên môn đào tạo
Route::prefix('dm_chuyen_mon_dao_tao')->group(function(){
    Route::get('/',[dmchuyenmondaotaoController::class,'index']);
    Route::post('/store',[dmchuyenmondaotaoController::class,'store']);
    Route::post('/update/{id}',[dmchuyenmondaotaoController::class,'update']);
    Route::get('/delete/{id}',[dmchuyenmondaotaoController::class,'destroy']);
});

Route::prefix('nghe_cong_viec')->group(function(){
    Route::get('/',[nghecongviecController::class,'index']);
    Route::post('/store',[nghecongviecController::class,'store']);
    Route::post('/update/{id}',[nghecongviecController::class,'update']);
    Route::get('/delete/{id}',[nghecongviecController::class,'destroy']);
});

Route::prefix('dm_hinh_thuc_cong_viec')->group(function(){
    Route::get('/',[dmhinhthuclamviecController::class,'index']);
    Route::post('/store',[dmhinhthuclamviecController::class,'store']);
    Route::post('/update/{id}',[dmhinhthuclamviecController::class,'update']);
    Route::get('/delete/{id}',[dmhinhthuclamviecController::class,'destroy']);
});
//dmdonvi
Route::prefix('dmdonvi')->group(function(){
    Route::get('/danh_sach',[DmdonviController::class,'index']);
    Route::get('/danh_sach_don_vi/{id}',[DmdonviController::class,'detail']);
    Route::get('/create',[DmdonviController::class,'create']);
    Route::post('/store',[DmdonviController::class,'store']);
    Route::get('/edit/{id}',[DmdonviController::class,'edit']);
    Route::post('/update/{id}',[DmdonviController::class,'update']);
    Route::get('/delete/{id}',[DmdonviController::class,'destroy']);
    Route::get('/dvql/{id}',[DmdonviController::class,'dvql']);
    Route::post('/update_dvql/{id}',[DmdonviController::class,'update_dvql']);
});

//Tài khoản đơn vị nhà nước
Route::prefix('TaiKhoan')->group(function(){
    Route::get('/ThongTin',[UserController::class,'index_nn']);
    Route::get('/DanhSach',[UserController::class,'chitiet']);
    Route::get('/ThemMoi',[UserController::class,'create']);
    Route::post('/store',[UserController::class,'store']);
    Route::get('/delete/{id}',[UserController::class,'destroy']);
    Route::get('/edit_tk/{id}',[UserController::class,'edit_tk']);
    Route::post('/update_tk/{id}',[UserController::class,'update_tk']);
});

//danh mục chức năng
Route::prefix('Chuc_nang')->group(function(){
    Route::get('/Thong_tin',[ChucnangController::class,'index']);
    Route::get('/create',[ChucnangController::class,'create']);
    Route::post('/store',[ChucnangController::class,'store']);
    Route::get('/edit/{id}',[ChucnangController::class,'edit']);
    Route::post('/update/{id}',[ChucnangController::class,'update']);
    Route::get('/destroy/{id}',[ChucnangController::class,'destroy']);
});

// Danh mục địa bàn
Route::prefix('dia_ban')->group(function(){
    Route::get('/',[danhmuchanhchinhController::class,'index']);
    Route::get('/edit/{id}',[danhmuchanhchinhController::class,'edit']);
    Route::post('/store',[danhmuchanhchinhController::class,'store']);
    Route::post('/update/{id}',[danhmuchanhchinhController::class,'update']);
    Route::get('/delete/{id}',[danhmuchanhchinhController::class,'destroy']);
});

//thông tin người lao động
Route::prefix('nguoilaodong')->group(function(){
    Route::get('/',[nguoilaodongController::class,'index']);
    Route::get('/nuoc_ngoai',[nguoilaodongController::class,'index_nuocngoai']);
    Route::get('/them_moi',[nguoilaodongController::class,'create']);
    Route::get('/edit/{id}',[nguoilaodongController::class,'edit']);
    Route::post('/store',[nguoilaodongController::class,'store']);
    Route::post('/update/{id}',[nguoilaodongController::class,'update']);
    Route::get('/delete/{id}',[nguoilaodongController::class,'destroy']);

    Route::prefix('nuoc_ngoai')->group(function(){
        Route::get('/',[nguoilaodongController::class,'index_nuocngoai']);
        Route::get('/create',[nguoilaodongController::class,'create_nuocngoai']);
        Route::get('/edit/{id}',[nguoilaodongController::class,'edit_nuocngoai']);
        Route::post('/store',[nguoilaodongController::class,'store_nuocngoai']);
        Route::post('/update/{id}',[nguoilaodongController::class,'update_nuocngoai']);
        Route::get('/delete/{id}',[nguoilaodongController::class,'destroy_nuocngoai']);
    });
});

//Cung lao động
Route::prefix('cungld')->group(function(){
    Route::prefix('thongbao')->group(function(){
        Route::get('/',[messageCotroller::class,'index']);
        Route::get('/create',[messageCotroller::class,'create']);
        Route::get('/edit/{id}',[messageCotroller::class,'edit']);
        Route::post('/store',[messageCotroller::class,'store']);
        Route::post('/update/{id}',[messageCotroller::class,'update']);
        Route::get('/delete/{id}',[messageCotroller::class,'destroy']);
        Route::get('/chitiet/{id}',[messageCotroller::class,'show']);
        Route::post('/send/{id}',[messageCotroller::class,'guithongbao']);
    });
    // Tổng hợp danh sách  cung lao động
    Route::prefix('danh_sach')->group(function(){
        Route::prefix('don_vi')->group(function(){
            Route::get('/',[cunglaodongController::class,'index']);
            Route::get('/create',[cunglaodongController::class,'create']);
            Route::get('/edit/{id}',[cunglaodongController::class,'edit']);
            Route::post('/store',[cunglaodongController::class,'store']);
            Route::post('/update/{id}',[cunglaodongController::class,'update']);
            Route::get('/delete/{id}',[cunglaodongController::class,'destroy']);
            Route::get('/chi_tiet/{id}',[cunglaodongController::class,'show']);
            Route::post('/send/{id}',[cunglaodongController::class,'senddata']);
            Route::get('/lydo/{id}',[cunglaodongController::class,'lydo']);
        });
        Route::prefix('huyen')->group(function(){
            Route::get('/',[cunglaodong_huyenController::class,'index']);
            Route::get('/tong_hop',[cunglaodong_huyenController::class,'tonghop']);
            Route::post('/send',[cunglaodong_huyenController::class,'sendata']);
            Route::post('/tralai',[cunglaodong_huyenController::class,'tralai']);
            Route::get('/lydo',[cunglaodong_huyenController::class,'lydo']);

            Route::get('/in',[cunglaodong_huyenController::class,'indanhsach']);
            Route::get('/intonghop',[cunglaodong_huyenController::class,'intonghop']);
        });

        Route::prefix('tinh')->group(function(){
            Route::get('/',[cunglaodong_tinhController::class,'index']);
            Route::get('/tong_hop',[cunglaodong_tinhController::class,'show']);
            Route::post('/tralai',[cunglaodong_tinhController::class,'tralai']);

            Route::get('/intonghop',[cunglaodong_tinhController::class,'intonghop']);
            Route::get('/intonghop_tinh',[cunglaodong_tinhController::class,'intonghop_tinh']);
        });
       
    });
});

