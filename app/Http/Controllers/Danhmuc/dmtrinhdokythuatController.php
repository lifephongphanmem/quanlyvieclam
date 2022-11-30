<?php

namespace App\Http\Controllers\Danhmuc;

use App\Models\Danhmuc\dmtrinhdokythuat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dmtrinhdokythuatController extends Controller
{
    public function index()
	{		
        $model = dmtrinhdokythuat::all()->sortBy('stt');	
		$count = Count($model);		
		return view('danhmuc.trinhdochuyenmonkythuat.trinhdokythuat',compact('model','count'));
	}


	public function store_update(Request $request)
	{		
		$input = $request->all();

		if ($input['id'] != null) {
			dmtrinhdokythuat::FindOrFail($input['id'])->update($input);
		}
		else{
			$input["madmtdkt"] = date('YmdHis');
			dmtrinhdokythuat::create($input);
		}
		return redirect('/danh_muc/dm_trinh_do_ky_thuat');
	}


    public function delete($id){	
		$id_delete = dmtrinhdokythuat::findOrFail($id);
        $model = dmtrinhdokythuat::where('stt', '>=', $id_delete->stt)->get();
        if ($model != null) {
            foreach ($model as $item) {
                dmtrinhdokythuat::Find($item->id)->update(['stt' => $item->stt - 1]);
            }
        }
        $id_delete->delete();
		return redirect('/danh_muc/dm_trinh_do_ky_thuat');
    }


	public function edit($id)
	{		
        $model = dmtrinhdokythuat::Find($id);	
		die($model);
	}
}
