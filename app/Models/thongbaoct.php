<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongbaoct extends Model
{
    use HasFactory;
    protected $table = 'thongbaoct';
    protected $fillable=['matb','manguoinhan'];
}
