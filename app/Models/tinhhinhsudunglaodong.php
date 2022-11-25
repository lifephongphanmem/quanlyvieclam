<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tinhhinhsudunglaodong extends Model
{
    use HasFactory;
    protected $table = 'tinhhinhsudunglaodong';
    protected $fillable = [
        'matb',
        'tieude',//0: báo cáo định kỳ, 1: báo cáo hằng năm
        'mathsdld',
        'madv',
        'nam',
        'trangthai',
        'ngaygui',
        'lydo'
    ];
}
