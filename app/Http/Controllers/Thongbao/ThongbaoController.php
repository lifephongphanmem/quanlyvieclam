<?php

namespace App\Http\Controllers\Thongbao;

use App\Http\Controllers\Controller;
use App\Models\Thongbao\Thongbao;
use Illuminate\Http\Request;

class ThongbaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model=Thongbao::all();

        return view('thongbao.index')
                ->with('model',$model)
                ->with('nam',date('Y'));
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
        $inputs['matb']=getdate()[0];
        $inputs['trangthai']='CHUAGUI';
        Thongbao::create($inputs);

        return redirect('/thongbao_khac/danhsach')
                ->with('success','Thêm thành công');
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
        $model=Thongbao::findOrFail($id);
        $model->update($inputs);

        return redirect('/thongbao_khac/danhsach')
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
        $model=Thongbao::findOrFail($id);
        $model->delete();

        return redirect('/thongbao_khac/danhsach')
                        ->with('success','Xóa thành công');
    }
}
