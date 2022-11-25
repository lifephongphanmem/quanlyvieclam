<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vithevieclam extends Model
{
    use HasFactory;
    protected $table='vithevieclam';
    protected $fillable=['madm','tendm'];
}
