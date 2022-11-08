<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongtintuyendung extends Model
{
    use HasFactory;
    protected $table = 'thongtintuyendung';
    protected $fillable=['matttd','tieude','mota','thoidiemtu','thoidiemden','trangthai',];
}
