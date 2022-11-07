<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\nguoilaodong;
use App\Models\thongtintuyendung;
use App\Models\tonghopdanhsachcungld;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class baocaotonghopController extends Controller
{
    // người sử dụng lao động
    public function dnbaocao()
    {
        $id_user = Auth::user()->id;
        $nguoidung = Company::Find($id_user)->first();
        $tonghopcungld = tonghopdanhsachcungld::all();
        $company = Company::all();
        return view('admin.baocaotonghop.doanhnghiep.dnbaocao', compact('nguoidung', 'tonghopcungld', 'company'));
    }


    public function dntonghop(Request $request)
    {
        $id_user = Auth::user()->id;
        $nguoidung = Company::Find($id_user)->first();
        $model = nguoilaodong::where('company', $request->id)->where('madb', $request->madb)->get();
        return view('admin.baocaotonghop.doanhnghiep.dntonghop', compact('model', 'nguoidung'))
            ->with('pageTitle', 'Báo thông tin người lao động');
    }


    // sỏ lao động thương binh và xã hội
    public function ldtbxhbaocao()
    {
        $tonghopcungld = tonghopdanhsachcungld::all();
        return view('admin.baocaotonghop.solaodongtbxh.ldtbxhbaocao', compact('tonghopcungld'));
    }

    public function ldtbxhtonghop(Request $request)
    {
        $dotthongbao = nguoilaodong::where('madb' , $request->madb)->get();
        $c_tong = count($dotthongbao);
        $c_ldnu = count($dotthongbao->where('gioitinh','nu'));

        // $c_ldtren35 = $dotthongbao->where('ngaysinh','>',date('Ymd') - (0035-1-1))->get();
        $c_bhxh = count($dotthongbao->where('bdbhxh','!=',null));
        
        return view('admin.baocaotonghop.solaodongtbxh.ldtbxhtonghop', compact('doanhnghiep'))
            ->with('pageTitle', 'Báo thông tin người lao động');
    }
}
