<?php

namespace App\Http\Controllers;

use App\Models\dmdonvibaocao;
use App\Models\thongbaocungld;
use App\Models\tonghopcungld_tinh;
use App\Models\tonghopdanhsachcungld;
use App\Models\dmdonvi;
use App\Models\tonghop_huyen;
use App\Models\dmdoituonguutien;
use App\Models\dmtinhtrangthamgiahdkt;
use App\Models\dmtinhtrangthamgiahdktct;
use App\Models\dmtinhtrangthamgiahdktct2;
use App\Models\dmtrinhdogdpt;
use App\Models\dmtrinhdokythuat;
use App\Models\dmchuyenmondaotao;
use Illuminate\Http\Request;

class cunglaodong_tinhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = thongbaocungld::all();
        return view('pages.tonghopcungld.tinh.index')
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
        $inputs = $request->all();
        $m_dvbc = dmdonvibaocao::where('level', 'H')->get();
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
        return view('pages.tonghopcungld.tinh.tonghop')
            ->with('model', $m_dvbc);
    }

    public function intonghop(Request $request)
    {
        $inputs = $request->all();
        $model = tonghopdanhsachcungld::join('tonghopdanhsachcungld_ct', 'tonghopdanhsachcungld_ct.math', 'tonghopdanhsachcungld.math')
            ->select('tonghopdanhsachcungld_ct.*', 'tonghopdanhsachcungld.madv')
            ->where('tonghopdanhsachcungld.matb', $inputs['matb'])
            ->where('tonghopdanhsachcungld.madvbc', $inputs['madvbc'])
            ->get();
        $m_dv = dmdonvi::where('madv', $inputs['madv'])->first();
        $model_dv = dmdonvi::where('madvbc', $inputs['madvbc'])
            ->where('phanloaitaikhoan', 'SD')
            ->get();
            $doituong_ut = dmdoituonguutien::all();
            $gdpt = dmtrinhdogdpt::all();
            $cmkt = dmtrinhdokythuat::all();
            $tttghdkt = dmtinhtrangthamgiahdkt::all();
            $tttghdkt1 = dmtinhtrangthamgiahdktct::all();
            $tttghdkt2 = dmtinhtrangthamgiahdktct2::all();
            $a_chuyennganh = array_column(dmchuyenmondaotao::all()->toarray(), 'tendm', 'id');
        return view('reports.cunglaodong.tonghop')
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
        $inputs = $request->all();
        $model = tonghopdanhsachcungld::join('tonghopdanhsachcungld_ct', 'tonghopdanhsachcungld_ct.math', 'tonghopdanhsachcungld.math')
            ->select('tonghopdanhsachcungld_ct.*', 'tonghopdanhsachcungld.madv', 'tonghopdanhsachcungld.madvbc')
            ->where('tonghopdanhsachcungld.matb', $inputs['matb'])
            ->get();
        $m_dv = dmdonvi::where('madv', session('admin')['madv'])->first();
        $model_dv = dmdonvibaocao::where('level', 'H')->get();
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
        return view('reports.cunglaodong.tinh.tonghop')
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
