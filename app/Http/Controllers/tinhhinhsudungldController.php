<?php

namespace App\Http\Controllers;

use App\Models\nguoilaodong;
use App\Models\thongbaotinhhinhsudungld;
use App\Models\tinhhinhsudunglaodong;
use App\Models\tinhhinhsudunglaodong_ct;
use Illuminate\Http\Request;
use Carbon\Carbon;


class tinhhinhsudungldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $model=tinhhinhsudunglaodong::join('thongbaotinhhinhsudungld','thongbaotinhhinhsudungld.matb','tinhhinhsudunglaodong.matb')
        //                                 ->join('thongbaotinhhinhsudungld_doanhnghiep','thongbaotinhhinhsudungld_doanhnghiep.matb','thongbaotinhhinhsudungld.matb')
        //                                 ->select('thongbaotinhhinhsudungld.*','tinhhinhsudunglaodong.ngaygui AS senddate')
        //                                 ->where('thongbaotinhhinhsudungld_doanhnghiep.masodn',session('admin')['madv'])
        //                                 ->get();
        $model=thongbaotinhhinhsudungld::join('thongbaotinhhinhsudungld_doanhnghiep','thongbaotinhhinhsudungld_doanhnghiep.matb','thongbaotinhhinhsudungld.matb')
                                            ->select('thongbaotinhhinhsudungld.*')
                                            ->where('thongbaotinhhinhsudungld_doanhnghiep.masodn',session('admin')['madv'])
                                            ->get();
        return view('pages.tinhhinhsudunglaodong.donvi.index')
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $model=tinhhinhsudunglaodong::join('thongbaotinhhinhsudungld','thongbaotinhhinhsudungld.matb','tinhhinhsudunglaodong.matb')
                                        ->select('tinhhinhsudunglaodong.*','thongbaotinhhinhsudungld.tieude','thongbaotinhhinhsudungld.hannop','thongbaotinhhinhsudungld.ngaygui AS ngaynhan')
                                        ->where('madv',session('admin')['madv'])
                                        ->get();
        return view('pages.tinhhinhsudunglaodong.donvi.tonghop')
                    ->with('model',$model);
    }

    public function sendData($id)
    {
        $model=tinhhinhsudunglaodong::findOrFail($id);
        $time=Carbon::now();
        $model->update(['trangthai'=>'DAGUI','ngaygui'=>$time->toDateString()]);
        return redirect('/tinhhinhsudungld/don_vi/danhsach')
                    ->with('success','Gửi thành công');
    }

    public function lydo($id)
    {
        $model=tinhhinhsudunglaodong::findOrFail($id);
        return response()->json($model);
    }
}
