<?php

namespace App\Http\Controllers;

use App\Models\dmthoigianthatnghiep;
use Illuminate\Http\Request;

class dmthoigianthatnghiepController extends Controller
{
    public function index()
	{		
        $model = dmthoigianthatnghiep::all()->sortBy('stt');	
		$count = Count($model);		
		return view('HeThong.danhmuc.thoigianthatnghiep',compact('model','count'));
	}


	public function store_update(Request $request)
	{		
		$input = $request->all();

		if ($input['id'] != null) {
			dmthoigianthatnghiep::FindOrFail($input['id'])->update($input);
		}
		else{
			$input["madmtgtn"] = date('YmdHis');
			dmthoigianthatnghiep::create($input);
		}
		return redirect('/danh_muc/dm_thoi_gian_that_nghiep');
	}


    public function delete($id){	
		$id_delete = dmthoigianthatnghiep::findOrFail($id);
        $model = dmthoigianthatnghiep::where('stt', '>=', $id_delete->stt)->get();
        if ($model != null) {
            foreach ($model as $item) {
                dmthoigianthatnghiep::Find($item->id)->update(['stt' => $item->stt - 1]);
            }
        }
        $id_delete->delete();
		return redirect('/danh_muc/dm_thoi_gian_that_nghiep');
    }


	public function edit($id)
	{		
        $model = dmthoigianthatnghiep::Find($id);	
		die($model);
	}
}
