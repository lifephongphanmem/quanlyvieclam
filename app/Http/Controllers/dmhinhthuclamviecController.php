<?php

namespace App\Http\Controllers;

use App\Models\dmhinhthuclamviec;
use Illuminate\Http\Request;

class dmhinhthuclamviecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model=dmhinhthuclamviec::all();
        return view('HeThong.danhmuc.hinhthuclamviec.index')
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
        dmhinhthuclamviec::create($inputs);
        return redirect('/dm_hinh_thuc_cong_viec')
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
        $model=dmhinhthuclamviec::findOrFail($id);
        $model->update($inputs);
        return redirect('/dm_hinh_thuc_cong_viec')
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
        $model=dmhinhthuclamviec::findOrFail($id);
        $model->delete();
        return redirect('/dm_hinh_thuc_cong_viec')
                ->with('success','Xóa thành công');
    }
}
