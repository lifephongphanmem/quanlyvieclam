<?php

namespace App\Models\Tinhhinhsudunglaodong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongbaotinhhinhsudungld extends Model
{
    use HasFactory;
    protected $table='thongbaotinhhinhsudungld';
    protected $fillable=[
        'matb',
        'nam',
        'tieude',
        'noidung',
        'hannop',
        'trangthai',
        'ngaygui',
        'nguoigui'
    ];
}
