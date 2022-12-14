<?php

namespace App\Models\Caulaodong;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nhucautuyendungct extends Model
{
    use HasFactory;
    protected $table = 'nhucautuyendungct';

    protected $fillable=['mahs','tencongviec','dotuoi','soluong','soluongnu','mota','vitrivl','tdvanhoa','tdkythuat',
    'chuyennganh','tdtinhoc','tdngoaingu','kynangmem','kinhnghiem','noilamviec','luong','hotroan','phucloikhac','nam','xd'];



}
