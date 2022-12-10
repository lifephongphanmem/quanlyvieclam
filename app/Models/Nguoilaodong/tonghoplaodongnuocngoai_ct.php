<?php

namespace App\Models\Nguoilaodong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tonghoplaodongnuocngoai_ct extends Model
{
    use HasFactory;
    protected $table='tonghoplaodongnuocngoai_ct';
    protected $fillable=[
        'math',
        'madv',
        'nam',
        'hoten',
        'ngaysinh',
        'cmnd',
        'ngaycapcmnd',
        'giaypheplaodong',
        'ngaycapgiaypheplaodong',
        'trinhdo',
        'quoctich',
        'vitricongviec',
        'gioitinh'
    ];
}
