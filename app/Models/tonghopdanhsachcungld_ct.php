<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tonghopdanhsachcungld_ct extends Model
{
    use HasFactory;
    protected $table='tonghopdanhsachcungld_ct';
    protected $fillable=[
        'math',
        'ma_ngld',
        'madb',
        'hoten',
        'cmnd',
        'ngaysinh'
    ];
}
