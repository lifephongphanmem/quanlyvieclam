<?php

namespace App\Http\Controllers\Caulaodong;

use App\Models\Company;
use App\Models\dmdonvi;
use App\Models\Caulaodong\thongbao;
use App\Models\Caulaodong\thongbaoct;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class thongbaoController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin')) {
                return redirect('/home');
            };
            return $next($request);
        });
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hopthucauld()
    {
        $model = [];
        $manguoinhan = session('admin')['madv'];
   
        $modelct = thongbaoct::where('manguoinhan', $manguoinhan)->get();
        $modelth = thongbao::where('trangthai', 'dg')->get();
        if ($modelth != null && $modelct != null) {
            foreach ($modelth as $item){
                foreach ($modelct as $item2){
                    if ($item->matb == $item2->matb) {
                        array_push($model, $item);
                    }
                }
            }
        }
        else {
            $model = null;
        }
 
        $company = Company::all();
        $user = User::all();

        return view('Caulaodong.hopthucauld', compact('model', 'company', 'user'));
    }
    public function thongbaodagui()
    {

        $model = thongbao::where('trangthai', 'dg')->get();
        $company = Company::all();
        $user = User::all();

        return view('Caulaodong.thongbaodagui', compact('model', 'company', 'user'));
    }
    public function khaibao()
    {
        $model = thongbao::where('trangthai', 'dg')->get();
        $company = Company::all();
        $user = User::all();

        return view('Caulaodong.khaibao.thongbao.dsthuthap', compact('model', 'company', 'user'));
    }
    public function tonghop()
    {
        $model = thongbao::all();
        $company = Company::all();
        $user = User::all();

        return view('Caulaodong.tonghop.thongbao.dsthuthap', compact('model', 'company', 'user'));
    }

    public function create()
    {
        // $nguoigui = Auth::user();
        $nguoigui = session('admin')['name'];
        return view('Caulaodong.tonghop.thongbao.create', compact('nguoigui'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['manguoigui'] = session('admin')['madv'];
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
        return view('Caulaodong.tonghop.thongbao.edit', compact('user', 'model'));
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
                    thongbaoct::create(['matb' => $input['matb'], 'manguoinhan' => (string)$dn->madv]);
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
        dd(1);
        $model = thongbao::findOrFail($id);
        thongbaoct::where('matb', $model->matb)->delete();
        $model->delete();
        return redirect('/tuyen_dung/thong_tin_tong_hop/dot_thu_thap')->with('success', 'Thông báo đã được xóa');
    }
}
