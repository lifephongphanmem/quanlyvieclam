<?php

namespace App\Models\Tinhhinhsudunglaodong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongbaotinhhinhsudungld_doanhnghiep extends Model
{
    use HasFactory;
    protected $table='thongbaotinhhinhsudungld_doanhnghiep';
    public $timestamps = false;
    protected $fillable=[
        'matb',
        'masodn'
    ];
}
