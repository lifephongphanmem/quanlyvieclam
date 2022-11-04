<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    use HasFactory;
    protected $atable='messages';
    protected $fillable=[
        'thread_id','user_id','body','deleted_at'
    ];
}
