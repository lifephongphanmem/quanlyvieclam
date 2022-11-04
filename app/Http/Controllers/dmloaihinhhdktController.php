<?php

namespace App\Http\Controllers;

use App\Models\dmloaihinhhdkt;
use Illuminate\Http\Request;

class dmloaihinhhdktController extends Controller
{
    public function index()
	{		
        $model = dmloaihinhhdkt::all()->sortBy('stt');	
		$count = Count($model);		
		return view('HeThong.danhmuc.loaihinhhdkt',compact('model','count'));
	}


	public function store_update(Request $request)
	{		
		$input = $request->all();

		if ($input['id'] != null) {
			dmloaihinhhdkt::FindOrFail($input['id'])->update($input);
		}
		else{
			$input["madmlhkt"] = date('YmdHis');
			dmloaihinhhdkt::create($input);
		}
		return redirect('/danh_muc/dm_loai_hinh_hdkt');
	}


    public function delete($id){	
		$id_delete = dmloaihinhhdkt::findOrFail($id);
        $model = dmloaihinhhdkt::where('stt', '>=', $id_delete->stt)->get();
        if ($model != null) {
            foreach ($model as $item) {
                dmloaihinhhdkt::Find($item->id)->update(['stt' => $item->stt - 1]);
            }
        }
        $id_delete->delete();
		return redirect('/danh_muc/dm_loai_hinh_hdkt');
    }


	public function edit($id)
	{		
        $model = dmloaihinhhdkt::Find($id);	
		die($model);
	}
}
