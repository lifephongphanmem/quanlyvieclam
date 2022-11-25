<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nguoilaodong extends Model
{
    use HasFactory;
    protected $table='nguoilaodong';
    protected $fillable=[
        'madb',
        'ma_nld',
        'hoten',
        'gioitinh',
        'ngaysinh',
        'cmnd',
        'phone',
        'dantoc',
        'nation',
        'tinh',
        'huyen',
        'xa',
        'address',
        'sobaohiem',
        'trinhdogiaoduc',
        'trinhdocmkt',
        'nghenghiep',
        'linhvucdaotao'
        ,'loaihdld',
        'bdhopdong',
        'kthopdong',
        'luong',
        'pcchucvu',
        'pcthamnien',
        'pcthamniennghe',
        'pcluong',
        'pcbosung',
        'bddochai',
        'ktdochai',
        'chucvu',
        'bdbhxh',
        'ktbhxh',
        'luongbhxh',
        'ghichu',
        'company',
        'state',
        'fromttdvvl',
        'thuongtru',
        'tamtru',
        'doituonguutien',
        'cvhientai',
        'vithevl',//1: Chủ cơ sở SXKD, 2:Tự làm, 3:Lao động gia đình, 4:Làm công ăn lương
        'thatnghiep',//0: chưa bao giờ làm việc, 1: đã từng làm việc
        'thoigianthatnghiep',//0:dưới 3 tháng, 1:từ 3 tháng đến 1 năm, 2:Trên 1 năm
        'lydoktg',
        'tinhtrangvl',//0: có việc làm, 1: thất nghiệp,2:không tham gia
        //Dành cho người lao động nước ngoài
        'sohc',
        'ngaycapsohc',
        'trinhdo',
        'chuyenmondaotao',
        'sogpld',//số giấy phép lao động
        'ngaycapsogpld',
        'vitri',
        'nghecongviec',
        'tendn',
        'diachidn',//Địa chỉ dn
        'loaidn',//Loại hình doanh nghiệp
        'bdcv',
        'ktcv'

    ];
}
