<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhucautuyendung extends Model
{
    use HasFactory;
    protected $table = 'nhucautuyendung';
    protected $fillable=['matb','mahs','madn','noidung','ten','email','sdt','yeucau','trangthai','lydo','nam'];
}
