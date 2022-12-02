<?php

namespace App\Http\Controllers\Tinhhinhsudunglaodong;

use App\Models\Nguoilaodong\nguoilaodong;
use App\Models\Tinhhinhsudunglaodong\thongbaotinhhinhsudungld;
use App\Models\Tinhhinhsudunglaodong\tinhhinhsudunglaodong;
use App\Models\Tinhhinhsudunglaodong\tinhhinhsudunglaodong_ct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class tinhhinhsudungldController extends Controller
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
        if (!chkPhanQuyen('nhanthongbaotinhhinhsudungld', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'nhanthongbaotinhhinhsudungld');
        }
        // $model=tinhhinhsudunglaodong::join('thongbaotinhhinhsudungld','thongbaotinhhinhsudungld.matb','tinhhinhsudunglaodong.matb')
        //                                 ->join('thongbaotinhhinhsudungld_doanhnghiep','thongbaotinhhinhsudungld_doanhnghiep.matb','thongbaotinhhinhsudungld.matb')
        //                                 ->select('thongbaotinhhinhsudungld.*','tinhhinhsudunglaodong.ngaygui AS senddate')
        //                                 ->where('thongbaotinhhinhsudungld_doanhnghiep.masodn',session('admin')['madv'])
        //                                 ->get();
        $model=thongbaotinhhinhsudungld::join('thongbaotinhhinhsudungld_doanhnghiep','thongbaotinhhinhsudungld_doanhnghiep.matb','thongbaotinhhinhsudungld.matb')
                                            ->select('thongbaotinhhinhsudungld.*')
                                            ->where('thongbaotinhhinhsudungld_doanhnghiep.masodn',session('admin')['madv'])
                                            ->get();
        return view('tinhhinhsudunglaodong.donvi.index')
                    ->with('model',$model);
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
        $inputs=$request->all();
        $time=Carbon::now();
        // $inputs['ngaygui']=$time->toDateString();
        $inputs['trangthai']='CHUAGUI';
        $thongbao=thongbaotinhhinhsudungld::where('nam',$inputs['nam'])->where('tieude',$inputs['tieude'])->first();
        $inputs['matb']=$thongbao->matb;
        $inputs['madv']=session('admin')['madv'];
        $model=nguoilaodong::where('company',session('admin')['madv'])->get();

        foreach($model as $val)
        {
            $data=[
                'matb'=>$inputs['matb'],
                'nam'=>$inputs['nam'],
                'madv'=>session('admin')['madv'],
                'tieude'=>$inputs['tieude'],
                'hoten'=>$val->hoten,
                'mangld'=>$val->ma_nld,
                'gioitinh'=>$val->gioitinh,
                'sobhxh'=>$val->sobhxh,
                'bdbhxh'=>$val->bdbhxh,
                'ktbhxh'=>$val->ktbhxh,
                'ngaysinh'=>$val->ngaysinh,
                'chucvu'=>$val->chucvu,
                'vitrivl'=>$val->nghenghiep,
                'mucluong'=>$val->luongbhxh,
                'pcchucvu'=>$val->pcchucvu,
                'pcthamnien'=>$val->pcthamnien,
                'pcthamniennghe'=>$val->pcthamniennghe,
                'pcluong'=>$val->pcluong,
                'pcbosung'=>$val->pcbosung,
                'bddochai'=>$val->bddochai,
                'ktdochai'=>$val->ktdochai,
                'loaihdld'=>$val->loaihdld,
                'bdhdld'=>$val->bdhdld,
                'kthdld'=>$val->kthdld
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
        $model=tinhhinhsudunglaodong::findOrFail($id);
        $model_ct=tinhhinhsudunglaodong_ct::where('matb',$model->matb)->get();
        if(isset($model_ct)){
            foreach($model_ct as $ct){
                $ct->delete();
            }
        }

        $model->delete();
        return redirect('/tinhhinhsudungld/don_vi/danhsach')
                ->with('success','Xóa thành công');
    }

    public function danhsach()
    {
        if (!chkPhanQuyen('tonghopdulieutinhhinhsudunglaodongdonvi', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudunglaodongdonvi');
        }
        $model=tinhhinhsudunglaodong::join('thongbaotinhhinhsudungld','thongbaotinhhinhsudungld.matb','tinhhinhsudunglaodong.matb')
                                        ->select('tinhhinhsudunglaodong.*','thongbaotinhhinhsudungld.tieude','thongbaotinhhinhsudungld.hannop','thongbaotinhhinhsudungld.ngaygui AS ngaynhan')
                                        ->where('madv',session('admin')['madv'])
                                        ->get();
        return view('tinhhinhsudunglaodong.donvi.tonghop')
                    ->with('model',$model);
    }

    public function sendData($id)
    {
        if (!chkPhanQuyen('tonghopdulieutinhhinhsudunglaodongdonvi', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudunglaodongdonvi');
        }
        $model=tinhhinhsudunglaodong::findOrFail($id);
        $time=Carbon::now();
        $model->update(['trangthai'=>'DAGUI','ngaygui'=>$time->toDateString()]);
        return redirect('/tinhhinhsudungld/don_vi/danhsach')
                    ->with('success','Gửi thành công');
    }

    public function lydo($id)
    {
        if (!chkPhanQuyen('tonghopdulieutinhhinhsudunglaodongdonvi', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudunglaodongdonvi');
        }
        $model=tinhhinhsudunglaodong::findOrFail($id);
        return response()->json($model);
    }
}
