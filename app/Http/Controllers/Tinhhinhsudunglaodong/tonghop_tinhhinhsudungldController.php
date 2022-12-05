<?php

namespace App\Http\Controllers\Tinhhinhsudunglaodong;

use App\Models\Tinhhinhsudunglaodong\tinhhinhsudunglaodong;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Danhmuc\dmchucvu;
use App\Models\Danhmuc\dmloaihieuluchdld;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class tonghop_tinhhinhsudungldController extends Controller
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
    public function index(Request $request)
    {
        if (!chkPhanQuyen('tonghopdulieutinhhinhsudungld', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudungld');
        }
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
            if(count($m)>0){
                foreach($m as $ct){
                    $a_data[$i]['matb']=$ct->matb;
                    $a_data[$i]['nam']=$ct->nam;
                }
            }else{
                $a_data[$i]['matb']='';
                $a_data[$i]['nam']='';
            }


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
        if (!chkPhanQuyen('tonghopdulieutinhhinhsudungld', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudungld');
        }
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
                $dn->matb=$_tonghop->matb;
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
        if (!chkPhanQuyen('tonghopdulieutinhhinhsudungld', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudungld');
        }
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

    public function tonghop(Request $request)
    {
        if (!chkPhanQuyen('tonghopdulieutinhhinhsudungld', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tonghopdulieutinhhinhsudungld');
        }
        $inputs=$request->all();
        $model=tinhhinhsudunglaodong::join('tinhhinhsudunglaodong_ct','tinhhinhsudunglaodong_ct.matb','tinhhinhsudunglaodong.matb')
                                        ->select('tinhhinhsudunglaodong_ct.*','tinhhinhsudunglaodong.madv')
                                        ->where('tinhhinhsudunglaodong.matb',$inputs['matb'])
                                        // ->where('tinhhinhsudunglaodong.madv',$inputs['madv'])
                                        ->where('tinhhinhsudunglaodong.nam',$inputs['nam'])
                                        ->get();
// dd($model);
        $m_dv=User::where('madv',session('admin')->madv)->first();
        $list_nghe = getParamsByNametype('Nghề nghiệp người lao động');
        $a_vitri=array();
        $a_vitrikhac=array();
        foreach($list_nghe as $key=>$ct){
            if(in_array($ct->id,[37,38,39])){
                $a_vitri[$ct->id]=$ct->name;
            }else{
                $a_vitrikhac[$key]=$ct->id;
            }
                
        }

        $company=Company::all();
        foreach($model as $ct){
            $doanhnghiep=$company->where('madv',$ct->madv)->first();
            $ct->loaihinhdoanhnghiep=$doanhnghiep->loaihinh;
            $birt=Carbon::parse($ct->ngaysinh)->format('Y-m-d');
            $ct->tuoi=getAge($birt);
        }
        $a_loaihdld=array_column(dmloaihieuluchdld::all()->toarray(),'madmlhl','tenlhl');
        // dd($a_loaihdld);
        $loaihinhdoanhnghiep=getParamsByNametype("Loại hình doanh nghiệp");
        // dd($loaihinhdoanhnghiep);
        $a_doanhnghiep=array_column($loaihinhdoanhnghiep->wherenotin('id',[81,83])->toarray(),'id');
// dd($a_doanhnghiep);
        $data = array();
        $data[]=array('tt'=>'1','noidung'=>'Doanh nghiệp','loaihinh'=>$a_doanhnghiep);
        $data[]=array('tt'=>'2','noidung'=>'Hợp tác xã','loaihinh'=>[81]);
        $data[]=array('tt'=>'3','noidung'=>'Cơ quan, tổ chức','loaihinh'=>[83]);

        for($i=0;$i<3;$i++){
                $m=$model->wherein('loaihinhdoanhnghiep',$data[$i]['loaihinh']);
                $data[$i]['tong']=count($m)>0 ?count($m):0;
                $data[$i]['tongnu']=count($m)>0?count($m->where('gioitinh','Nữ')):0;
                $data[$i]['tren35tuoi']=count($m)>0?count($m->where('tuoi','>',35)):0;
                $data[$i]['BHXH']=count($m)>0?count($m->where('sobhxh','<>','')):0;

                $data[$i]['nhaquanly']=count($m)>0?count($m->where('vitrivl',$a_vitri['37'])):0;
                $data[$i]['cmktbaccao']=count($m)>0?count($m->where('vitrivl',$a_vitri['38'])):0;
                $data[$i]['cmktbactrung']=count($m)>0?count($m->where('vitrivl',$a_vitri['39'])):0;
                $data[$i]['cmktkhac']=count($m)>0?count($m->wherein('vitrivl',$a_vitrikhac)):0;


                $data[$i]['bhxhkhongxacdinh']=count($m)>0?count($m->where('loaihdld',$a_loaihdld['Không xác định thời hạn'])):0;
                $data[$i]['bhxhxacdinh']=count($m)>0?count($m->where('loaihdld',$a_loaihdld['Xác định thời hạn'])):0;
                $data[$i]['bhxhkhac']=count($m)>0?count($m->wherenotin('loaihdld',[$a_loaihdld['Xác định thời hạn'],$a_loaihdld['Không xác định thời hạn']])):0;
        }

        // dd($a_vitrikhac);
        // $a_vitri=array_column($list_nghe->toarray(),'name','id');
        $a_chucvu=array_column(dmchucvu::all()->toarray(),'tencv','id');

// dd($data);
        return view('tinhhinhsudunglaodong.export.tinh.tonghop')
                    ->with('model',$data)
                    ->with('m_dv',$m_dv)
                    ->with('a_vitri',$a_vitri)
                    ->with('a_vitrikhac',$a_vitrikhac)
                    ->with('a_chucvu',$a_chucvu)
                    ->with('a_loaihdld',$a_loaihdld)
                    ->with('pageTitle','Tổng hợp dữ liệu');
    }
}
