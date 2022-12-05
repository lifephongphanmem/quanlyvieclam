<?php

namespace App\Models\Tinhhinhsudunglaodong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tinhhinhsudunglaodong_ct extends Model
{
    use HasFactory;
    protected $table = 'tinhhinhsudunglaodong_ct';
    protected $fillable = [
        'matb',
        'mathsdld',
        'madv',
        'tieude',
        'ngaygui',
        'nam',
        'mangld',
        'cmnd',
        'hoten',
        'gioitinh',
        'sobhxh',
        'bdbhxh',
        'ktbhxh',
        'ngaysinh',
        'chucvu',
        'vitrivl',
        'mucluong',
        'pcchucvu',
        'pcthamnien',
        'pcthamniennghe',
        'pcluong',
        'pcbosung',
        'bddochai',
        'ktdochai',
        'loaihdld',
        'bdhdld',
        'kthdld',
    ];
}
