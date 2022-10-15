<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\dmdoituonguutien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class dmdoituonguutienController extends Controller
{
    public function index()
	{
        $doituong = dmdoituonguutien::all();
		$count = Count($doituong);
		return view('HeThong.danhmuc.doituonguutien.index',compact('doituong','count'));
	}

	public function store(Request $request)
	{
		$input = $request->all();
        dmdoituonguutien::create($input);
		
		return redirect('/danh_muc/dm_doi_tuong');
	}
    public function delete(id $id){
		// dd($id);
		dmdoituonguutien::Find($id)->delete();
		return redirect('/danh_muc/dm_doi_tuong');
    }




}
