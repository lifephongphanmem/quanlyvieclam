<?php

namespace App\Http\Controllers\Cunglaodong;

use App\Models\Danhmuc\dmdonvibaocao;
use App\Models\Cunglaodong\thongbaocungld;
use App\Models\Cunglaodong\tonghopcungld_tinh;
use App\Models\Cunglaodong\tonghopdanhsachcungld;
use App\Models\Danhmuc\dmdonvi;
use App\Models\Cunglaodong\tonghop_huyen;
use App\Models\Danhmuc\dmdoituonguutien;
use App\Models\Danhmuc\dmtinhtrangthamgiahdkt;
use App\Models\Danhmuc\dmtinhtrangthamgiahdktct;
use App\Models\Danhmuc\dmtinhtrangthamgiahdktct2;
use App\Models\Danhmuc\dmtrinhdogdpt;
use App\Models\Danhmuc\dmtrinhdokythuat;
use App\Models\Danhmuc\dmchuyenmondaotao;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class cunglaodong_tinhController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin')) {
                return redirect('/');
            };
            return $next($request);
        });
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!chkPhanQuyen('tonghopcunglaodongtinh', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodongtinh');
        }
        $model = thongbaocungld::all();
        return view('cunglaodong.tinh.index')
            ->with('model', $model);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if (!chkPhanQuyen('tonghopcunglaodongtinh', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodongtinh');
        }
        $inputs = $request->all();
        $m_dvbc = User::where('capdo', 'H')->get();
        $model_tinh = tonghopcungld_tinh::where('matb', $inputs['matb'])->get();
        foreach ($m_dvbc as $dv) {
            $dv->matb = $inputs['matb'];
            $m_tinh = $model_tinh->where('madvbc', $dv->madvbc)->first();
            if ($m_tinh != null) {
                $dv->dv = $m_tinh->math;
                $dv->noidung = $m_tinh->noidung;
                $dv->madv_bc = $m_tinh->madv;
            } else {
                $dv->dv = null;
            }
        }
        return view('cunglaodong.tinh.tonghop')
            ->with('model', $m_dvbc);
    }

    public function intonghop(Request $request)
    {
        if (!chkPhanQuyen('tonghopcunglaodongtinh', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodongtinh');
        }
        $inputs = $request->all();
        $model = tonghopdanhsachcungld::join('tonghopdanhsachcungld_ct', 'tonghopdanhsachcungld_ct.math', 'tonghopdanhsachcungld.math')
            ->select('tonghopdanhsachcungld_ct.*', 'tonghopdanhsachcungld.madv','tonghopdanhsachcungld.madvbc')
            ->where('tonghopdanhsachcungld.matb', $inputs['matb'])
            ->where('tonghopdanhsachcungld.madvbc', $inputs['madv'])
            ->get();
            // dd($model);
        $m_dv = dmdonvi::where('madv', $inputs['madv'])->first();
        // $model_dv = dmdonvi::where('madvbc', $inputs['madvbc'])
        //     ->where('phanloaitaikhoan', 'SD')
        //     ->get();
        $model_dv =User::where('madv',$inputs['madv'])->get();
            $doituong_ut = dmdoituonguutien::all();
            $gdpt = dmtrinhdogdpt::all();
            $cmkt = dmtrinhdokythuat::all();
            $tttghdkt = dmtinhtrangthamgiahdkt::all();
            $tttghdkt1 = dmtinhtrangthamgiahdktct::all();
            $tttghdkt2 = dmtinhtrangthamgiahdktct2::all();
            $a_chuyennganh = array_column(dmchuyenmondaotao::all()->toarray(), 'tendm', 'id');
        return view('cunglaodong.export.tinh.tonghop_huyen')
            ->with('model', $model)
            ->with('m_dv', $m_dv)
            ->with('model_dv', $model_dv)
            ->with('doituong_ut', $doituong_ut)
            ->with('gdpt', $gdpt)
            ->with('cmkt', $cmkt)
            ->with('a_chuyennganh', $a_chuyennganh)
            ->with('tttghdkt', $tttghdkt)
            ->with('tttghdkt1', $tttghdkt1)
            ->with('tttghdkt2', $tttghdkt2)
            ->with('pageTitle', 'Tổng hợp danh sách');
    }
    public function intonghop_tinh(Request $request)
    {
        if (!chkPhanQuyen('tonghopcunglaodongtinh', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodongtinh');
        }
        $inputs = $request->all();
        $model = tonghopdanhsachcungld::join('tonghopdanhsachcungld_ct', 'tonghopdanhsachcungld_ct.math', 'tonghopdanhsachcungld.math')
            ->select('tonghopdanhsachcungld_ct.*', 'tonghopdanhsachcungld.madv', 'tonghopdanhsachcungld.madvbc')
            ->where('tonghopdanhsachcungld.matb', $inputs['matb'])
            ->get();
            // dd($model);
        $m_dv = dmdonvi::where('madv', session('admin')['madv'])->first();
        // $model_dv = dmdonvibaocao::where('level', 'H')->get();
        $model_dv=User::where('tonghop',1)->where('madvbc',session('admin')->madv)->where('capdo','H')->get();
        $model_tinh=tonghopcungld_tinh::where('matb',$inputs['matb'])->get();
        foreach ($model as $th){
            $m_tinh=$model_tinh->where('madvbc',$th->madvbc)->first();
            if(isset($m_tinh)){
                $th->madvbc_tinh=$m_tinh->madvbc;
            }else{
                $th->madvbc_tinh=null;
            }
        }
        $doituong_ut = dmdoituonguutien::all();
        $gdpt = dmtrinhdogdpt::all();
        $cmkt = dmtrinhdokythuat::all();
        $tttghdkt = dmtinhtrangthamgiahdkt::all();
        $tttghdkt1 = dmtinhtrangthamgiahdktct::all();
        $tttghdkt2 = dmtinhtrangthamgiahdktct2::all();
        $a_chuyennganh = array_column(dmchuyenmondaotao::all()->toarray(), 'tendm', 'id');
        return view('cunglaodong.export.tinh.tonghop')
            ->with('model', $model)
            ->with('m_dv', $m_dv)
            ->with('model_dv', $model_dv)
            ->with('model_tinh', $model_tinh)
            ->with('doituong_ut', $doituong_ut)
            ->with('gdpt', $gdpt)
            ->with('cmkt', $cmkt)
            ->with('a_chuyennganh', $a_chuyennganh)
            ->with('tttghdkt', $tttghdkt)
            ->with('tttghdkt1', $tttghdkt1)
            ->with('tttghdkt2', $tttghdkt2)
            ->with('pageTitle', 'Tổng hợp danh sách');
    }

    public function tralai(Request $request)
    {
        if (!chkPhanQuyen('tonghopcunglaodongtinh', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodongtinh');
        }
        $inputs=$request->all();
        $model_tinh=tonghopcungld_tinh::where('matb',$inputs['matb'])
                                        ->where('madv',$inputs['madv'])
                                        ->first();
        $model_huyen=tonghop_huyen::where('matb',$inputs['matb'])
                                    ->where('madv',$inputs['madv'])
                                    ->first();
        $model_dv=tonghopdanhsachcungld::where('matb',$inputs['matb'])
                                            ->where('madvbc',$inputs['madvbc'])
                                            ->update(['matht'=>null]);
        $model_huyen->update(['trangthai'=>'TRALAI','lydo'=>$inputs['lydo']]);
        $model_tinh->delete();

        return redirect('/cungld/danh_sach/tinh/tong_hop?matb='.$inputs['matb'])
                ->with('success','Trả lại thành công');
    }
}
