<?php

namespace App\Http\Controllers;

use App\Models\dmtrinhdogdpt;
use Illuminate\Http\Request;

class dmtrinhdogdptController extends Controller
{
    public function index()
	{		
        $model = dmtrinhdogdpt::all()->sortBy('stt');	
		$count = Count($model);		
		return view('HeThong.danhmuc.trinhdogdpt',compact('model','count'));
	}


	public function store_update(Request $request)
	{		
		$input = $request->all();

		if ($input['id'] != null) {
			dmtrinhdogdpt::FindOrFail($input['id'])->update($input);
		}
		else{

			$input["madmgdpt"] = date('YmdHis');
			dmtrinhdogdpt::create($input);
		}
		return redirect('/danh_muc/dm_trinh_do_gdpt');
	}


    public function delete($id){	
		$id_delete = dmtrinhdogdpt::findOrFail($id);
        $model = dmtrinhdogdpt::where('stt', '>=', $id_delete->stt)->get();
        if ($model != null) {
            foreach ($model as $item) {
                dmtrinhdogdpt::Find($item->id)->update(['stt' => $item->stt - 1]);
            }
        }
        $id_delete->delete();
		return redirect('/danh_muc/dm_trinh_do_gdpt');
    }


	public function edit($id)
	{		
        $model = dmtrinhdogdpt::Find($id);	
		die($model);
	}
}


