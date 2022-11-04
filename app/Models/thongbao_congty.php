<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongbao_congty extends Model
{
    use HasFactory;
    protected $table='thongbao_congty';
    protected $fillable=[
        'thongbao_id','user_id'
    ];
}
