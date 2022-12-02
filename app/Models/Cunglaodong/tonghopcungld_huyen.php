<?php

namespace App\Models\Cunglaodong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tonghopcungld_huyen extends Model
{
    use HasFactory;
    protected $table='tonghopcungld_huyens';
    protected $fillable=[
        'mathdv',
        'nam',
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
