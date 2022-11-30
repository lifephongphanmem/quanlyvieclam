<?php

namespace App\Http\Controllers\Danhmuc;

use App\Models\Danhmuc\dmloaihieuluchdld;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dmloaihieuluchdldController extends Controller
{
    public function index()
	{		
        $model = dmloaihieuluchdld::all()->sortBy('stt');	
		$count = Count($model);		
		return view('danhmuc.loaihieuluc_hdld.loaihieuluchdld',compact('model','count'));
	}


	public function store_update(Request $request)
	{		
		$input = $request->all();
		if ($input['id'] != null) {
			dmloaihieuluchdld::FindOrFail($input['id'])->update($input);
		}
		else{
			$input["madmlhl"] = date('YmdHis');
			dmloaihieuluchdld::create($input);
		}
		return redirect('/danh_muc/dm_loai_hieu_luc_hdld');
	}


    public function delete($id){	
		$id_delete = dmloaihieuluchdld::findOrFail($id);
        $model = dmloaihieuluchdld::where('stt', '>=', $id_delete->stt)->get();
        if ($model != null) {
            foreach ($model as $item) {
                dmloaihieuluchdld::Find($item->id)->update(['stt' => $item->stt - 1]);
            }
        }
        $id_delete->delete();
		return redirect('/danh_muc/dm_loai_hieu_luc_hdld');
    }


	public function edit($id)
	{		
        $model = dmloaihieuluchdld::Find($id);	
		die($model);
	}
}
