<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\dmdonvi;
use App\Models\thongbao;
use App\Models\thongbaoct;
use App\Models\thongtintuyendung;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class thongbaoController extends Controller
{
    public function index()
    {
        $model = thongbao::all();
        $company = Company::all();
        $user = User::all();
        $thongtintd = thongtintuyendung::all();
        return view('admin.thongbao.index', compact('model','company', 'user', 'thongtintd'));
    }

    public function danhsach()
    {
        $user = User::all();
        $model = thongbao::all();
        $thongtintd = thongtintuyendung::all();
        return view('admin.thongbao.danhsach', compact('model', 'user', 'thongtintd'));
    }

    public function create()
    {
        $nguoigui = Auth::user();
        $thongtintd = thongtintuyendung::all();
        return view('admin.thongbao.create', compact('nguoigui', 'thongtintd'));
    }
 
    public function store(Request $request)
    {
        $input = $request->all();
        $input['manguoigui'] = Auth::user()->madv;
        $input['matb'] = date('YmdHis');
        $input['trangthai'] = 'cg';
        thongbao::create($input);
        $messeager = 'đã thêm mới thông báo';
        return redirect('thong_bao')->with('success', $messeager);
    }

    public function edit(Request $request)
    {
        $model = thongbao::where('matb', $request->matb)->first();
        $user = User::all();
        $thongtintd = thongtintuyendung::all();
        return view('admin.thongbao.edit', compact('thongtintd', 'user', 'model'));
    }

    public function update(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        thongbao::where('matb', $input['matb'])->update($input);
        $messeager = 'Thông báo đã được thay đổi';
        return redirect('thong_bao')->with('success', $messeager);
    }

    public function chuyen(Request $request){     
        $input = $request->all();
        // dd($input['matb']);
        foreach ($input['manguoinhan'] as $item){
            thongbaoct::create(['matb' => $input['matb'], 'manguoinhan' => (string)$item]);
        }
        thongbao::where('matb',$input['matb'])->update(['trangthai' => 'dg','thoidiem' => date('d/m/Y')]);
        return redirect('thong_bao')->with('success', 'Thông báo đã được gửi');
    }

    public function delete($id)
    {
       $model = thongbao::findOrFail($id);
       thongbaoct::where('matb',$model->matb)->delete();
       $model->delete();
        return redirect('thong_bao')->with('success', 'Thông báo đã được xóa');
    }
}
