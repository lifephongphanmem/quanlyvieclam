<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chucnang;
use Illuminate\Http\Request;

class ChucnangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model=Chucnang::all();
        // foreach($model as $value){
        //     $m_cn=$model->where('parent',1);
        //     dd($m_cn);
        // }
        return view('HeThong.manage.chucnang.index')
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
        $inputs['parent'] = isset($inputs['parent'])?$inputs['parent']:0;
        if($inputs['edit'] == null){
            Chucnang::create($inputs);
        }else{
            $id=$inputs['edit'];
            $model=Chucnang::findOrFail($id);
                $model_cd2=Chucnang::where('parent',$model->id)->get();
                if(isset($model_cd2)){
                    foreach($model_cd2 as $value){
                        $value->update(['trangthai'=>$inputs['trangthai']]);
                    }
                }
                $a_id_cd2=array_column($model_cd2->toarray(),'id');
                $model_cd3=Chucnang::wherein('parent',$a_id_cd2)->get();
                if(isset($model_cd3)){
                    foreach($model_cd3 as $value){   
                        $value->update(['trangthai'=>$inputs['trangthai']]);
                    }
                }

            $model->update($inputs);
        }

        return redirect('/Chuc_nang/Thong_tin');
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
        $model=Chucnang::findOrFail($id);
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
        $model=Chucnang::findOrFail($id);
        $m_model=Chucnang::where('parent',$model->id)->get();
        if(isset($m_model)){
            foreach ($m_model as $value){
                $value->delete();
            }
        }
        $model->delete();
        return redirect('/Chuc_nang/Thong_tin');
    }
}
