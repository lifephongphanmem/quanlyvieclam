<?php

namespace App\Http\Controllers\Danhmuc;

use App\Http\Controllers\Controller;
use App\Models\Danhmuc\danhmuchanhchinh;
use App\Models\Danhmuc\dmdonvi;
use DB;
use Illuminate\Http\Request;

class DmdonviController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model_diaban=danhmuchanhchinh::all();
        return view('HeThong.manage.dmdonvi.index')
                ->with('model_diaban',$model_diaban);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $inputs['madonvi']= $request->madonvi;
        $inputs['maquocgia']=$request->maquocgia;
        $inputs['parent']=$request->parent;
        // dd($inputs);
        $model_diaban=danhmuchanhchinh::where('maquocgia',$inputs['parent'])->first();
        $model_donvi= dmdonvi::where('madiaban',$model_diaban->id)->get();
        return view('HeThong.manage.dmdonvi.create')
                    ->with('model_diaban',$model_diaban)
                    ->with('furl','/dmdonvi/')
                    ->with('inputs',$inputs['madonvi'])
                    ->with('model_donvi',$model_donvi);
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
        $inputs['madv']=getdate()[0];
        // dd($inputs);
        dmdonvi::create($inputs);
        return redirect('/dmdonvi/danh_sach_don_vi/'.$inputs['madonvi']);
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
        $model=dmdonvi::findOrFail($id);
        $model_donvi= dmdonvi::where('madiaban',$model->madiaban)->get();
        return view('HeThong.manage.dmdonvi.edit')
        ->with('model',$model)
        ->with('furl','/dmdonvi/')
        // ->with('inputs',$inputs['madonvi'])
        ->with('model_donvi',$model_donvi);
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
        $model=dmdonvi::findOrFail($id);
        $model->update($inputs);
        return redirect('/dmdonvi/danh_sach_don_vi/'.$inputs['madiaban']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model=dmdonvi::findOrFail($id);
        $model->delete();
        return redirect('/dmdonvi/danh_sach_don_vi/'.$model->madiaban);
    }

    public function detail(Request $request){
        $inputs=$request->all();
        $id=$request->id;
        $donvi=danhmuchanhchinh::findOrFail($id);
        $model=dmdonvi::where('madiaban',$id)->get();
        return view('HeThong.manage.dmdonvi.chitietdonvi')
                ->with('model',$model)
                ->with('donvi',$donvi);
    }

    public function dvql($id)
    {
        $model_donvi=dmdonvi::where('madiaban',$id)->get();
        $model_hc=danhmuchanhchinh::findOrFail($id);
        return view('HeThong.manage.dmdonvi.dvql')
                ->with('model_donvi',$model_donvi)
                ->with('model_hc',$model_hc);
    }

    public function update_dvql(Request $request,$id)
    {

        $model=danhmuchanhchinh::findOrFail($id);
        $inputs=$model->toarray();
        $inputs['madvql']=$request->madvql;
        $model->update($inputs);
        return redirect('/dmdonvi/danh_sach');
    }
}
