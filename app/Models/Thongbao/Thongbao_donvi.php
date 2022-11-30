<?php

namespace App\Models\Thongbao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thongbao_donvi extends Model
{
    use HasFactory;
    protected $table='thongbao_donvi';
    protected $fillable=[
        'matb',
        'madv'
    ];
}
