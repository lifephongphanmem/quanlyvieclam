<?php

namespace App\Http\Controllers\Tinhhinhsudunglaodong;

use App\Models\Nguoilaodong\nguoilaodong;
use App\Models\Tinhhinhsudunglaodong\thongbaotinhhinhsudungld;
use App\Models\Tinhhinhsudunglaodong\tinhhinhsudunglaodong;
use App\Models\Tinhhinhsudunglaodong\tinhhinhsudunglaodong_ct;
use App\Http\Controllers\Controller;
use App\Models\Danhmuc\dmchucvu;
use App\Models\Danhmuc\dmloaihieuluchdld;
use App\Models\Danhmuc\dmtinhtrangthamgiahdktct2;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class tinhhinhsudungldController extends Controller
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
        if (!chkPhanQuyen('nhanthongbaotinhhinhsudungld', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'nhanthongbaotinhhinhsudungld');
        }
        // $model=tinhhinhsudunglaodong::join('thongbaotinhhinhsudungld','thongbaotinhhinhsudungld.matb','tinhhinhsudunglaodong.matb')
        //                                 ->join('thongbaotinhhinhsudungld_doanhnghiep','thongbaotinhhinhsudungld_doanhnghiep.matb','thongbaotinhhinhsudungld.matb')
        //                                 ->select('thongbaotinhhinhsudungld.*','tinhhinhsudunglaodong.ngaygui AS senddate')
        //                                 ->where('thongbaotinhhinhsudungld_doanhnghiep.masodn',session('admin')['madv'])
        //                                 ->get();
        $model = thongbaotinhhinhsudungld::join('thongbaotinhhinhsudungld_doanhnghiep', 'thongbaotinhhinhsudungld_doanhnghiep.matb', 'thongbaotinhhinhsudungld.matb')
            ->select('thongbaotinhhinhsudungld.*')
            ->where('thongbaotinhhinhsudungld_doanhnghiep.masodn', session('admin')['madv'])
            ->get();
        return view('tinhhinhsudunglaodong.donvi.index')
            ->with('model', $model);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('tonghopdulieutinhhinhsudunglaodongdonvi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudunglaodongdonvi');
        }
        $inputs = $request->all();
        $time = Carbon::now();
        // $inputs['ngaygui']=$time->toDateString();
        $inputs['trangthai'] = 'CHUAGUI';
        $thongbao = thongbaotinhhinhsudungld::where('nam', $inputs['nam'])->where('tieude', $inputs['tieude'])->first();
        $inputs['matb'] = $thongbao->matb;
        $inputs['madv'] = session('admin')['madv'];
        $model = nguoilaodong::where('company', session('admin')['madv'])->get();
        foreach ($model as $val) {
            $data = [
                'matb' => $inputs['matb'],
                'nam' => $inputs['nam'],
                'madv' => $val->madb,
                'tieude' => $inputs['tieude'],
                'hoten' => $val->hoten,
                'mangld' => $val->ma_nld,
                'cmnd' => $val->cmnd,
                'gioitinh' => $val->gioitinh,
                'sobhxh' => $val->sobhxh,
                'bdbhxh' => $val->bdbhxh,
                'ktbhxh' => $val->ktbhxh,
                'ngaysinh' => $val->ngaysinh,
                'chucvu' => $val->chucvu,
                'vitrivl' => $val->nghenghiep,
                'mucluong' => $val->luongbhxh,
                'pcchucvu' => $val->pcchucvu,
                'pcthamnien' => $val->pcthamnien,
                'pcthamniennghe' => $val->pcthamniennghe,
                'pcluong' => $val->pcluong,
                'pcbosung' => $val->pcbosung,
                'bddochai' => $val->bddochai,
                'ktdochai' => $val->ktdochai,
                'loaihdld' => $val->loaihdld,
                'bdhdld' => $val->bdhdld,
                'kthdld' => $val->kthdld
            ];
            tinhhinhsudunglaodong_ct::create($data);
        }
        tinhhinhsudunglaodong::create($inputs);

        return redirect('/tinhhinhsudungld/don_vi/danhsach')
            ->with('success', 'Tạo số liệu thành công');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!chkPhanQuyen('tonghopdulieutinhhinhsudunglaodongdonvi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudunglaodongdonvi');
        }
        $model = tinhhinhsudunglaodong::findOrFail($id);
        $model_ct = tinhhinhsudunglaodong_ct::where('matb', $model->matb)->get();
        if (isset($model_ct)) {
            foreach ($model_ct as $ct) {
                $ct->delete();
            }
        }

        $model->delete();
        return redirect('/tinhhinhsudungld/don_vi/danhsach')
            ->with('success', 'Xóa thành công');
    }

    public function danhsach()
    {
        if (!chkPhanQuyen('tonghopdulieutinhhinhsudunglaodongdonvi', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudunglaodongdonvi');
        }
        $model = tinhhinhsudunglaodong::join('thongbaotinhhinhsudungld', 'thongbaotinhhinhsudungld.matb', 'tinhhinhsudunglaodong.matb')
            ->select('tinhhinhsudunglaodong.*', 'thongbaotinhhinhsudungld.tieude', 'thongbaotinhhinhsudungld.hannop', 'thongbaotinhhinhsudungld.ngaygui AS ngaynhan')
            ->where('madv', session('admin')['madv'])
            ->get();
        return view('tinhhinhsudunglaodong.donvi.tonghop')
            ->with('model', $model)
            ->with('capdo', 'X');
    }

    public function sendData($id)
    {
        if (!chkPhanQuyen('tonghopdulieutinhhinhsudunglaodongdonvi', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudunglaodongdonvi');
        }
        $model = tinhhinhsudunglaodong::findOrFail($id);
        $time = Carbon::now();
        $model->update(['trangthai' => 'DAGUI', 'ngaygui' => $time->toDateString()]);
        return redirect('/tinhhinhsudungld/don_vi/danhsach')
            ->with('success', 'Gửi thành công');
    }

    public function lydo($id)
    {
        if (!chkPhanQuyen('tonghopdulieutinhhinhsudunglaodongdonvi', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudunglaodongdonvi');
        }
        $model = tinhhinhsudunglaodong::findOrFail($id);
        return response()->json($model);
    }

    public function intonghop(Request $request)
    {
        $inputs = $request->all();
        if ($inputs['capdo'] == 'X') {
            if (!chkPhanQuyen('tonghopdulieutinhhinhsudunglaodongdonvi', 'danhsach')) {
                return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudunglaodongdonvi');
            }
            $model = tinhhinhsudunglaodong::join('tinhhinhsudunglaodong_ct', 'tinhhinhsudunglaodong_ct.matb', 'tinhhinhsudunglaodong.matb')
            ->select('tinhhinhsudunglaodong_ct.*')
            ->where('tinhhinhsudunglaodong.matb', $inputs['matb'])
            ->where('tinhhinhsudunglaodong.madv', $inputs['madv'])
            ->where('tinhhinhsudunglaodong.nam', $inputs['nam'])
            ->get();
        } else {
            if (!chkPhanQuyen('tonghopdulieutinhhinhsudungld', 'danhsach')) {
                return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudunglaodongdonvi');
            }
            $model = tinhhinhsudunglaodong::join('tinhhinhsudunglaodong_ct', 'tinhhinhsudunglaodong_ct.matb', 'tinhhinhsudunglaodong.matb')
            ->select('tinhhinhsudunglaodong_ct.*')
            ->where('tinhhinhsudunglaodong.matb', $inputs['matb'])
            ->where('tinhhinhsudunglaodong.madv', $inputs['madv'])
            ->where('tinhhinhsudunglaodong.nam', $inputs['nam'])
            ->where('tinhhinhsudunglaodong.trangthai','DAGUI')
            ->get();
        }




        $m_dv = User::where('madv', session('admin')->madv)->first();
        $list_nghe = getParamsByNametype('Nghề nghiệp người lao động');
        $a_vitri = array();
        $a_vitrikhac = array();
        foreach ($list_nghe as $key => $ct) {
            if (in_array($ct->id, [37, 38, 39])) {
                $a_vitri[$ct->id] = $ct->name;
            } else {
                $a_vitrikhac[$key] = $ct->id;
            }
        }

        // dd($a_vitrikhac);
        // $a_vitri=array_column($list_nghe->toarray(),'name','id');
        $a_chucvu = array_column(dmchucvu::all()->toarray(), 'tencv', 'id');
        $a_loaihdld = array_column(dmloaihieuluchdld::all()->toarray(), 'tenlhl', 'madmlhl');


        return view('tinhhinhsudunglaodong.export.donvi.tonghop')
            ->with('model', $model)
            ->with('m_dv', $m_dv)
            ->with('a_vitri', $a_vitri)
            ->with('a_vitrikhac', $a_vitrikhac)
            ->with('a_chucvu', $a_chucvu)
            ->with('a_loaihdld', $a_loaihdld)
            ->with('pageTitle', 'Tổng hợp dữ liệu');
    }

    public function tonghop(Request $request)
    {
        $inputs = $request->all();

        $model = tinhhinhsudunglaodong::join('tinhhinhsudunglaodong_ct', 'tinhhinhsudunglaodong_ct.matb', 'tinhhinhsudunglaodong.matb')
            ->select('tinhhinhsudunglaodong_ct.*')
            ->where('tinhhinhsudunglaodong.matb', $inputs['matb'])
            ->where('tinhhinhsudunglaodong.madv', $inputs['madv'])
            ->where('tinhhinhsudunglaodong.nam', $inputs['nam'])
            ->get();

        $m_dv = User::where('madv', session('admin')->madv)->first();

        $a_vitrivl=array_column(dmtinhtrangthamgiahdktct2::where('manhom2','20221108050559')->get()->toarray(),'tentgktct2','madmtgktct2');

        // dd($a_vitrikhac);
        // $a_vitri=array_column($list_nghe->toarray(),'name','id');
        $a_chucvu = array_column(dmchucvu::all()->toarray(), 'tencv', 'id');
        $a_loaihdld = array_column(dmloaihieuluchdld::all()->toarray(), 'tenlhl', 'madmlhl');

        return view('tinhhinhsudunglaodong.donvi.tonghopdanhsach')
            ->with('model', $model)
            ->with('m_dv', $m_dv)
            ->with('a_vitri', $a_vitrivl)
            // ->with('a_vitrikhac', $a_vitrikhac)
            ->with('a_chucvu', $a_chucvu)
            ->with('a_loaihdld', $a_loaihdld)
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Tổng hợp dữ liệu');
    }
}
