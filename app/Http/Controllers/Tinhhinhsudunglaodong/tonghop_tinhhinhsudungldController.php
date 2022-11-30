<?php

namespace App\Http\Controllers\Tinhhinhsudunglaodong;

use App\Models\Tinhhinhsudunglaodong\tinhhinhsudunglaodong;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class tonghop_tinhhinhsudungldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inputs=$request->all();
        // $tieude=[
        //     '0'=>'Báo cáo tình hình sử dụng lao động định kỳ 6 tháng',
        //     '1'=>'Báo cáo tình hình sử dụng lao động hằng năm'
        // ];
        $a_data=array(
            array('tieude'=>'0','sodv'=>null),
            array('tieude'=>'1','sodv'=>null)
        );
        $model=tinhhinhsudunglaodong::where('nam',$inputs['nam'])
                                        ->get();
        $doanhnghiep=User::where('phanloaitk',2)->get();
        for($i=0;$i< count($a_data);$i++)
        {
            $m=$model->where('tieude', $a_data[$i]['tieude'])->where('trangthai','DAGUI');
            $a_data[$i]['sodv']=count($m)>0?count($m):0;
        }
        // dd($a_data);
        return view('tinhhinhsudunglaodong.tinh.index')
                    ->with('model',$a_data)
                    ->with('sldv',count($doanhnghiep))
                    ->with('nam',$inputs['nam']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $inputs=$request->all();
        $tieude=array(
            '0'=>'Báo cáo tình hình sử dụng lao động định kỳ 6 tháng',
            '1'=>'Báo cáo tình hình sử dụng lao động hằng năm'
        );
        $tonghop=tinhhinhsudunglaodong::where('nam',$inputs['nam'])->where('tieude',$inputs['tieude'])->get();
        $doanhnghiep=User::join('company','company.user','users.id')
                            ->select('users.*','company.masodn','company.name')
                            ->where('phanloaitk',2)->get();
        foreach($doanhnghiep as $dn)
        {
            $_tonghop=$tonghop->where('madv',$dn->masodn)->first();
            if(isset($_tonghop)){
                $dn->trangthai=$_tonghop->trangthai=='TRALAI'?'CHUAGUI':$_tonghop->trangthai;
                $dn->tieude=$_tonghop->tieude;
                $dn->nam=$_tonghop->nam;
            }else{
                $dn->trangthai='CHUAGUI';
                $dn->tieude='';
                $dn->nam='';
            }
        }
        return view('tinhhinhsudunglaodong.tinh.chitiet')
                    ->with('model',$doanhnghiep)
                    ->with('_tieude',$inputs['tieude'])
                    ->with('tieude',$tieude)
                    ->with('nam',$inputs['nam']);
    }



    public function tralai(Request $request)
    {
        $inputs=$request->all();
        $model=tinhhinhsudunglaodong::where('nam',$inputs['nam'])
                                        ->where('tieude',$inputs['tieude'])
                                        ->where('madv',$inputs['madv'])
                                        ->first();
        if(isset($model)){
            $model->update(['trangthai'=>'TRALAI','ngaygui'=>'','lydo'=>$inputs['lydo']]);
            return redirect('/tinhhinhsudungld/tinh/xem_du_lieu?nam='.$inputs['nam'].'&tieude='.$inputs['tieude'])
                            ->with('success','Trả lại thành công');
        }
    }
}
