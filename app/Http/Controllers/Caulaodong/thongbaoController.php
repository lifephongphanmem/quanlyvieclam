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
use App\Models\Caulaodong\nhucautuyendung;
use App\Models\Caulaodong\nhucautuyendungct;
use App\Models\Danhmuc\dmmanghetrinhdo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class thongbaoController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin')) {
                return redirect('/');
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
            foreach ($modelth as $item) {
                foreach ($modelct as $item2) {
                    if ($item->matb == $item2->matb) {
                        array_push($model, $item);
                    }
                }
            }
        } else {
            $model = null;
        }

        $company = Company::all();
        $user = User::all();

        return view('caulaodong.hopthucauld', compact('model', 'company', 'user'));
    }
    public function thongbaodagui()
    {

        $model = thongbao::all();
        $company = Company::all();
        $user = User::all();

        return view('caulaodong.thongbaodagui', compact('model', 'company', 'user'));
    }
    public function khaibao()
    {
        $model = thongbao::where('trangthai', 'dg')->get();
        $company = Company::all();
        $user = User::all();

        return view('caulaodong.khaibao.thongbao.dsthuthap', compact('model', 'company', 'user'));
    }
    public function tonghop()
    {
        $model = thongbao::where('trangthai', 'dg')->get();
        $company = Company::all();
        $user = User::all();

        return view('caulaodong.tonghop.thongbao.dsthuthap', compact('model', 'company', 'user'));
    }

    public function create()
    {

        $nguoigui = session('admin')['name'];
        return view('caulaodong.create', compact('nguoigui'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['manguoigui'] = session('admin')['madv'];
        $input['matb'] = date('YmdHis');
        $input['trangthai'] = 'cg';
        thongbao::create($input);
        $messeager = 'đã thêm mới ';
        return redirect('/tuyen_dung/damh_sach_thong_bao')->with('success', $messeager);
    }


    public function edit(Request $request)
    {
        $model = thongbao::where('matb', $request->matb)->first();
        $user = User::all();
        return view('caulaodong.edit', compact('user', 'model'));
    }

    public function update(Request $request)
    {
        $inputs=$request->all();
         unset($inputs['_token']);
        thongbao::where('matb', $request->matb)->update($inputs);
        $messeager = 'Thông báo đã được thay đổi';
        return redirect('/tuyen_dung/damh_sach_thong_bao')->with('success', $messeager);
    }

    public function chuyen(Request $request)
    {
        $input = $request->all();
        $doanhnghiep = Company::all();
        $all = 0;

        if ($request->has('filequyetdinh')) {
            $a = $request->filequyetdinh;
            $filequyetdinh = time() . $a->getClientOriginalName();
            $a->move('upload/cauld', $filequyetdinh);
        } else {
            $filequyetdinh = null;
        }

        if ($request->has('filekhac')) {
            $a = $request->filekhac;
            $filekhac = time() . $a->getClientOriginalName();
            $a->move('upload/cauld', $filekhac);
        } else {
            $filekhac = null;
        }

        thongbao::where('matb', $request->matb)->update(['filequyetdinh'=> $filequyetdinh, 'filekhac' => $filekhac]);

        foreach ($input['manguoinhan'] as $item) {
            if ($item == 'all') {
                foreach ($doanhnghiep as $dn) {
                    thongbaoct::create(['matb' => $input['matb'], 'manguoinhan' => $dn->madv]);
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
        return redirect('/tuyen_dung/damh_sach_thong_bao')->with('success', 'Thông báo đã được gửi');
    }

    public function delete($id)
    {
        $model = thongbao::findOrFail($id);

        // if ($model->filequyetdinh != null) {
        //     if (File::exists('upload/cauld/' . ($model->filequyetdinh))) {
        //         File::Delete('upload/cauld/' . ($model->filequyetdinh));
        //     }
        // }
        // if ($model->filekhac != null) {
        //     if (File::exists('upload/cauld/' . ($model->filekhac))) {
        //         File::Delete('upload/cauld/' . ($model->filekhac));
        //     }
        // }
       
        thongbaoct::where('matb', $model->matb)->delete();
        $model->delete();
        return redirect('/tuyen_dung/damh_sach_thong_bao')->with('success', 'Thông báo đã được xóa');
    }

    public function indanhsachcauld(Request $request)
    {
        $nhucautuyendungct = nhucautuyendungct::all();
        $model = nhucautuyendung::where('matb', $request->matb)->join('nhucautuyendungct', 'nhucautuyendungct.mahs', '=', 'nhucautuyendung.mahs')
            ->select('nhucautuyendungct.*', 'nhucautuyendung.*')->get();
        // dd($model);
        $company = Company::all();
        $manghecap2 = dmmanghetrinhdo::all();

        return view('caulaodong.indanhsachcauld',compact('model','company','manghecap2'))
        ->with('pageTitle', 'danh sách cầu lao động');

    }
}
