<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongbaocungld extends Model
{
    use HasFactory;
    protected $table='thongbaocungld';
    protected $fillable=[
        'tieude',
        'noidung',
        'ngaygui',
        'matb'
    ];
}
