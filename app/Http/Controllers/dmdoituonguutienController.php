<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\dmdoituonguutien;
use Illuminate\Http\DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Sort;
use PHPUnit\Framework\Constraint\Count;
use Ramsey\Uuid\Type\Integer;

class dmdoituonguutienController extends Controller
{
    public function index()
	{		

        $model = dmdoituonguutien::all()->sortBy('stt');	
		$count = Count($model);			
		return view('HeThong.danhmuc.doituonguutien',compact('model','count'));
	}


	public function store_update(Request $request)
	{		
		dd($request->all());
		$input = $request->all();
		if ($input['id'] != null) {
			dmdoituonguutien::FindOrFail($input['id'])->update($input);
		}
		else{

			$input["madmdt"] = date('YmdHis');
			dmdoituonguutien::create($input);
		}
		return redirect('/danh_muc/dm_doi_tuong');
	}




    public function delete($id){	
		$id_delete = dmdoituonguutien::findOrFail($id);
        $model = dmdoituonguutien::where('stt', '>=', $id_delete->stt)->get();
        if ($model != null) {
            foreach ($model as $item) {
                dmdoituonguutien::Find($item->id)->update(['stt' => $item->stt - 1]);
            }
        }
        $id_delete->delete();
		return redirect('/danh_muc/dm_doi_tuong');
    }



	public function edit($id)
	{		
        $model = dmdoituonguutien::Find($id);	
		die($model);
	}



}
