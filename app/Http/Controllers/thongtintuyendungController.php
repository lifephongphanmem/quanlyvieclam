<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\khaibaotuyendung;
use App\Models\thongtintuyendung;
use App\Models\thongtintuyendungct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class thongtintuyendungController extends Controller
{
    public function index()
    {
        $model = thongtintuyendung::all();
        return view('admin.tuyendung.thongtintonghop.index', compact('model'));
    }

    public function store_update(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        if ($input['matttd'] != null) {
            thongtintuyendung::where('matttd',$input['matttd'])->update($input);
        } else {
            $input["matttd"] = date('YmdHis');
            thongtintuyendung::create($input);
        }
        return redirect('/tuyen_dung/thong_tin_tong_hop');
    }


	public function edit($id)
	{		
        $model = thongtintuyendung::Find($id);	
		die($model);
	}

    public function delete($id)
    {
        thongtintuyendung::findOrFail($id)->delete();
        return redirect('/tuyen_dung/thong_tin_tong_hop');
    }

    //chi tiết

    public function detail(Request $request)
    { 
        $model = thongtintuyendungct::where('manhom',$request->manhom)->where('trangthai','ht')->get();    
        $company = Company::all();
        $count = Count($model);
        return view('admin.tuyendung.thongtintonghop.detail', compact('model','company','count'));
    }

    public function tralai(Request $request)
    {     
        $model = thongtintuyendungct::Find($request->id);       
        if ($model == null) {        
            return redirect('/tuyen_dung/thong_tin_tong_hop/chi_tiet?manhom='.$model->manhom)->with('error', 'Thông tin không tồn tại');
        }
        else{
            $model->update(['trangthai' => 'btl','lydo' => $request->lydo]);
            return redirect('/tuyen_dung/thong_tin_tong_hop/chi_tiet?manhom='.$model->manhom)->with('success','Thông tin đã được trả lại');                    
        }
    }

}
