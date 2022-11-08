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
        'vithevl',
        'thatnghiep',//0: có việc làm, 1: thất nghiệp,2:không tham gia
        'thoigianthatnghiep',
        'lydoktg',
        'tingtrangvl',
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
