<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tonghop_huyen extends Model
{
    use HasFactory;
    protected $table='tonghop_huyen';
    protected $fillable=[
        'math',
        'nam',
        'matb',
        'noidung',
        'madv',
        'madvbc',
        'madvcq',
        'ngaygui',
        'nguoigui',
        'trangthai',
        'lydo'
    ];
}
