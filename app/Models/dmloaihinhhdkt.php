<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dmloaihinhhdkt extends Model
{
    use HasFactory;
    protected $table = 'dmloaihinhhdkt';
    protected $fillable=['madmlhkt','tenlhkt','trangthai','stt','mota'];
}
