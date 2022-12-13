<?php

namespace App\Http\Controllers\Cunglaodong;

use App\Models\messages;
use App\Models\thongbao_congty;
use App\Models\Cunglaodong\thongbaocungld;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Jobs\SendMail;
use App\Models\Danhmuc\dmdonvi;
use App\Models\Thongbao\Thongbao_donvi;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class messageCotroller extends Controller
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

        if (!chkPhanQuyen('thongbaocunglaodong', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'thongbaocunglaodong');
        }
        $model=thongbaocungld::orderBy('nam')->get();
        // $model_cty=User::where('phanloaitk',2)->get();
        $nam=date('Y');
        $modeldv=dmdonvi::all();
        $a_dv=array_column($modeldv->toarray(),'tendv','madv');
        return view('cunglaodong.thongbaothuthap.index')
                ->with('model',$model)
                ->with('a_dv',$a_dv)
                ->with('nam',$nam);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!chkPhanQuyen('thongbaocunglaodong', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'thongbaocunglaodong');
        }
        return view('cunglaodong.thongbaothuthap.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('thongbaocunglaodong', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'thongbaocunglaodong');
        }
        $inputs=$request->all();
        $inputs['matb']=getdate()[0];
        thongbaocungld::create($inputs);
        return redirect('/cungld/thongbao')
                    ->with('success','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!chkPhanQuyen('thongbaocunglaodong', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'thongbaocunglaodong');
        }
        $model=messages::join('threads','threads.id','messages.thread_id')
                        ->select('messages.*','threads.subject')
                        ->where('thread_id',$id)
                            ->get();
        return view('cunglaodong.thongbaothuthap.chitiet')
                ->with('model',$model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!chkPhanQuyen('thongbaocunglaodong', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'thongbaocunglaodong');
        }
        $model=thongbaocungld::findOrFail($id);
        return view('cunglaodong.thongbaothuthap.edit')
                ->with('model',$model);
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
        if (!chkPhanQuyen('thongbaocunglaodong', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'thongbaocunglaodong');
        }
        $inputs=$request->all();
        $model=thongbaocungld::findOrFail($id);
        $model->update($inputs);
        return redirect('/cungld/thongbao')
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
        if (!chkPhanQuyen('thongbaocunglaodong', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'thongbaocunglaodong');
        }
        $model=thongbaocungld::findOrFail($id);
        $model_ct=thongbao_congty::where('thongbao_id',$id)->get();
        foreach($model_ct as $ct){
            $ct->delete();
        }
        $model->delete();
        return redirect('/cungld/thongbao')
                ->with('success','Xóa thành công');
        
    }

    public function guithongbao(Request $request, $id)
    {
        if (!chkPhanQuyen('thongbaocunglaodong', 'hoanthanh')) {
            return view('errors.noperm')->with('machucnang', 'thongbaocunglaodong');
        }
        $inputs=$request->all();
        // dd($inputs);
        $m_thongbao=thongbaocungld::findOrFail($id);
        //gửi kèm file
        if(isset($inputs['filequyetdinh']))
        {
            $file=$inputs['filequyetdinh'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/cunglaodong/', $name);
            $inputs['filequyetdinh']='uploads/cunglaodong/'.$name;
        }

        if(isset($inputs['filekhac']))
        {
            $file=$inputs['filekhac'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/cunglaodong/', $name);
            $inputs['filekhac']='uploads/cunglaodong/'.$name;
        }

        $tb_ct=Thongbao_donvi::where('matb',$m_thongbao->matb)->get();
        if(count($tb_ct)>0){
            return view('errors.tontai_dulieu')
                    ->with('message', 'Thông báo đã được gửi')
                    ->with('furl','/cungld/thongbao');
        }
        if($inputs['madv'][0] == 'ALL'){
            $model=User::join('dmdonvi','dmdonvi.madv','users.madv')
            ->join('danhmuchanhchinh','danhmuchanhchinh.id','dmdonvi.madiaban')
            ->where('danhmuchanhchinh.level','<>','Tỉnh')->where('users.phanloaitk',1)->get();
            $modeldvs=dmdonvi::all();
            foreach($model as $ct){
                $data=[
                    'matb'=>$m_thongbao->matb,
                    'user_id'=>$ct->madv
                ];
                Thongbao_donvi::create($data);
            }
        }else{
            $modeldvs=dmdonvi::wherein('madv',$inputs['madv'])->get();
            foreach ($inputs['madv'] as $val){
                    $data=[
                        'matb'=>$m_thongbao->matb,
                        'madv'=>$val
                    ];
                    Thongbao_donvi::create($data);
               }
        }

        $time=Carbon::now();
        // $thongbao=thongbaocungld::where('id',$id);
        $thongbao=thongbaocungld::findOrFail($id);
        if($thongbao != null){
            $thongbao->update(['ngaygui'=>$time->toDateString(),'filequyetdinh'=>$inputs['filequyetdinh']??'','filekhac'=>$inputs['filekhac']??'']);
        }

        //Gửi email
        $m_thongbao=thongbaocungld::findOrFail($id);
        $contenthc='Thông báo thu thập thông tin cung lao động';
        $filehc=[$m_thongbao->filequyetdinh,$m_thongbao->filekhac];
        if(isset($inputs['guiemail'])){
            foreach($modeldvs as $modeldv){
                $run=new SendMail($modeldv,$contenthc,$filehc);
                $run->handle();
            }
        }

 

        return redirect('/cungld/thongbao')->with('success','Thành công');

    }
}
