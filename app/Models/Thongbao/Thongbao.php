<?php

namespace App\Models\Thongbao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongbao extends Model
{
    use HasFactory;
    protected $table='thongbao_tinh_huyen';
    protected $fillable=[
        'matb',
        'tieude',
        'noidung',
        'thoigiangui',
        'trangthai'
    ];
}
