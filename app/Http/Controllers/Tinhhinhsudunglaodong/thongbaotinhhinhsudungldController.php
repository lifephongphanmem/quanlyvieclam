<?php

namespace App\Http\Controllers\Tinhhinhsudunglaodong;

use App\Models\Company;
use App\Models\Tinhhinhsudunglaodong\thongbaotinhhinhsudungld;
use App\Models\Tinhhinhsudunglaodong\thongbaotinhhinhsudungld_doanhnghiep;
use App\Http\Controllers\Controller;
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
                return redirect('/home');
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
        $model=thongbaotinhhinhsudungld::all();
        $model_cty=User::where('phanloaitk',2)->get();
        $congty=Company::all();
        foreach($model_cty as $cty){
            $c_ty=$congty->where('user',$cty->id)->first();
            if(isset($c_ty)){
                $cty->masodn=$c_ty->masodn;
            }else{
                $cty->masodn='';
            }
        }
        return view('tinhhinhsudunglaodong.thongbao.index')
                ->with('model',$model)
                ->with('model_cty',$model_cty);
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
        $inputs=$request->all();
        $inputs['matb']=getdate()[0];
        $inputs['tieude'] ==0?$inputs['hannop']='05-06':$inputs['hannop']='05-12';
        // $inputs['tieude']==0?$inputs['tieude']='Báo cáo tình hình sử dụng lao động định kỳ 6 tháng':$inputs['tieude']='Báo cáo tình hình sử dụng lao động hằng năm';
        thongbaotinhhinhsudungld::create($inputs);
        return redirect('/tinhhinhsudungld/thongbao')
                ->with('success','Thêm mới thành công');
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
        $model=thongbaotinhhinhsudungld::findOrFail($id);

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
        $inputs=$request->all();
        $inputs['tieude'] ==0?$inputs['hannop']='05-06':$inputs['hannop']='05-12';
        $model=thongbaotinhhinhsudungld::findOrFail($id);
        $model->update($inputs);
        return redirect('/tinhhinhsudungld/thongbao')
                    ->with('success','Cập nhật thành công');

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
        $model=thongbaotinhhinhsudungld::findOrFail($id);
        $model_ct=thongbaotinhhinhsudungld_doanhnghiep::where('matb',$model->matb)->get();
        if(isset($model_ct)){
            foreach($model_ct as $ct){
                $ct->delete();
            }
        }
        $model->delete();

        return redirect('/tinhhinhsudungld/thongbao')
                    ->with('success','Xóa thành công');
    }
    public function sendData(Request $request,$id){
        if (!chkPhanQuyen('thongbaotinhhinhsudunglaodong', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'thongbaotinhhinhsudunglaodong');
        }
        $inputs=$request->all();
        $thongbao=thongbaotinhhinhsudungld::findOrFail($id);
        $tb_ct=thongbaotinhhinhsudungld_doanhnghiep::where('matb',$thongbao->matb)->get();
        if(count($tb_ct)>0){
            return view('errors.tontai_dulieu')
                    ->with('message', 'Thông báo đã được gửi')
                    ->with('furl','/cungld/thongbao');
        }

        if($inputs['masodn'][0] == 'all')
        {
            $model=User::where('phanloaitk',2)->get();
            foreach($model as $ct){
                $c_ty=Company::select('masodn')->where('user',$ct->id)->first();
                $data=[
                    'matb'=>$thongbao->matb,
                    'masodn'=>isset($c_ty)?$c_ty->masodn:''
                ];
                thongbaotinhhinhsudungld_doanhnghiep::create($data);
            }
        }else{
            foreach($inputs['masodn'] as $item){
                $data=[
                    'matb'=>$thongbao->matb,
                    'masodn'=>$item
                ];
                thongbaotinhhinhsudungld_doanhnghiep::create($data);
            }
        }

        $time=Carbon::now();
        $thongbao->update(['ngaygui'=>$time->toDateString()]);

        return redirect('/tinhhinhsudungld/thongbao')
                ->with('success','Gửi thành công');
    }
}
