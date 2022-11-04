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
        'ma_ngld',
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
        'vitri',
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
        'tingtrangvl'
    ];
}
