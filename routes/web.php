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


// Frontend SECTION


Route::get('/', [UserController::class, 'show_login']);

Route::get('/home', [UserController::class, 'show_login']);

Route::post('/login-user', [UserController::class, 'auth']);
Route::post('/signup', [UserController::class, 'signup']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/user-fe', [UserController::class, 'edit']);
Route::post('/user-fu', [UserController::class, 'update']);

// Nguoi dung


// Doanh nghiep
Route::get('/doanhnghiep/thongtin', [CompanyController::class, 'show']);
Route::get('/doanhnghiep/nguoilaodong', [CompanyController::class, 'nguoilaodong']);
Route::get('/companydownload', [CompanyController::class, 'download']);
Route::post('/doanhnghiep-fu', [CompanyController::class, 'update']);

// nguoi lao dong
Route::get('/laodong-fa/{action?}', [EmployerController::class, 'show_all']);
Route::post('/laodong-fs', [EmployerController::class, 'save']);
Route::get('/laodong-fn', [EmployerController::class, 'new']);
Route::get('/laodong-fe/{eid?}/{action?}', [EmployerController::class, 'edit']);
Route::post('/laodong-fu', [EmployerController::class, 'update']);
Route::post('/laodong-fi', [EmployerController::class, 'import']);
Route::get('laodong-ex/', [EmployerController::class, 'export']);
Route::get('laodong-fnothing/', [EmployerController::class, 'noreport']);

// bao cao
Route::get('/report-fa', [ReportController::class, 'show_all']);

//tuyen dung
Route::get('/tuyendung-fa', [TuyendungController::class, 'show_all']);
Route::get('/tuyendung-fn', [TuyendungController::class, 'new']);
Route::get('/tuyendung-fe/{tdid}', [TuyendungController::class, 'edit']);
Route::post('/tuyendung-fs', [TuyendungController::class, 'save']);
Route::post('/tuyendung-fru', [TuyendungController::class, 'updatebaocao']);
Route::get('/tuyendung-fr/{tdid}', [TuyendungController::class, 'baocao']);
// messenger

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', [MessagesController::class, 'index'])->name('messages');
    Route::get('create', [MessagesController::class, 'create']);
    Route::post('store', [MessagesController::class, 'store']);
    Route::get('{id}', [MessagesController::class, 'show'])->name('messages.show');
    Route::put('{id}', [MessagesController::class, 'update'])->name('messages.update');
});


//tuyen dung
Route::get('/dichvu-fa', [DichvuController::class, 'show_all']);
Route::get('/dichvu-fr/{eid?}', [DichvuController::class, 'dangky']);
// messenger





// Backend SECTION

Route::get('/admin', [AdminController::class, 'login'])->name('login');
Route::get('/dashboard', [AdminController::class, 'dashboard']);

Route::post('/login-admin', [AdminController::class, 'auth']);
Route::get('/logout-admin', [AdminController::class, 'logout']);

// Doanh nghiep

Route::get('/doanhnghiep-ba', [AdminCompany::class, 'show_all']);
Route::get('/doanhnghiep-bs', [AdminCompany::class, 'save']);
Route::get('/ doanhnghiep-bn', [AdminCompany::class, 'new']);
Route::get('/doanhnghiep-be/{cid}', [AdminCompany::class, 'edit']);
Route::post('/doanhnghiep-bu/{cid}', [AdminCompany::class, 'update']);
Route::get('/doanhnghiep-br/{cid}', [AdminCompany::class, 'baocao145']);

// Người lao động

Route::get('/employer-ba/{cid?}', [AdminEmployer::class, 'show_all']);
Route::get('/employer-bs', [AdminEmployer::class, 'save']);
Route::get('/ employer-bn', [AdminEmployer::class, 'new']);
Route::get('/employer-be/{cid}', [AdminEmployer::class, 'edit']);
Route::post('/employer-bu/{cid}', [AdminEmployer::class, 'update']);

// Tuyen dụng 

Route::get('/tuyendung-ba/{cid?}', [AdminTuyendung::class, 'show_all']); // all

Route::get('/tuyendung-bu/{tdid}', [AdminTuyendung::class, 'duyet']); // duyet

Route::get('/tuyendung-be/{tdid}', [AdminTuyendung::class, 'edit']); // edit

// Tham số

Route::get('/ptype-ba', [AdminParamtype::class, 'show_all']);

Route::get('/ptype-be/{catid}', [AdminParamtype::class, 'edit']);

Route::get('/ptype-bd/{catid}', [AdminParamtype::class, 'delete']);

Route::get('/ptype-bn/', [AdminParamtype::class, 'new']);

Route::post('/ptype-bs/', [AdminParamtype::class, 'save']);

Route::post('/ptype-bu/', [AdminParamtype::class, 'update']);

// gia tri tham so

Route::get('/param-ba/{catid}', [AdminParam::class, 'show_all']);

Route::get('/param-be/{pid}', [AdminParam::class, 'edit']);

Route::get('/param-bd/{pid}', [AdminParam::class, 'delete']);

Route::get('/param-bn/{catid}', [AdminParam::class, 'new']);

Route::post('/param-bs/', [AdminParam::class, 'save']);

Route::post('/param-bu/', [AdminParam::class, 'update']);


// Ngươi dung

Route::get('/user-ba/', [AdminUser::class, 'show_all']);

Route::get('/user-be/{uid}', [AdminUser::class, 'edit']);

Route::get('/user-bd/{uid}', [AdminUser::class, 'delete']);

Route::get('/user-bn/', [AdminUser::class, 'new']);

Route::post('/user-bs/', [AdminUser::class, 'save']);

Route::post('/user-bu/', [AdminUser::class, 'update']);


// danh muc hanh chinh

Route::get('/dmhc-ba', [AdminDanhmuchanhchinh::class, 'show_all']);

Route::get('/dmhc-bac/{catid}', [AdminDanhmuchanhchinh::class, 'show_allchild']);

Route::get('/dmhc-be/{catid}', [AdminDanhmuchanhchinh::class, 'edit']);

Route::get('/dmhc-bd/{catid}', [AdminDanhmuchanhchinh::class, 'delete']);

Route::get('/dmhc-bn/', [AdminDanhmuchanhchinh::class, 'new']);
Route::get('/dmhc-bnc/{catid}', [AdminDanhmuchanhchinh::class, 'newchild']);

Route::post('/dmhc-bs/', [AdminDanhmuchanhchinh::class, 'save']);

Route::post('/dmhc-bi/', [AdminDanhmuchanhchinh::class, 'import']);

Route::post('/dmhc-bu/', [AdminDanhmuchanhchinh::class, 'update']);

// Lao động Biến động
Route::get('/report-ba/{cid?}', [AdminReport::class, 'show_all']);

Route::get('/report-be/{id}', [AdminReport::class, 'edit']);


Route::group(['prefix' => 'admessages'], function () {
    Route::get('/', [AdminMessages::class, 'index'])->name('admessages');
    Route::get('create', [AdminMessages::class, 'create'])->name('admessages.create');
    Route::post('/', [AdminMessages::class, 'store'])->name('admessages.store');
    Route::get('{id}', [AdminMessages::class, 'show'])->name('admessages.show');
    Route::put('{id}', [AdminMessages::class, 'update'])->name('admessages.update');
});



Route::get('/dichvu-ba/{cid?}', [AdminDichvu::class, 'show_all']);
Route::get('/dichvudk-ba/{dvid}', [AdminDichvu::class, 'show_dk']);

Route::get('/dichvu-be/{uid}', [AdminDichvu::class, 'edit']);

Route::get('/dichvu-bd/{uid}', [AdminDichvu::class, 'delete']);

Route::get('/dichvu-bn/', [AdminDichvu::class, 'new']);

Route::post('/dichvu-bs/', [AdminDichvu::class, 'save']);

Route::post('/dichvu-bu/', [AdminDichvu::class, 'update']);

// Danh mục 
Route::prefix('danh_muc')->group(function () {
    // đối tượng ưu tiên
    Route::prefix('/dm_doi_tuong')->group(function () {
        Route::get('', [dmdoituonguutienController::class, 'index']);
        Route::post('/store_update', [dmdoituonguutienController::class, 'store_update']);
        Route::get('/delete/{id}', [dmdoituonguutienController::class, 'delete']);
        Route::get('/edit/{id}', [dmdoituonguutienController::class, 'edit']);
    });
    // loại lao động
    Route::prefix('/dm_loai_lao_dong')->group(function () {
        Route::get('', [dmloailaodongController::class, 'index']);
        Route::post('/store_update', [dmloailaodongController::class, 'store_update']);
        Route::get('/delete/{id}', [dmloailaodongController::class, 'delete']);
        Route::get('/edit/{id}', [dmloailaodongController::class, 'edit']);
    });

    // trình độ GDPT đạt được
    Route::prefix('/dm_trinh_do_gdpt')->group(function () {
        Route::get('', [dmtrinhdogdptController::class, 'index']);
        Route::post('/store_update', [dmtrinhdogdptController::class, 'store_update']);
        Route::get('/delete/{id}', [dmtrinhdogdptController::class, 'delete']);
        Route::get('/edit/{id}', [dmtrinhdogdptController::class, 'edit']);
    });
    // trình độ chuyên môn kỹ thuật
    Route::prefix('/dm_trinh_do_ky_thuat')->group(function () {
        Route::get('', [dmtrinhdokythuatController::class, 'index']);
        Route::post('/store_update', [dmtrinhdokythuatController::class, 'store_update']);
        Route::get('/delete/{id}', [dmtrinhdokythuatController::class, 'delete']);
        Route::get('/edit/{id}', [dmtrinhdokythuatController::class, 'edit']);
    });
    // tình trạng tham gia hoạt động kin tế
    Route::prefix('/dm_tinh_trang_tham_gia_hdkt')->group(function () {
        Route::get('', [dmtinhtrangthamgiahdktController::class, 'index']);
        Route::post('/store_update', [dmtinhtrangthamgiahdktController::class, 'store_update']);
        Route::get('/delete/{id}', [dmtinhtrangthamgiahdktController::class, 'delete']);
        Route::get('/edit/{id}', [dmtinhtrangthamgiahdktController::class, 'edit']);
        // chi tiết
        Route::prefix('/chi_tiet')->group(function () {
            Route::get('', [dmtinhtrangthamgiahdktController::class, 'index_ct']);
            Route::post('/store_update', [dmtinhtrangthamgiahdktController::class, 'store_update_ct']);
            Route::get('/delete/{manhom}', [dmtinhtrangthamgiahdktController::class, 'delete_ct']);
            Route::get('/edit/{id}', [dmtinhtrangthamgiahdktController::class, 'edit_ct']);
        });
        // chi tiết 2
        Route::prefix('/chi_tiet_2')->group(function () {
            Route::get('', [dmtinhtrangthamgiahdktController::class, 'index_ct2']);
            Route::post('/store_update', [dmtinhtrangthamgiahdktController::class, 'store_update_ct2']);
            Route::get('/delete/{manhom}', [dmtinhtrangthamgiahdktController::class, 'delete_ct2']);
            Route::get('/edit/{id}', [dmtinhtrangthamgiahdktController::class, 'edit_ct2']);
        });
    });

    // loại hình hoạt động kinh tế
    Route::prefix('/dm_loai_hinh_hdkt')->group(function () {
        Route::get('', [dmloaihinhhdktController::class, 'index']);
        Route::post('/store_update', [dmloaihinhhdktController::class, 'store_update']);
        Route::get('/delete/{id}', [dmloaihinhhdktController::class, 'delete']);
        Route::get('/edit/{id}', [dmloaihinhhdktController::class, 'edit']);
    });

    // thười gian thất nghiệp
    Route::prefix('/dm_thoi_gian_that_nghiep')->group(function () {
        Route::get('', [dmthoigianthatnghiepController::class, 'index']);
        Route::post('/store_update', [dmthoigianthatnghiepController::class, 'store_update']);
        Route::get('/delete/{id}', [dmthoigianthatnghiepController::class, 'delete']);
        Route::get('/edit/{id}', [dmthoigianthatnghiepController::class, 'edit']);
    });
    // ngành sản xuất kinh doanh
    Route::prefix('/dm_nganh_san_xuat_kinh_doanh')->group(function () {
        Route::get('', [dmnganhsxkdController::class, 'index']);
        Route::post('/store_update', [dmnganhsxkdController::class, 'store_update']);
        Route::get('/delete/{id}', [dmnganhsxkdController::class, 'delete']);
        Route::get('/edit/{id}', [dmnganhsxkdController::class, 'edit']);
    });
    // loai hiệu lực hợp đồng lao động
    Route::prefix('/dm_loai_hieu_luc_hdld')->group(function () {
        Route::get('', [dmloaihieuluchdldController::class, 'index']);
        Route::post('/store_update', [dmloaihieuluchdldController::class, 'store_update']);
        Route::get('/delete/{id}', [dmloaihieuluchdldController::class, 'delete']);
        Route::get('/edit/{id}', [dmloaihieuluchdldController::class, 'edit']);
    });
    // mã nghề, trình độ
    Route::prefix('/dm_ma_nghe_trinh_do')->group(function () {
        Route::get('', [dmmanghetrinhdoController::class, 'index']);
        Route::post('/store_update', [dmmanghetrinhdoController::class, 'store_update']);
        Route::get('/delete/{id}', [dmmanghetrinhdoController::class, 'delete']);
        Route::get('/edit/{id}', [dmmanghetrinhdoController::class, 'edit']);
    });
});

Route::get('/dichvu-ba/{cid?}', [AdminDichvu::class, 'show_all']);
Route::get('/dichvudk-ba/{dvid}', [AdminDichvu::class, 'show_dk']);
Route::get('/dichvu-be/{uid}', [AdminDichvu::class, 'edit']);
Route::get('/dichvu-bd/{uid}', [AdminDichvu::class, 'delete']);
Route::get('/dichvu-bn/', [AdminDichvu::class, 'new']);
Route::post('/dichvu-bs/', [AdminDichvu::class, 'save']);
Route::post('/dichvu-bu/', [AdminDichvu::class, 'update']);


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



// Tuyển dụng

Route::prefix('tuyen_dung')->group(function () {
    //thông báo
    Route::get('damh_sach_thong_bao', [thongbaoController::class, 'thongbaodagui']);
    // khai bao
    Route::prefix('/khai_bao_nhu_cau')->group(function () {
        Route::get('dot_thu_thap', [thongbaoController::class, 'khaibao']);

        Route::get('', [nhucautuyendungController::class, 'index_khaibao']);
        Route::get('/them_moi', [nhucautuyendungController::class, 'create']);
        Route::post('/store', [nhucautuyendungController::class, 'store']);
        Route::get('/chinh_sua', [nhucautuyendungController::class, 'edit']);
        Route::post('/update', [nhucautuyendungController::class, 'update']);
        Route::post('/chuyen', [nhucautuyendungController::class, 'chuyen']);
        Route::get('/xem', [nhucautuyendungController::class, 'show']);
        Route::get('/delete/{id}', [nhucautuyendungController::class, 'delete']);
        //chi tiết
        Route::post('/store_ct', [nhucautuyendungctController::class, 'store']);
        Route::get('/edit_ct', [nhucautuyendungctController::class, 'edit']);
        Route::post('/update_ct', [nhucautuyendungctController::class, 'update']);
        Route::get('/delete_ct', [nhucautuyendungctController::class, 'delete']);
    });
    // tổng hợp
    Route::prefix('/thong_tin_tong_hop')->group(function () {
        Route::get('dot_thu_thap', [thongbaoController::class, 'tonghop']);
   
        Route::get('/them_moi', [thongbaoController::class, 'create']);
        Route::post('/store', [thongbaoController::class, 'store']);
        Route::get('/chinh_sua', [thongbaoController::class, 'edit']);
        Route::post('/update', [thongbaoController::class, 'update']);
        Route::get('/delete/{id}', [thongbaoController::class, 'delete']);
        Route::post('/chuyen', [thongbaoController::class, 'chuyen']);

        Route::get('', [nhucautuyendungController::class, 'index_tonghop']);
        Route::post('/tralai', [nhucautuyendungController::class, 'tralai']);
    });


});

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

Route::prefix('bao_cao_tong_hop')->group(function () {
    Route::get('', [baocaotonghopController::class, 'index']);
    // tổng hợp
    Route::get('nguoi_su_dung_lao_dong', [baocaotonghopController::class, 'doanhnghiep']);
    Route::get('so_lao_dong_thuong_binh_xa_hoi', [baocaotonghopController::class, 'soldtbxh']);
    //mẫu báo cáo
    Route::get('thong_tin_cung_lao_dong', [baocaotonghopController::class, 'thongtincungld']);
    Route::get('thong_tin_nguoi_lao_dong_nuoc_ngoai', [baocaotonghopController::class, 'laodongnuocngoai']);
    Route::get('tinh_hinh_su_dung_lao_dong', [baocaotonghopController::class, 'tinhhinhsudungld']);
    Route::get('ds_thong_tin_cung_ld', [baocaotonghopController::class, 'dsttcungld']);
    Route::get('thong_tin_nhu_cau_tuyen_dung', [baocaotonghopController::class, 'nhucautuyendungld']);
    Route::get('tong_hop_cung_ld_cap_xa_huyen', [baocaotonghopController::class, 'cungldcapxahuyen']);
    Route::get('thonh_tin_thi_truong_ld', [baocaotonghopController::class, 'thongtinthitruongld']);
});

// Danh mục địa bàn
Route::prefix('dia_ban')->group(function () {
    Route::get('/', [danhmuchanhchinhController::class, 'index']);
    Route::get('/edit/{id}', [danhmuchanhchinhController::class, 'edit']);
    Route::post('/store', [danhmuchanhchinhController::class, 'store']);
    Route::post('/update/{id}', [danhmuchanhchinhController::class, 'update']);
    Route::get('/delete/{id}', [danhmuchanhchinhController::class, 'destroy']);
});

//thông tin người lao động
Route::prefix('nguoilaodong')->group(function () {
    Route::get('', [nguoilaodongController::class, 'index']);
    Route::get('/them_moi', [nguoilaodongController::class, 'create']);
    Route::get('/edit/{id}', [nguoilaodongController::class, 'edit']);
    Route::post('/store', [nguoilaodongController::class, 'store']);
    Route::post('/update/{id}', [nguoilaodongController::class, 'update']);
    Route::get('/delete/{id}', [nguoilaodongController::class, 'destroy']);
});

//Cung lao động
Route::prefix('cungld')->group(function () {
    Route::prefix('thongbao')->group(function () {
        Route::get('/', [messageCotroller::class, 'index']);
        Route::get('/create', [messageCotroller::class, 'create']);
        Route::get('/edit/{id}', [messageCotroller::class, 'edit']);
        Route::post('/store', [messageCotroller::class, 'store']);
        Route::post('/update/{id}', [messageCotroller::class, 'update']);
        Route::get('/delete/{id}', [messageCotroller::class, 'destroy']);
        Route::get('/chitiet/{id}', [messageCotroller::class, 'show']);
        Route::post('/send/{id}', [messageCotroller::class, 'guithongbao']);
    });

    // Tổng hợp danh sách  cung lao động
    Route::prefix('danh_sach')->group(function () {
        Route::prefix('don_vi')->group(function () {
            Route::get('/', [cunglaodongController::class, 'index']);
            Route::get('/create', [cunglaodongController::class, 'create']);
            Route::get('/edit/{id}', [cunglaodongController::class, 'edit']);
            Route::post('/store', [cunglaodongController::class, 'store']);
            Route::post('/update/{id}', [cunglaodongController::class, 'update']);
            Route::get('/delete/{id}', [cunglaodongController::class, 'destroy']);
            Route::get('/chi_tiet/{id}', [cunglaodongController::class, 'show']);
            Route::post('/send/{id}', [cunglaodongController::class, 'senddata']);
            Route::get('/lydo/{id}', [cunglaodongController::class, 'lydo']);
        });
        Route::prefix('huyen')->group(function () {
            Route::get('/', [cunglaodong_huyenController::class, 'index']);
            Route::get('/tong_hop', [cunglaodong_huyenController::class, 'tonghop']);
            Route::post('/send', [cunglaodong_huyenController::class, 'sendata']);
            Route::post('/tralai', [cunglaodong_huyenController::class, 'tralai']);
            Route::get('/lydo', [cunglaodong_huyenController::class, 'lydo']);

            Route::get('/in', [cunglaodong_huyenController::class, 'indanhsach']);
            Route::get('/intonghop', [cunglaodong_huyenController::class, 'intonghop']);
        });

        Route::prefix('tinh')->group(function () {
            Route::get('/', [cunglaodong_tinhController::class, 'index']);
            Route::get('/tong_hop', [cunglaodong_tinhController::class, 'show']);
            Route::post('/tralai', [cunglaodong_tinhController::class, 'tralai']);

            Route::get('/intonghop', [cunglaodong_tinhController::class, 'intonghop']);
            Route::get('/intonghop_tinh', [cunglaodong_tinhController::class, 'intonghop_tinh']);
        });
    });
});




