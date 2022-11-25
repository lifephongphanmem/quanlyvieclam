<?php

namespace App\Http\Controllers;

use App\Models\messages;
use App\Models\thongbao_congty;
use App\Models\thongbaocungld;
use App\Models\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Http\Request;

class messageCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model=thongbaocungld::orderBy('nam')->get();
        $model_cty=User::where('phanloaitk',2)->get();
        $nam=date('Y');
        return view('admin.thongbaothuthap.index')
                ->with('model',$model)
                ->with('nam',$nam)
                ->with('model_cty',$model_cty);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.thongbaothuthap.create');
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
        $model=messages::join('threads','threads.id','messages.thread_id')
                        ->select('messages.*','threads.subject')
                        ->where('thread_id',$id)
                            ->get();
        return view('admin.thongbaothuthap.chitiet')
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
        $model=thongbaocungld::findOrFail($id);
        return view('admin.thongbaothuthap.edit')
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
        $inputs=$request->all();
        $tb_ct=thongbao_congty::where('thongbao_id',$id)->get();
        if(count($tb_ct)>0){
            return view('errors.tontai_dulieu')
                    ->with('message', 'Thông báo đã được gửi')
                    ->with('furl','/cungld/thongbao');
        }
        if($inputs['user_id'][0] == 'all'){
            $model=User::where('phanloaitk',2)->get();
            foreach($model as $ct){
                $data=[
                    'thongbao_id'=>$id,
                    'user_id'=>$ct->id
                ];
                thongbao_congty::create($data);
            }
        }else{
            foreach ($inputs['user_id'] as $val){
                    $data=[
                        'thongbao_id'=>$id,
                        'user_id'=>$val
                    ];
                    thongbao_congty::create($data);
               }
        }

        $time=Carbon::now();
        // $thongbao=thongbaocungld::where('id',$id);
        $thongbao=thongbaocungld::findOrFail($id);
        if($thongbao != null){
            $thongbao->update(['ngaygui'=>$time->toDateString()]);
        }
        return redirect('/cungld/thongbao')->with('success','Thành công');

    }
}
