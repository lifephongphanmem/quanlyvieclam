<?php

namespace App\Http\Controllers\Tinhhinhsudunglaodong;

use App\Models\Company;
use App\Models\Tinhhinhsudunglaodong\thongbaotinhhinhsudungld;
use App\Models\Tinhhinhsudunglaodong\thongbaotinhhinhsudungld_doanhnghiep;
use App\Http\Controllers\Controller;
use App\Jobs\SenMailDoanhNghiep;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class thongbaotinhhinhsudungldController extends Controller
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
        if (!chkPhanQuyen('thongbaotinhhinhsudunglaodong', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'thongbaotinhhinhsudunglaodong');
        }
        $model = thongbaotinhhinhsudungld::all();
        $model_cty = User::where('phanloaitk', 2)->get();
        $congty = Company::all();
        foreach ($model_cty as $cty) {
            $c_ty = $congty->where('user', $cty->id)->first();
            if (isset($c_ty)) {
                $cty->masodn = $c_ty->masodn;
            } else {
                $cty->masodn = '';
            }
        }
        return view('tinhhinhsudunglaodong.thongbao.index')
            ->with('model', $model)
            ->with('model_cty', $model_cty);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('thongbaotinhhinhsudunglaodong', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'thongbaotinhhinhsudunglaodong');
        }
        $inputs = $request->all();
        $inputs['matb'] = getdate()[0];
        $inputs['tieude'] == 0 ? $inputs['hannop'] = '05-06' : $inputs['hannop'] = '05-12';
        // $inputs['tieude']==0?$inputs['tieude']='B??o c??o t??nh h??nh s??? d???ng lao ?????ng ?????nh k??? 6 th??ng':$inputs['tieude']='B??o c??o t??nh h??nh s??? d???ng lao ?????ng h???ng n??m';
        thongbaotinhhinhsudungld::create($inputs);
        return redirect('/tinhhinhsudungld/thongbao')
            ->with('success', 'Th??m m???i th??nh c??ng');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!chkPhanQuyen('thongbaotinhhinhsudunglaodong', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'thongbaotinhhinhsudunglaodong');
        }
        $model = thongbaotinhhinhsudungld::findOrFail($id);

        return response()->json($model);
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
        if (!chkPhanQuyen('thongbaotinhhinhsudunglaodong', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'thongbaotinhhinhsudunglaodong');
        }
        $inputs = $request->all();
        $inputs['tieude'] == 0 ? $inputs['hannop'] = '05-06' : $inputs['hannop'] = '05-12';
        $model = thongbaotinhhinhsudungld::findOrFail($id);
        $model->update($inputs);
        return redirect('/tinhhinhsudungld/thongbao')
            ->with('success', 'C???p nh???t th??nh c??ng');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!chkPhanQuyen('thongbaotinhhinhsudunglaodong', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'thongbaotinhhinhsudunglaodong');
        }
        $model = thongbaotinhhinhsudungld::findOrFail($id);
        $model_ct = thongbaotinhhinhsudungld_doanhnghiep::where('matb', $model->matb)->get();
        if (isset($model_ct)) {
            foreach ($model_ct as $ct) {
                $ct->delete();
            }
        }
        $model->delete();

        return redirect('/tinhhinhsudungld/thongbao')
            ->with('success', 'X??a th??nh c??ng');
    }
    public function sendData(Request $request, $id)
    {
        if (!chkPhanQuyen('thongbaotinhhinhsudunglaodong', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'thongbaotinhhinhsudunglaodong');
        }
        $inputs = $request->all();
// dd($inputs);
        $thongbao = thongbaotinhhinhsudungld::findOrFail($id);
        $tb_ct = thongbaotinhhinhsudungld_doanhnghiep::where('matb', $thongbao->matb)->get();
        if (count($tb_ct) > 0) {
            return view('errors.tontai_dulieu')
                ->with('message', 'Th??ng b??o ???? ???????c g???i')
                ->with('furl', '/cungld/thongbao');
        }
        //G???i k??m file
        if (isset($inputs['filequyetdinh'])) {
            $file = $inputs['filequyetdinh'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/tinhhinhsudunglaodong/', $name);
            $inputs['filequyetdinh'] = 'uploads/tinhhinhsudunglaodong/' . $name;
        }

        if (isset($inputs['filekhac'])) {
            $file = $inputs['filekhac'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/tinhhinhsudunglaodong/', $name);
            $inputs['filekhac'] = 'uploads/tinhhinhsudunglaodong/' . $name;
        }

        if ($inputs['madv'][0] == 'all') {
            // $modeldvs = Company::all();//T???t ????? demo
            $modeldvs=Company::OrderBy('id','desc')->limit(3)->get();//t???m ????? demo, sau fix queue
            $model = User::where('phanloaitk', 2)->get();
            foreach ($model as $ct) {
                $c_ty = Company::select('madv')->where('user', $ct->id)->first();
                $data = [
                    'matb' => $thongbao->matb,
                    'masodn' => isset($c_ty) ? $c_ty->madv : ''
                ];
                thongbaotinhhinhsudungld_doanhnghiep::create($data);
            }
        } else {
            $modeldvs = Company::wherein('madv', $inputs['madv'])->get();
            foreach ($inputs['madv'] as $item) {
                $data = [
                    'matb' => $thongbao->matb,
                    'masodn' => $item
                ];
                thongbaotinhhinhsudungld_doanhnghiep::create($data);
            }
        }

        $time = Carbon::now();
        $thongbao->update(['ngaygui' => $time->toDateString(), 'filequyetdinh' => $inputs['filequyetdinh'] ?? '', 'filekhac' => $inputs['filekhac'] ?? '']);

        //G???i email
        $m_thongbao = thongbaotinhhinhsudungld::findOrFail($id);
        $contentdn = 'Th??ng b??o thu th???p th??ng tin t??nh h??nh s??? d???ng lao ?????ng';
        $filedn = [$m_thongbao->filequyetdinh, $m_thongbao->filekhac];
        if(isset($inputs['guimail'])){
            foreach ($modeldvs as $modeldn) {
             $run=new SenMailDoanhNghiep($modeldn, $contentdn, $filedn);
                $run->handle();
            }
        }

        return redirect('/tinhhinhsudungld/thongbao')
            ->with('success', 'G???i th??nh c??ng');
    }
}
