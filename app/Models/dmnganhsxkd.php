<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dmnganhsxkd extends Model
{
    use HasFactory;
    protected $table = 'dmnganhsxkd';
    protected $fillable=['madmsxkd','tensxkd','trangthai','stt','mota'];
}
