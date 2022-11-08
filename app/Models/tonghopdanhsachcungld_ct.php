<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tonghopdanhsachcungld_ct extends Model
{
    use HasFactory;
    protected $table = 'tonghopdanhsachcungld_ct';
    protected $fillable = [
        'math',
        'ma_ngld',
        'madb',
        'hoten',
        'cmnd',
        'ngaysinh',
        'dantoc',
        'gioitinh',
        'quocgia',
        'sobaohiem',
        'bdbhxh',
        'ktbhxh',
        'luongbhxh',
        'trinhdogiaoduc',
        'trinhdocmkt',//Trình độ chuyên môn kỹ thuật
        'nghenghiep',
        'linhvucdaotao',
        'loaihdld',
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
        'ghichu',
        'company',
        'sate',
        'thuongtru',
        'tamtru',
        'doituonguutien',
        'cvhientai',
        'vithevl',
        'thatnghiep',
        'thoigianthatnghiep',
        'lydoktg',
        'tinhtrangvl',//0: có việc làm, 1: Thất nghiệp, 2: Không tham gia, 4: Chọn tình trạng
    ];
}
