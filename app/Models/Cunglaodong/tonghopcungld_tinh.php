<?php

namespace App\Models\Cunglaodong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tonghopcungld_tinh extends Model
{
    use HasFactory;
    protected $table = 'tonghopcungld_tinh';
    protected $fillable = [
        'math',
        'nam',
        'noidung',
        'madvbc',
        'madv',
        'matb',
        'trangthai'
    ];
}
