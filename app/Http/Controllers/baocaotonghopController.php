<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\thongtintuyendung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class baocaotonghopController extends Controller
{
    public function dnbaocao(){
        $id_user = Auth::user()->id;
        $nguoidung = Company::Find($id_user)->first();
        // $tonghopcungld = tonghopcungld::where('company',$nguoidung->id)->get();
        $company = Company::all();
        return view('admin.baocao.doanhnghiep.bc',compact('nguoidung','thongtintd'));
    }


    public function dntonghop(){
        return view('admin.baocao.doanhnghiep.dntonghop');
    }
}
