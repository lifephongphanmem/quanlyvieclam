<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\dmdonvi;
use App\Models\thongbao;
use App\Models\thongbaoct;
// use App\Models\thongtintuyendung;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class thongbaoController extends Controller
{
    public function thongbaodagui()
    {
        $model = thongbao::where('trangthai', 'dg')->get();
        $company = Company::all();
        $user = User::all();

        return view('admin.nhucautuyendung.thongbaodagui', compact('model', 'company', 'user'));
    }
    public function khaibao()
    {
        $model = thongbao::where('trangthai', 'dg')->get();
        $company = Company::all();
        $user = User::all();

        return view('admin.nhucautuyendung.khaibao.thongbao.dsthuthap', compact('model', 'company', 'user'));
    }
    public function tonghop()
    {
        $model = thongbao::all();
        $company = Company::all();
        $user = User::all();

        return view('admin.nhucautuyendung.tonghop.thongbao.dsthuthap', compact('model', 'company', 'user'));
    }

    public function create()
    {
        $nguoigui = Auth::user();
        return view('admin.nhucautuyendung.tonghop.thongbao.create', compact('nguoigui'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['manguoigui'] = Auth::user()->madv;
        $input['matb'] = date('YmdHis');
        $input['trangthai'] = 'cg';
        thongbao::create($input);
        $messeager = 'đã thêm mới ';
        return redirect('/tuyen_dung/thong_tin_tong_hop/dot_thu_thap')->with('success', $messeager);
    }

    public function edit(Request $request)
    {
        $model = thongbao::where('matb', $request->matb)->first();
        $user = User::all();
        return view('admin.nhucautuyendung.tonghop.thongbao.edit', compact('user', 'model'));
    }

    public function update(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        thongbao::where('matb', $input['matb'])->update($input);
        $messeager = 'Thông báo đã được thay đổi';
        return redirect('/tuyen_dung/thong_tin_tong_hop/dot_thu_thap')->with('success', $messeager);
    }

    public function chuyen(Request $request)
    {
        $input = $request->all();
        $doanhnghiep = Company::select('user')->get();
        $all = 0;

        foreach ($input['manguoinhan'] as $item) {
            if ($item == 'all') {
                foreach ($doanhnghiep as $dn) {
                    thongbaoct::create(['matb' => $input['matb'], 'manguoinhan' => (string)$dn->user]);
                }
                $all = 1;
            }
        }
     
        if ($all != 1) {
            foreach ($input['manguoinhan'] as $item) {
                thongbaoct::create(['matb' => $input['matb'], 'manguoinhan' => (string)$item]);
            }
        }

        thongbao::where('matb', $input['matb'])->update(['trangthai' => 'dg', 'thoidiem' => date('d/m/Y')]);
        return redirect('/tuyen_dung/thong_tin_tong_hop/dot_thu_thap')->with('success', 'Thông báo đã được gửi');
    }

    public function delete($id)
    {
        $model = thongbao::findOrFail($id);
        thongbaoct::where('matb', $model->matb)->delete();
        $model->delete();
        return redirect('/tuyen_dung/thong_tin_tong_hop/dot_thu_thap')->with('success', 'Thông báo đã được xóa');
    }
}
