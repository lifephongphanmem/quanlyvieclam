<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\dmmanghetrinhdo;
use App\Models\dmtrinhdogdpt;
use App\Models\dmtrinhdokythuat;
use App\Models\nhucautuyendung;
use App\Models\nhucautuyendungct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class nhucautuyendungController extends Controller
{
    //khai báo
    public function index_khaibao(Request $request)
    {

        $madn = Auth::user()->id;
        $model = nhucautuyendung::where('matb', $request->matb)->where('madn', $madn)->get();
        $matb = $request->matb;
        return view('admin.nhucautuyendung.khaibao.index', compact('model', 'matb'));
    }
    
    public function create(Request $request)
    {
        nhucautuyendungct::where('xd', 'cxd')->delete();
        $matb = $request->matb;
        $mahs = date('YmdHis');
        $modelct = null;
        $dmtrinhdogdpt = dmtrinhdogdpt::all();
        $dmtrinhdokythuat = dmtrinhdokythuat::all();
        $dmmanghetrinhdo = dmmanghetrinhdo::where('trangthai','kh')->get();
        $manghefirst = dmmanghetrinhdo::select('madmmntd')->first();
        return view('admin.nhucautuyendung.khaibao.create', compact('matb', 'mahs', 'modelct', 'dmtrinhdokythuat', 'dmtrinhdogdpt','dmmanghetrinhdo','manghefirst'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['nam'] = date('Y');
        $input['trangthai'] = 'cc';
        $input['madn'] = Auth::user()->id;
        nhucautuyendung::create($input);
        nhucautuyendungct::where('mahs',$request->mahs)->update(['xd'=>'xd']);
        return redirect('tuyen_dung/khai_bao_nhu_cau?matb=' . $request->matb);
    }

    public function edit(Request $request)
    {
        $modelct = nhucautuyendungct::where('mahs', $request->mahs)->get();
        $dmtrinhdogdpt = dmtrinhdogdpt::all();
        $dmtrinhdokythuat = dmtrinhdokythuat::all();
        $dmmanghetrinhdo = dmmanghetrinhdo::where('trangthai','kh')->get();
        $model = nhucautuyendung::where('mahs', $request->mahs)->first();
        $matb = $model->matb;
        $mahs = $model->mahs;
        $manghefirst = dmmanghetrinhdo::select('madmmntd')->first();
        return view('admin.nhucautuyendung.khaibao.edit', compact('model','matb','modelct', 'dmtrinhdokythuat', 'dmtrinhdogdpt','mahs','dmmanghetrinhdo','manghefirst'));
    }
    public function update(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        nhucautuyendung::where('mahs',$request->mahs)->update($input);
        nhucautuyendungct::where('mahs',$request->mahs)->update(['xd'=>'xd']);
        return redirect('tuyen_dung/khai_bao_nhu_cau?matb=' . $request->matb);
    }

    public function chuyen(Request $request)
    {
       $model = nhucautuyendung::where('mahs',$request->mahs)->first();
       $matb = $model->matb;
       $model->update(['trangthai'=> 'dc']);
        return redirect('tuyen_dung/khai_bao_nhu_cau?matb=' . $matb);
    }
    
    public function show(Request $request)
    {
        $model = nhucautuyendung::where('mahs', $request->mahs)->first();
        $matb = $model->matb;
        $modelct = nhucautuyendungct::where('mahs', $request->mahs)->get();
        $dmmanghetrinhdo = dmmanghetrinhdo::where('trangthai','kh')->get();
        return view('admin.nhucautuyendung.khaibao.show', compact('model','matb','modelct','dmmanghetrinhdo'));
    }

    public function delete($id)
    {
        $model = nhucautuyendung::find($id);
        $model->delete();
        $matb = $model->matb;
        return redirect('tuyen_dung/khai_bao_nhu_cau?matb=' . $matb);
    }

    //toongt hợp
    public function index_tonghop(Request $request)
    {
        $model = nhucautuyendung::where('matb', $request->matb)->where('trangthai','dc')->get();
        $matb = $request->matb;
        $doanhnghiep = Company::all();
        return view('admin.nhucautuyendung.tonghop.index', compact('model', 'matb','doanhnghiep'));
    }

    public function tralai(Request $request)
    {
        nhucautuyendung::where('mahs',$request->mahs)->update(['lydo'=>$request->lydo, 'trangthai' => 'btl']);
        return redirect('tuyen_dung/khai_bao_nhu_cau?matb=' . $request->matb);
    }
}
