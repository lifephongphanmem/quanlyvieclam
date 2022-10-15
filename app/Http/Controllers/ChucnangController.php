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
        Chucnang::create($inputs);
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
        $model=Chucnang::findOrFail($id);
        $model->delete();
        return redirect('/Chuc_nang/Thong_tin');
    }
}
