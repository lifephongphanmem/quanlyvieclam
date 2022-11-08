<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\thongtintuyendung;
use App\Models\thongtintuyendungct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use LDAP\Result;

class khaibaotuyendungController extends Controller
{

    public function index(){
        $model = thongtintuyendung::where('trangthai','mo')->get();
        return view('admin.tuyendung.khaibaotonghop.index', compact('model'));
    }


    // chi tiết
    public function detail(Request $request)
    {
        $manhom = $request->manhom;
        $id_user = Auth::user()->id;
        $doanhnghiep = Company::select('masodn')->Where('user', $id_user)->first();
        $company = Company::all();
        $model = thongtintuyendungct::Where('madn', $doanhnghiep->masodn)->where('manhom',$manhom)->get();
        $count = Count($model);  
        return view('admin.tuyendung.khaibaotonghop.detail', compact('model', 'count', 'doanhnghiep', 'company','manhom'));
    }


    public function create(Request $request)
    {
        $manhom = $request->manhom;
        $company = Company::all();
        $madn = $request->madn;
        $model = null;
        return view('admin.tuyendung.khaibaotonghop.edit', compact('madn', 'company', 'model','manhom'));
    }

    public function edit(Request $request)
    {
        $company = Company::all();
        $model = thongtintuyendungct::findOrFail($request->id);
        return view('admin.tuyendung.khaibaotonghop.edit', compact('model', 'company'));
    }

    public function show(Request $request)
    {
        $company = Company::all();
        $model = thongtintuyendungct::findOrFail($request->id);
        return view('admin.tuyendung.khaibaotonghop.show', compact('model', 'company'));
    }

    public function store_update(Request $request)
    {    
        $input = $request->all();
  
        if ($input['id'] == null) {
            $input['trangthai'] = 'cht';
            $input['mahs'] = date('YmdHis');

            thongtintuyendungct::create($input);
            $messeager = 'Đã thêm mới thông tin';
        } else {
            thongtintuyendungct::findOrFail($request->id)->update($input);
            $messeager = 'Thông tin đã được thay thế';
        }
        return redirect('/tuyen_dung/khai_bao_tong_hop/chi_tiet?manhom='.$input['manhom'])->with('success',$messeager);
    }

    public function delete($id)
    {
       $model = thongtintuyendungct::findOrFail($id);
       $model->delete();
       return redirect('/tuyen_dung/khai_bao_tong_hop/chi_tiet?manhom='.$model->manhom)->with('success','Thông tin đã được xóa');   ;
    }

    public function chuyen($id)
    {
       $model = thongtintuyendungct::findOrFail($id);
       $model->update(['trangthai' => 'ht','lydo' => null]);

        return redirect('/tuyen_dung/khai_bao_tong_hop/chi_tiet?manhom='.$model->manhom)->with('success','Thông tin đã được chuyển');   ;
    }

}


