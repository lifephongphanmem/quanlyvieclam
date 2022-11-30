<?php

namespace App\Models\Cunglaodong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tonghopdanhsachcungld extends Model
{
    use HasFactory;
    protected $table='tonghopdanhsachcungld';
    protected $fillable=[
        'math',
        'nam',
        'noidung',
        'matb',
        'trangthai',
        'ngaygui',
        'lydo',
        'madv',
        'mathh',
        'matht',
        'madvbc',
        'madvcq'
    ];
}
