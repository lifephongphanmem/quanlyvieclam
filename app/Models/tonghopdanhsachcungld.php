<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tonghopdanhsachcungld extends Model
{
    use HasFactory;
    protected $table='tonghopdanhsachcungld';
    protected $fillable=[
        'math',
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
