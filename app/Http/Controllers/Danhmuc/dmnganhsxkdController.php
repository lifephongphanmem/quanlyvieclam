<?php

namespace App\Http\Controllers\Danhmuc;

use App\Models\Danhmuc\dmnganhsxkd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dmnganhsxkdController extends Controller
{
    public function index()
	{		
        $model = dmnganhsxkd::all()->sortBy('stt');	
		$count = Count($model);		
		return view('danhmuc.nganhsanxuatkinhdoanh.nganhsxkd',compact('model','count'));
	}


	public function store_update(Request $request)
	{		
		$input = $request->all();

		if ($input['id'] != null) {
			dmnganhsxkd::FindOrFail($input['id'])->update($input);
		}
		else{
			$input["madmsxkd"] = date('YmdHis');
			dmnganhsxkd::create($input);
		}
		return redirect('/danh_muc/dm_nganh_san_xuat_kinh_doanh');
	}


    public function delete($id){	
		$id_delete = dmnganhsxkd::findOrFail($id);
        $model = dmnganhsxkd::where('stt', '>=', $id_delete->stt)->get();
        if ($model != null) {
            foreach ($model as $item) {
                dmnganhsxkd::Find($item->id)->update(['stt' => $item->stt - 1]);
            }
        }
        $id_delete->delete();
		return redirect('/danh_muc/dm_nganh_san_xuat_kinh_doanh');
    }


	public function edit($id)
	{		
        $model = dmnganhsxkd::Find($id);	
		die($model);
	}
}
