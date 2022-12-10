<?php

namespace App\Models\Nguoilaodong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tonghoplaodongnuocngoai extends Model
{
    use HasFactory;
    protected $table='tonghoplaodongnuocngoai';
    protected $fillable=[
        'math','nam','noidung','madv'
    ];
}
