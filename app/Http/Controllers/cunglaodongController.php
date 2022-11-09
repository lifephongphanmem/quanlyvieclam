<?php

namespace App\Http\Controllers;

use App\Models\nguoilaodong;
use App\Models\thongbaocungld;
use App\Models\tonghopcungld_huyen;
use App\Models\tonghopdanhsachcungld;
use App\Models\tonghopdanhsachcungld_ct;
use Illuminate\Http\Request;
use Carbon\Carbon;

class cunglaodongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = tonghopdanhsachcungld::where('madv', session('admin')['madv'])->get();
        $model_cungld = thongbaocungld::all();
        return view('pages.tonghopcungld.index')
            ->with('model', $model)
            ->with('model_cungld', $model_cungld);
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
        $inputs = $request->all();
        $inputs['math'] = $inputs['matb'] . '_' . getdate()[0];
        $mes = thongbaocungld::where('matb', $inputs['matb'])->first()->tieude;
        $inputs['noidung'] = 'Tổng hợp danh sách theo thông báo: "' . $mes . '"';
        $inputs['trangthai'] = 'CHUAGUI';
        $inputs['madvbc'] = session('admin')['madvbc'];
        $inputs['madv'] = session('admin')['madv'];
        tonghopdanhsachcungld::create($inputs);
        //lấy thông tin người lao động đẩy vào bảng tonghopdanhsachld_ct
        $m_ngld = nguoilaodong::where('madb', session('admin')['madv'])->get();
        foreach ($m_ngld as $val) {
            $data = [
                'math' => $inputs['math'],
                'ma_ngld' => $val->ma_nld,
                'madb' => $val->madb,
                'hoten' => $val->hoten,
                'cmnd' => $val->cmnd,
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
                'linhvucdaotao' => $val->linhvucdaotao,
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
                'tinhtrangvl' => $val->tinhtrangvl
            ];
            tonghopdanhsachcungld_ct::create($data);
        }

        return redirect('/cungld/danh_sach/don_vi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = tonghopdanhsachcungld_ct::where('math', $id)->get();
        return view('pages.tonghopcungld.danhsach')
            ->with('model', $model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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
        $model = tonghopdanhsachcungld::findOrFail($id);
        $math = getdate()[0];
        $time = Carbon::now();
        $ngaygui = $time->toDateString();
        $data = [
            'madv' => session('admin')['madv'],
            'mathdv' => $math,
            'matb' => $model->matb,
            'madvbc' => session('admin')['madvbc'],
            'trangthai' => 'CHUAGUI',
            'noidung' => 'Tổng hợp danh sách cung lao động đơn vị: ' . session('admin')['tendv']
        ];

        tonghopcungld_huyen::create($data);
        $model->update(['ngaygui' => $ngaygui, 'trangthai' => 'DAGUI', 'mathh' => $math]);
        return redirect('/cungld/danh_sach/don_vi');
    }

    public function lydo($id)
    {
        $model = tonghopdanhsachcungld::findOrFail($id);

        return response()->json($model);
    }
}
