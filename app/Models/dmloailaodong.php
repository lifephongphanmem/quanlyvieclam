<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dmloailaodong extends Model
{
    use HasFactory;
    protected $table = 'dmloailaodong';
    protected $fillable=['madmlld','tenlld','trangthai','stt'];
}
