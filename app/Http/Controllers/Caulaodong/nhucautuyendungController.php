<?php

namespace App\Http\Controllers\Caulaodong;

use App\Models\Company;
use App\Models\Danhmuc\dmmanghetrinhdo;
use App\Models\Danhmuc\dmtrinhdogdpt;
use App\Models\Danhmuc\dmtrinhdokythuat;
use App\Models\Caulaodong\nhucautuyendung;
use App\Models\Caulaodong\nhucautuyendungct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Danhmuc\dmtinhtrangthamgiahdktct2;
use Illuminate\Support\Facades\Session;

class nhucautuyendungController extends Controller
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


    //khai báo
    public function index_khaibao(Request $request)
    {  
        $model = nhucautuyendung::where('matb', $request->matb)->where('madn',session('admin')['madv'])->get();
        $matb = $request->matb;
        $dmmanghetrinhdo = dmmanghetrinhdo::all();
        $modelct = nhucautuyendungct::all();
        // dd($dmmanghetrinhdo);
        return view('Caulaodong.khaibao.index', compact('model','modelct', 'matb','dmmanghetrinhdo'));
    }
    
    public function create(Request $request)
    {
       
        nhucautuyendungct::where('xd', 'cxd')->delete();
        $matb = $request->matb;
        $mahs = date('YmdHis');
        $modelct = null;
        $vitrivl= dmtinhtrangthamgiahdktct2::where('manhom2','20221108050559')->get();
        $dmtrinhdogdpt = dmtrinhdogdpt::all();
        $dmtrinhdokythuat = dmtrinhdokythuat::all();
        $dmmanghetrinhdo = dmmanghetrinhdo::where('trangthai','kh')->get();
        $manghefirst = dmmanghetrinhdo::select('madmmntd')->first();
        return view('Caulaodong.khaibao.create', compact('matb', 'mahs', 'modelct','vitrivl', 'dmtrinhdokythuat', 'dmtrinhdogdpt','dmmanghetrinhdo','manghefirst'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['nam'] = date('Y');
        $input['trangthai'] = 'cc';
        $input['madn'] = session('admin')['madv'];
        nhucautuyendung::create($input);
        nhucautuyendungct::where('mahs',$request->mahs)->update(['xd'=>'xd']);
        return redirect('tuyen_dung/khai_bao_nhu_cau?matb=' . $request->matb);
    }

    public function edit(Request $request)
    {
        $vitrivl= dmtinhtrangthamgiahdktct2::where('manhom2','20221108050559')->get();
        $modelct = nhucautuyendungct::where('mahs', $request->mahs)->get();
        $dmtrinhdogdpt = dmtrinhdogdpt::all();
        $dmtrinhdokythuat = dmtrinhdokythuat::all();
        $dmmanghetrinhdo = dmmanghetrinhdo::where('trangthai','kh')->get();
        $model = nhucautuyendung::where('mahs', $request->mahs)->first();
        $matb = $model->matb;
        $mahs = $model->mahs;
        $manghefirst = dmmanghetrinhdo::select('madmmntd')->first();
        return view('Caulaodong.khaibao.edit', compact('model','matb','modelct','vitrivl', 'dmtrinhdokythuat', 'dmtrinhdogdpt','mahs',
        'dmmanghetrinhdo','manghefirst'));
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
        return view('Caulaodong.khaibao.show', compact('model','matb','modelct','dmmanghetrinhdo'));
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
        return view('Caulaodong.tonghop.index', compact('model', 'matb','doanhnghiep'));
    }

    public function tralai(Request $request)
    {
        nhucautuyendung::where('mahs',$request->mahs)->update(['lydo'=>$request->lydo, 'trangthai' => 'btl']);
        return redirect('tuyen_dung/khai_bao_nhu_cau?matb=' . $request->matb);
    }
}
