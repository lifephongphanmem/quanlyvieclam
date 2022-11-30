<?php

namespace App\Http\Controllers\Danhmuc;

use App\Models\Danhmuc\dmloailaodong;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dmloailaodongController extends Controller
{
    public function index()
	{		
        $model = dmloailaodong::all()->sortBy('stt');	
		$count = Count($model);			
		return view('danhmuc.loailaodong.loailaodong',compact('model','count'));
	}


	public function store_update(Request $request)
	{		
		$input = $request->all();

		if ($input['id'] != null) {
			dmloailaodong::FindOrFail($input['id'])->update($input);
		}
		else{

			$input["madmlld"] = date('YmdHis');
			dmloailaodong::create($input);
		}
		return redirect('/danh_muc/dm_loai_lao_dong');
	}



    public function delete($id){	
		$id_delete = dmloailaodong::findOrFail($id);
        $model = dmloailaodong::where('stt', '>=', $id_delete->stt)->get();
        if ($model != null) {
            foreach ($model as $item) {
                dmloailaodong::Find($item->id)->update(['stt' => $item->stt - 1]);
            }
        }
        $id_delete->delete();
		return redirect('/danh_muc/dm_loai_lao_dong');
    }



	public function edit($id)
	{		
        $model = dmloailaodong::Find($id);	
		die($model);
	}
}
