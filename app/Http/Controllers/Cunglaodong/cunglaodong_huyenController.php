<?php

namespace App\Http\Controllers\Cunglaodong;

use App\Models\Danhmuc\dmdonvi;
use App\Models\Cunglaodong\thongbaocungld;
use App\Models\Cunglaodong\tonghop_huyen;
use App\Models\Cunglaodong\tonghopcungld_huyen;
use App\Models\Cunglaodong\tonghopcungld_tinh;
use App\Models\Cunglaodong\tonghopdanhsachcungld;
use App\Models\tonghopdanhsachcungld_ct;
use App\Models\Danhmuc\dmdoituonguutien;
use App\Models\Danhmuc\dmtinhtrangthamgiahdkt;
use App\Models\Danhmuc\dmtinhtrangthamgiahdktct;
use App\Models\Danhmuc\dmtinhtrangthamgiahdktct2;
use App\Models\Danhmuc\dmtrinhdogdpt;
use App\Models\Danhmuc\dmtrinhdokythuat;
use App\Models\Danhmuc\dmchuyenmondaotao;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class cunglaodong_huyenController extends Controller
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
    public function index()
    {
        if (!chkPhanQuyen('tonghopcunglaodonghuyen', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodonghuyen');
        }
        $model = thongbaocungld::all();
        // dd($model);
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
        $a_donvi=array_column(dmdonvi::all()->toarray(),'tendv','madv');
        return view('cunglaodong.huyen.index')
            ->with('model', $model)
            ->with('a_donvi', $a_donvi)
            ->with('model_huyen', $model_huyen);
    }
    public function tonghop(Request $request)
    {
        if (!chkPhanQuyen('tonghopcunglaodonghuyen', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodonghuyen');
        }
        $inputs = $request->all();
        $model = tonghopdanhsachcungld::where('matb', $inputs['matb'])->get();
        $model_huyen = tonghopcungld_huyen::where('matb', $inputs['matb'])
            ->where('madvbc', session('admin')['madv'])
            ->get();
            // dd(session('admin'));
        // dd($model);
        // $m_dv = dmdonvi::where('madvbc', session('admin')['madvbc'])->where('phanloaitaikhoan', 'TH')->get();
        $m_dv=User::where('nhaplieu',1)->where('madvbc',session('admin')->madv)->get();

        $m_tonghop = tonghop_huyen::where('matb', $inputs['matb'])
            ->where('madv', session('admin')['madv'])->first();

        foreach ($m_dv as $dv) {
            $m_th = $model->where('madv', $dv->madv)->first();
            if (isset($m_th)) {
                $dv->noidung = $m_th->noidung;
                $dv->matb = $m_th->matb;
                $dv->math = $m_th->math;
                $dv->nam = $m_th->nam;
            } else {
                $dv->noidung = '';
                $dv->matb = '';
                $dv->math = '';
                $dv->nam = '';
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
        return view('cunglaodong.huyen.tonghop')
            ->with('model', $model)
            ->with('m_dv', $m_dv);
    }

    public function sendata(Request $request)
    {
        if (!chkPhanQuyen('tonghopcunglaodonghuyen', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodonghuyen');
        }
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
        if (!chkPhanQuyen('tonghopcunglaodonghuyen', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodonghuyen');
        }
        $inputs = $request->all();
        // dd($inputs);
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
        return view('cunglaodong.export.danhsach')
            ->with('model', $model)
            ->with('m_dv', $m_dv)
            ->with('doituong_ut', $doituong_ut)
            ->with('gdpt', $gdpt)
            ->with('cmkt', $cmkt)
            ->with('a_chuyennganh', $a_chuyennganh)
            ->with('tttghdkt', $tttghdkt)
            ->with('tttghdkt1', $tttghdkt1)
            ->with('tttghdkt2', $tttghdkt2)
            ->with('nam', $inputs['nam'])
            ->with('pageTitle', 'Danh sách cung lao động');
    }

    public function intonghop(Request $request)
    {
        if (!chkPhanQuyen('tonghopcunglaodonghuyen', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodonghuyen');
        }
        $inputs = $request->all();
        // dd($inputs);
        $model = tonghopdanhsachcungld::join('tonghopdanhsachcungld_ct', 'tonghopdanhsachcungld_ct.math', 'tonghopdanhsachcungld.math')
            ->select('tonghopdanhsachcungld_ct.*', 'tonghopdanhsachcungld.madv','tonghopdanhsachcungld.madvbc')
            ->where('tonghopdanhsachcungld.matb', $inputs['matb'])
            ->where('tonghopdanhsachcungld.madvbc', session('admin')['madv'])
            ->get();
        
        $m_dv = dmdonvi::where('madv', session('admin')['madv'])->first();
        // $model_dv = dmdonvi::where('madvbc', session('admin')['madvbc'])
        //     ->where('phanloaitaikhoan', 'SD')
        //     ->get();
        // dd(session('admin'));
        $model_dv=User::where('nhaplieu',1)->where('madvbc',session('admin')->madv)->get();
        // dd($model_dv);
        $doituong_ut = dmdoituonguutien::all();
        $gdpt = dmtrinhdogdpt::all();
        $cmkt = dmtrinhdokythuat::all();
        $tttghdkt = dmtinhtrangthamgiahdkt::all();
        $tttghdkt1 = dmtinhtrangthamgiahdktct::all();
        $tttghdkt2 = dmtinhtrangthamgiahdktct2::all();
        $a_chuyennganh = array_column(dmchuyenmondaotao::all()->toarray(), 'tendm', 'id');
        return view('cunglaodong.export.tonghop')
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
            ->with('nam', $inputs['nam'])
            ->with('pageTitle', 'Thông tin cung lao động');
    }

    public function tralai(Request $request)
    {
        if (!chkPhanQuyen('tonghopcunglaodonghuyen', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodonghuyen');
        }
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
        if (!chkPhanQuyen('tonghopcunglaodonghuyen', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodonghuyen');
        }
        $inputs = $request->all();
        $model = tonghop_huyen::where('matb', $inputs['matb'])
            ->where('madv', $inputs['madv'])
            ->first();

        return response()->json($model);
    }
}
