<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nghecongviec extends Model
{
    use HasFactory;
    protected $table='nghecongviec';
    protected $fillable=['tendm'];
}
