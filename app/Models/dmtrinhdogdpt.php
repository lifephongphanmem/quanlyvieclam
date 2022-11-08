<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dmtrinhdogdpt extends Model
{
    use HasFactory;
    protected $table = 'dmtrinhdogdpt';
    protected $fillable=['madmgdpt','tengdpt','trangthai','stt'];
}
