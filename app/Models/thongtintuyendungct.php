<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongtintuyendungct extends Model
{
    use HasFactory;
    protected $table = 'thongtintuyendungct';
    protected $fillable=['madn','manhom','mahs','trangthai','noidung','soluong','thoidiemtu','thoidiemden','lydo',];
}
