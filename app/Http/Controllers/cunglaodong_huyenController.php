<?php

namespace App\Http\Controllers;

use App\Models\dmdonvi;
use App\Models\thongbaocungld;
use App\Models\tonghop_huyen;
use App\Models\tonghopcungld_huyen;
use App\Models\tonghopcungld_tinh;
use App\Models\tonghopdanhsachcungld;
use App\Models\tonghopdanhsachcungld_ct;
use App\Models\dmdoituonguutien;
use App\Models\dmtinhtrangthamgiahdkt;
use App\Models\dmtinhtrangthamgiahdktct;
use App\Models\dmtinhtrangthamgiahdktct2;
use App\Models\dmtrinhdogdpt;
use App\Models\dmtrinhdokythuat;
use App\Models\dmchuyenmondaotao;
use Carbon\Carbon;
use Illuminate\Http\Request;

class cunglaodong_huyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = thongbaocungld::all();
        $model_huyen = tonghopcungld_huyen::where('madvbc', session('admin')['madvbc'])->get();
        $m_th = tonghop_huyen::where('madvbc', session('admin')['madvbc'])->get();
        foreach ($model as $tb) {
            $m_tonghop = $m_th->where('matb', $tb->matb)->first();
            if ($m_tonghop != null) {
                $tb->mathh = $m_tonghop->math;
                $tb->madv = $m_tonghop->madv;
                $tb->trangthai = $m_tonghop->trangthai;
            } else {
                $tb->mathh = null;
            }
        }
        return view('pages.tonghopcungld.huyen.index')
            ->with('model', $model)
            ->with('model_huyen', $model_huyen);
    }
    public function tonghop(Request $request)
    {
        $inputs = $request->all();
        $model = tonghopdanhsachcungld::where('matb', $inputs['matb'])->get();
        $model_huyen = tonghopcungld_huyen::where('matb', $inputs['matb'])
            ->where('madvbc', session('admin')['madvbc'])
            ->get();
        // dd($model);
        $m_dv = dmdonvi::where('madvbc', session('admin')['madvbc'])->where('phanloaitaikhoan', 'SD')->get();
        $m_tonghop = tonghop_huyen::where('matb', $inputs['matb'])
            ->where('madv', session('admin')['madv'])->first();

        foreach ($m_dv as $dv) {
            $m_th = $model->where('madv', $dv->madv)->first();
            if (isset($m_th)) {
                $dv->noidung = $m_th->noidung;
                $dv->matb = $m_th->matb;
                $dv->math = $m_th->math;
            } else {
                $dv->noidung = '';
                $dv->matb = '';
                $dv->math = '';
            }

            $model_h = $model_huyen->where('madv', $dv->madv)->first();
            if ($model_h != null) {
                $dv->dv = $model_h->madv;
            } else {
                $dv->dv = null;
            }
            if (isset($m_tonghop)) {
                $dv->trangthai = $m_tonghop->trangthai;
            } else {
                $dv->trangthai = null;
            }
        }
        return view('pages.tonghopcungld.huyen.tonghop')
            ->with('model', $model)
            ->with('m_dv', $m_dv);
    }

    public function sendata(Request $request)
    {
        $inputs = $request->all();
        $inputs['math'] = getdate()[0];
        $inputs['madv'] = session('admin')['madv'];
        $inputs['madvbc'] = session('admin')['madvbc'];
        $inputs['trangthai'] = 'DAGUI';
        $inputs['ngaygui'] = Carbon::now()->toDateString();
        $inputs['noidung'] = 'Tổng hợp danh sách cung lao động Thành phố/Huyện/Thị: ' . session('admin')['tendv'];
        //Trường hợp tỉnh gửi dữ liệu về
        $m_tonghop_huyen=tonghop_huyen::where('matb',$inputs['matb'])->where('madv',$inputs['madv'])->first();
        if(isset($m_tonghop_huyen)){
            $m_tonghop_huyen->delete();
        }
        tonghop_huyen::create($inputs);
        tonghopcungld_tinh::create($inputs);
        tonghopdanhsachcungld::where('matb', $inputs['matb'])
            ->where('madvbc', $inputs['madvbc'])
            ->update(['matht' => $inputs['math']]);

        return redirect('/cungld/danh_sach/huyen')
            ->with('success', 'Gửi thành công');
    }

    public function indanhsach(Request $request)
    {
        $inputs = $request->all();
        $model = tonghopdanhsachcungld::join('tonghopdanhsachcungld_ct', 'tonghopdanhsachcungld_ct.math', 'tonghopdanhsachcungld.math')
            ->select('tonghopdanhsachcungld_ct.*')
            ->where('tonghopdanhsachcungld.matb', $inputs['matb'])
            ->where('tonghopdanhsachcungld.madv', $inputs['madv'])
            ->get();
        $m_dv = dmdonvi::where('madv', $inputs['madv'])->first();
        $doituong_ut=dmdoituonguutien::all();
        $gdpt=dmtrinhdogdpt::all();
        $cmkt=dmtrinhdokythuat::all();
        $tttghdkt=dmtinhtrangthamgiahdkt::all();
        $tttghdkt1=dmtinhtrangthamgiahdktct::all();
        $tttghdkt2=dmtinhtrangthamgiahdktct2::all();
        $a_chuyennganh = array_column(dmchuyenmondaotao::all()->toarray(),'tendm','id');
        return view('reports.cunglaodong.danhsach')
            ->with('model', $model)
            ->with('m_dv', $m_dv)
            ->with('doituong_ut', $doituong_ut)
            ->with('gdpt', $gdpt)
            ->with('cmkt', $cmkt)
            ->with('a_chuyennganh', $a_chuyennganh)
            ->with('tttghdkt', $tttghdkt)
            ->with('tttghdkt1', $tttghdkt1)
            ->with('tttghdkt2', $tttghdkt2)
            ->with('pageTitle', 'Danh sách cung lao động');
    }

    public function intonghop(Request $request)
    {
        $inputs = $request->all();
        $model = tonghopdanhsachcungld::join('tonghopdanhsachcungld_ct', 'tonghopdanhsachcungld_ct.math', 'tonghopdanhsachcungld.math')
            ->select('tonghopdanhsachcungld_ct.*', 'tonghopdanhsachcungld.madv')
            ->where('tonghopdanhsachcungld.matb', $inputs['matb'])
            ->where('tonghopdanhsachcungld.madvbc', session('admin')['madvbc'])
            ->get();
        // dd($model);
        $m_dv = dmdonvi::where('madv', session('admin')['madv'])->first();
        $model_dv = dmdonvi::where('madvbc', session('admin')['madvbc'])
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
            ->with('pageTitle', 'Thông tin cung lao động');
    }

    public function tralai(Request $request)
    {
        $inputs = $request->all();
        $model_dv = tonghopdanhsachcungld::where('matb', $inputs['matb'])
            ->where('madv', $inputs['madv'])
            ->first();
        $model_huyen = tonghopcungld_huyen::where('matb', $inputs['matb'])
            ->where('madv', $inputs['madv'])
            ->first();
        $model_huyen->delete();
        $model_dv->update(['trangthai' => 'TRALAI', 'lydo' => $inputs['tralai']]);
        $m_huyen_conlai = tonghopcungld_huyen::where('matb', $inputs['matb'])
            ->where('madvbc', $inputs['madvbc'])
            ->get();
        if (count($m_huyen_conlai) == 0) {
            tonghop_huyen::where('matb', $inputs['matb'])
                ->where('madv', session('admin')['madv'])
                ->first()->delete();
        }
        return redirect('/cungld/danh_sach/huyen/tong_hop?matb=' . $inputs['matb'])
            ->with('success', 'Trả lại thành công');
    }

    public function lydo(Request $request)
    {
        $inputs = $request->all();
        $model = tonghop_huyen::where('matb', $inputs['matb'])
            ->where('madv', $inputs['madv'])
            ->first();

        return response()->json($model);
    }
}
