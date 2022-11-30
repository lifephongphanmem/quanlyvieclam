<?php

namespace App\Http\Controllers\Danhmuc;

use App\Models\Danhmuc\dmchuyenmondaotao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dmchuyenmondaotaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model=dmchuyenmondaotao::all();
        return view('danhmuc.dmchuyenmondaotao.index')
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
        dmchuyenmondaotao::create($inputs);
        return redirect('/dm_chuyen_mon_dao_tao')
                ->with('success','Thêm mới thành công');
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
        $inputs=$request->all();
        $model=dmchuyenmondaotao::findOrFail($id);
        $model->update($inputs);
        return redirect('/dm_chuyen_mon_dao_tao')
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
        $model=dmchuyenmondaotao::findOrFail($id);
        $model->delete();
        return redirect('/dm_chuyen_mon_dao_tao')
                ->with('success','Xóa thành công');
    }
}
