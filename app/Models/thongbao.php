<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongbao extends Model
{
    use HasFactory;
    protected $table = 'thongbao';
    protected $fillable=['manguoigui','matttd','matb','noidung','thoidiem','trangthai',];
}
