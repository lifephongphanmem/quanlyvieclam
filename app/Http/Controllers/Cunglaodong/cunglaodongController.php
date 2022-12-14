<?php

namespace App\Http\Controllers\Cunglaodong;

use App\Models\Danhmuc\dmdoituonguutien;
use App\Models\Danhmuc\dmtinhtrangthamgiahdkt;
use App\Models\Danhmuc\dmtinhtrangthamgiahdktct;
use App\Models\Danhmuc\dmtinhtrangthamgiahdktct2;
use App\Models\Danhmuc\dmtrinhdogdpt;
use App\Models\Danhmuc\dmtrinhdokythuat;
use App\Models\Danhmuc\dmchuyenmondaotao;
use App\Models\Danhmuc\dmdonvi;
use App\Models\Nguoilaodong\nguoilaodong;
use App\Models\Cunglaodong\thongbaocungld;
use App\Models\Cunglaodong\tonghopcungld_huyen;
use App\Models\Cunglaodong\tonghopdanhsachcungld;
use App\Models\Cunglaodong\tonghopdanhsachcungld_ct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Danhmuc\danhmuchanhchinh;
use App\Models\Danhmuc\dmchucvu;
use App\Models\Danhmuc\dmloaihieuluchdld;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class cunglaodongController extends Controller
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
        if (!chkPhanQuyen('tonghopcunglaodongxa', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodongxa');
        }
        $model = tonghopdanhsachcungld::where('madv', session('admin')['madv'])->get();
        $model_cungld = thongbaocungld::all();
        return view('cunglaodong.donvi.index')
            ->with('model', $model)
            ->with('nam',date('Y'))
            ->with('model_cungld', $model_cungld);
    }

public function nhanthongbao()
{
    if (!chkPhanQuyen('nhanthongbaocunglaodong', 'danhsach')) {
        return view('errors.noperm')->with('machucnang', 'nhanthongbaocunglaodong');
    }
    $user=User::where('madv',session('admin')['madv'])->first();
    $model=thongbaocungld::join('thongbao_donvi','thongbao_donvi.matb','thongbaocungld.matb')
                            ->select('thongbaocungld.*')
                            ->where('thongbao_donvi.madv',session('admin')->madv)
                            ->get();
                            // dd($model);
    return view('cunglaodong.donvi.nhanthongbao')
            ->with('model',$model);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('tonghopcunglaodongxa', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodongxa');
        }
        $inputs = $request->all();
        $model=tonghopdanhsachcungld::where('nam',$inputs['nam'])->where('madv',session('admin')['madv'])->first();
        if(isset($model)){
            return view('errors.tontai_dulieu')
                    ->with('furl','/cungld/danh_sach/don_vi')
                    ->with('message','Đã tạo tổng hợp');
        }
        $inputs['math'] = getdate()[0];
        $thongbao = thongbaocungld::where('nam', $inputs['nam'])->first();
        if(isset($thongbao)){
            $inputs['matb']=$thongbao->matb;
        $inputs['noidung'] = 'Tổng hợp danh sách theo thông báo: "' . $thongbao->tieude . '"';
        $inputs['trangthai'] = 'CHUAGUI';
        $inputs['madvbc'] = session('admin')['madvbc'];
        $inputs['madv'] = session('admin')['madv'];
        tonghopdanhsachcungld::create($inputs);
        //lấy thông tin người lao động đẩy vào bảng tonghopdanhsachld_ct
        $m_ngld = nguoilaodong::where('madb', session('admin')['madv'])->get();
        foreach ($m_ngld as $val) {
            $data = [
                'nam'=>$inputs['nam'],
                'math' => $inputs['math'],
                'ma_ngld' => $val->ma_nld,
                'madb' => $val->madb,
                'hoten' => $val->hoten,
                'cmnd' => $val->cmnd,
                'phone' => $val->phone,
                'ngaysinh' => $val->ngaysinh,
                'dantoc' => $val->dantoc,
                'gioitinh' => $val->gioitinh,
                'quocgia' => $val->nation,
                'sobaohiem' => $val->sobaohiem,
                'bdbhxh' => $val->bdbhxh,
                'ktbhxh' => $val->ktbhxh,
                'luongbhxh' => $val->luongbhxh,
                'trinhdogiaoduc' => $val->trinhdogiaoduc,
                'trinhdocmkt' => $val->trinhdocmkt,
                'nghenghiep' => $val->nghenghiep,
                'linhvucdaotao' => $val->chuyenmondaotao,
                'loaihdld' => $val->loaihdld,
                'bdhopdong' => $val->bdhopdong,
                'kthopdong' => $val->kthopdong,
                'luong' => $val->luong,
                'pcchucvu' => $val->pcchucvu,
                'pcthamnien' => $val->pcthamnien,
                'pcthamniennghe' => $val->pcthamniennghe,
                'pcluong' => $val->pcluong,
                'pcbosung' => $val->pcbosung,
                'bddochai' => $val->bddochai,
                'ktdochai' => $val->ktdochai,
                'vitri' => $val->vitri,
                'chucvu' => $val->chucvu,
                'ghichu' => $val->ghichu,
                'company' => $val->company,
                'sate' => $val->sate,
                'thuongtru' => $val->thuongtru,
                'tamtru' => $val->tamtru,
                'doituonguutien' => $val->doituonguutien,
                'cvhientai' => $val->cvhientai,
                'vithevl' => $val->vithevl,
                'thatnghiep' => $val->thatnghiep,
                'thoigianthatnghiep' => $val->thoigianthatnghiep,
                'lydoktg' => $val->lydoktg,
                'tinhtrangvl' => $val->tinhtrangvl,
                'thong'=>$val->thon
            ];
            tonghopdanhsachcungld_ct::create($data);
        }
        }else{
            return view('errors.tontai_dulieu')
                    ->with('furl','/cungld/danh_sach/don_vi')
                    ->with('message','Chưa có đợt thu thập cho năm '.$inputs['nam']);
        }
        

        return redirect('/cungld/danh_sach/don_vi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        if (!chkPhanQuyen('tonghopcunglaodongxa', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodongxa');
        }
        $inputs=$request->all();

        $m_dv=dmdonvi::where('madv',session('admin')['madv'])->first();
        $model = tonghopdanhsachcungld_ct::where('math', $id)->get();
        if($inputs['tinhtrangvl'] != null)
        {
            // dd(1);
            $model=$model->where('tinhtrangvl',$inputs['tinhtrangvl']);
        }
        // dd($model);
        $doituong_ut=dmdoituonguutien::all();
        $gdpt=dmtrinhdogdpt::all();
        $cmkt=dmtrinhdokythuat::all();
        $tttghdkt=dmtinhtrangthamgiahdkt::all();
        $tttghdkt1=dmtinhtrangthamgiahdktct::all();
        $tttghdkt2=dmtinhtrangthamgiahdktct2::all();
        $a_chuyennganh = array_column(dmchuyenmondaotao::all()->toarray(),'tendm','id');
        // dd($a_chuyennganh);
        return view('cunglaodong.donvi.danhsach')
            ->with('model', $model)
            ->with('m_dv', $m_dv)
            ->with('doituong_ut', $doituong_ut)
            ->with('gdpt', $gdpt)
            ->with('cmkt', $cmkt)
            ->with('a_chuyennganh', $a_chuyennganh)
            ->with('tttghdkt', $tttghdkt)
            ->with('tttghdkt1', $tttghdkt1)
            ->with('tttghdkt2', $tttghdkt2)
            ->with('pageTitle', 'Thông tin cung lao động');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!chkPhanQuyen('tonghopcunglaodongxa', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodongxa');
        }
        $model = tonghopdanhsachcungld::findOrFail($id);
        $model_ct = tonghopdanhsachcungld_ct::where('math', $model->math)->get();
        foreach ($model_ct as $ct) {
            $ct->delete();
        }
        $model->delete();
        return redirect('/cungld/danh_sach/don_vi')
            ->with('success', 'Xóa thành công');
    }

    public function senddata($id)
    {
        if (!chkPhanQuyen('tonghopcunglaodongxa', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodongxa');
        }
        $model = tonghopdanhsachcungld::findOrFail($id);
        $math = getdate()[0];
        $time = Carbon::now();
        $ngaygui = $time->toDateString();
        $data = [
            'madv' => session('admin')['madv'],
            'mathdv' => $math,
            'nam'=>$model->nam,
            'matb' => $model->matb,
            'madvbc' => session('admin')['madvbc'],
            'trangthai' => 'CHUAGUI',
            'noidung' => 'Tổng hợp danh sách cung lao động đơn vị: ' . session('admin')['tendv']
        ];
        //trường hợp trả lại dữ liệu
        $m_huyen=tonghopcungld_huyen::where('nam',$model->nam)->where('matb',$model->matb)->where('madv',session('admin')['madv'])->first();
        if(isset($m_huyen)){
            $m_huyen->delete();
        }
        tonghopcungld_huyen::create($data);
        $model->update(['ngaygui' => $ngaygui, 'trangthai' => 'DAGUI', 'mathh' => $math]);
        return redirect('/cungld/danh_sach/don_vi');
    }

    public function lydo($id)
    {
        if (!chkPhanQuyen('tonghopcunglaodongxa', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'tonghopcunglaodongxa');
        }
        $model = tonghopdanhsachcungld::findOrFail($id);

        return response()->json($model);
    }

    public function tonghop(Request $request)
    {
        $inputs=$request->all();
        $model=tonghopdanhsachcungld_ct::where('math',$inputs['math'])->get();
        
        $a_trinhdogdpt=array_column(dmtrinhdogdpt::all()->toarray(),'tengdpt','madmgdpt');
        $a_trinhdocmkt=array_column(dmtrinhdokythuat::all()->toarray(),'tentdkt','madmtdkt');
        $a_tinhtrangvl=array_column(dmtinhtrangthamgiahdkt::all()->toarray(),'tentgkt','madmtgkt');
        $a_doituonguutien=array_column(dmdoituonguutien::all()->toarray(),'tendoituong','madmdt');

        return view('cunglaodong.donvi.tonghop')
                    ->with('model',$model)
                    ->with('math',$inputs['math'])
                    ->with('a_trinhdogdpt',$a_trinhdogdpt)
                    ->with('a_trinhdocmkt',$a_trinhdocmkt)
                    ->with('a_doituonguutien',$a_doituonguutien)
                    ->with('a_tinhtrangvl',$a_tinhtrangvl);
    }

    public function SuaDanhSach($id)
    {
        $model_ds=tonghopdanhsachcungld_ct::findOrFail($id);
        $countries_list = getCountries();
        // get params
        $dmhc =danhmuchanhchinh::all();
        $list_cmkt = dmtrinhdokythuat::all();
        $list_tdgd = dmtrinhdogdpt::all();
        // $list_nghe = $this->getParamsByNametype('Nghề nghiệp người lao động');
        $list_vitri= dmtinhtrangthamgiahdktct2::where('manhom2','20221108050559')->get();
        $list_linhvuc = dmchuyenmondaotao::all();
        $list_hdld = dmloaihieuluchdld::all();
        $doituong_ut = dmdoituonguutien::all();
        $chucvu = dmchucvu::all();
        $congty = Company::all();
    
        $list_tinhtrangvl = dmtinhtrangthamgiahdkt::all();
        $list_tinhtrangvl1 = dmtinhtrangthamgiahdktct::all();
        $list_tinhtrangvl2 = dmtinhtrangthamgiahdktct2::all();
    
    
        $a_vithevl = array();
        $a_thoigianthatnghiep = array();
        $a_nguoithatnghiep = array();
        $a_lydo_khongthamgia_hdkt = array();
        foreach ($list_tinhtrangvl1 as $item) {
          $model = $list_tinhtrangvl2->where('manhom2', $item->madmtgktct);
          if (count($model) > 0) {
            foreach ($model as $key => $ct) {
              if ($item->tentgktct == 'Vị thế việc làm') {
                $a_vithevl[$key]['madm'] = $ct->madmtgktct2;
                $a_vithevl[$key]['tendm'] = $ct->tentgktct2;
              }
              if ($item->tentgktct == 'Thời gian thất nghiệp') {
                $a_thoigianthatnghiep[$key]['madm'] = $ct->madmtgktct2;
                $a_thoigianthatnghiep[$key]['tendm'] = $ct->tentgktct2;
              }
            }
          }
        }
    
        foreach ($list_tinhtrangvl as $val) {
          $m = $list_tinhtrangvl1->where('manhom', $val->madmtgkt);
          if (count($m)) {
            foreach ($m as $k => $ct) {
              if ($val->tentgkt == 'Người thất nghiệp' && $ct->tentgktct != 'Thời gian thất nghiệp') {
                $a_nguoithatnghiep[$k]['madm'] = $ct->madmtgktct;
                $a_nguoithatnghiep[$k]['tendm'] = $ct->tentgktct;
              }
    
              if ($val->tentgkt == 'Không tham gia hoạt động kinh tế') {
                $a_lydo_khongthamgia_hdkt[$k]['madm'] = $ct->madmtgktct;
                $a_lydo_khongthamgia_hdkt[$k]['tendm'] = $ct->tentgktct;
              }
            }
          }
        }
    
        $a_huyen = array_column(danhmuchanhchinh::where('capdo', 'H')->get()->toarray(), 'name', 'id');
        $a_xa = array_column(danhmuchanhchinh::where('capdo', 'X')->get()->toarray(), 'name', 'id');
        return view('nguoilaodong.suadanhsach')
                ->with('model',$model_ds)
                ->with('countries_list', $countries_list)
                ->with('dmhc', $dmhc)
                ->with('chucvu', $chucvu)
                ->with('a_huyen', $a_huyen)
                ->with('a_xa', $a_xa)
                ->with('doituong_ut', $doituong_ut)
                ->with('congty', $congty)
                ->with('list_cmkt', $list_cmkt)
                ->with('list_tdgd', $list_tdgd)
                ->with('list_vitri', $list_vitri)
                ->with('a_vithevl', $a_vithevl)
                ->with('a_thoigianthatnghiep', $a_thoigianthatnghiep)
                ->with('a_nguoithatnghiep', $a_nguoithatnghiep)
                ->with('a_lydo_khongthamgia_hdkt', $a_lydo_khongthamgia_hdkt)
                ->with('list_tinhtrangvl', $list_tinhtrangvl)
                ->with('list_linhvuc', $list_linhvuc)
                ->with('list_hdld', $list_hdld);
                // ->with('model', $model_ld);
    }

    public function CapNhatDanhSach(Request $request,$id)
    {
        $inputs=$request->all();
        $model=tonghopdanhsachcungld_ct::findOrFail($id);
        $a_diaban = danhmuchanhchinh::all();
        $a_xa = array_column($a_diaban->where('capdo', 'X')->toarray(), 'name', 'id');
        isset($inputs['xa']) ? $tenxa = $a_xa[$inputs['xa']] : $tenxa = '';
        isset($inputs['xa']) ? $tenhuyen = $this->getHuyen($inputs['xa']) : $tenhuyen = '';
        if(isset($inputs['address'])){
          $inputs['thuongtru'] = $inputs['address'] . '-' . $tenxa . '-' . $tenhuyen . '- Quảng Bình';
        }
        
        $model->update($inputs);

        return redirect('/cungld/danh_sach/don_vi/tonghop?math='.$model->math)
                ->with('success','Cập nhật thành công');
    }

    public function getHuyen($maxa)
    {
      $xa = danhmuchanhchinh::findOrFail($maxa);
      $huyen = danhmuchanhchinh::where('maquocgia', $xa->parent)->first();
      $tenhuyen = $huyen->name;
      return $tenhuyen;
    }

    public function XoaDanhSachCT($id)
    {
        $model=tonghopdanhsachcungld_ct::findOrFail($id);
        $model->delete();

        return redirect('/cungld/danh_sach/don_vi/tonghop?math='.$model->math)
                    ->with('success','Xóa thành công');
    }
}
