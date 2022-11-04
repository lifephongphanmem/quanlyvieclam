<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tonghopcungld_huyen extends Model
{
    use HasFactory;
    protected $table='tonghopcungld_huyens';
    protected $fillable=[
        'mathdv',
        'noidung',
        'trangthai',
        'lydo',
        'ngaygui',
        'madv',
        'madvbc',
        'madvcq',
        'matb'
    ];
}
