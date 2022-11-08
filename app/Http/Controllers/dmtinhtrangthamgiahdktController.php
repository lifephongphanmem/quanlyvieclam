<?php

namespace App\Http\Controllers;

use App\Models\dmtinhtrangthamgiahdkt;
use App\Models\dmtinhtrangthamgiahdktct;
use App\Models\dmtinhtrangthamgiahdktct2;
use Illuminate\Http\Request;

class dmtinhtrangthamgiahdktController extends Controller
{
	public function index()
	{
		$model = dmtinhtrangthamgiahdkt::all()->sortBy('stt');
		$count = Count($model);
		return view('HeThong.danhmuc.tinhtrangthamgiahdkt', compact('model', 'count'));
	}

	public function store_update(Request $request)
	{
		$input = $request->all();

		if ($input['id'] != null) {
			dmtinhtrangthamgiahdkt::FindOrFail($input['id'])->update($input);
		} else {
			$input["madmtgkt"] = date('YmdHis');
			dmtinhtrangthamgiahdkt::create($input);
		}
		return redirect('/danh_muc/dm_tinh_trang_tham_gia_hdkt');
	}

	public function delete($id)
	{
		$id_delete = dmtinhtrangthamgiahdkt::findOrFail($id);
		$id_delete1 = dmtinhtrangthamgiahdkt::Where('manhom', $id_delete->madmtgkt);
		$id_delete2 = dmtinhtrangthamgiahdktct::Where('manhom', $id_delete1->madmtgktct);
		$model = dmtinhtrangthamgiahdkt::where('stt', '>=', $id_delete->stt)->get();
		if ($model != null) {
			foreach ($model as $item) {
				dmtinhtrangthamgiahdkt::Find($item->id)->update(['stt' => $item->stt - 1]);
			}
		}
		$id_delete->delete();
		$id_delete1->delete();
		$id_delete2->delete();
		return redirect('/danh_muc/dm_tinh_trang_tham_gia_hdkt');
	}

	public function edit($id)
	{
		$model = dmtinhtrangthamgiahdkt::Find($id);
		die($model);
	}



	// chi tiết

	public function index_ct(Request $request)
	{
		$model = dmtinhtrangthamgiahdktct::Where('manhom', $request->manhom)->get();
		$tennhom = dmtinhtrangthamgiahdkt::select('tentgkt','madmtgkt')->Where('madmtgkt', $request->manhom)->first();
		$count = Count($model);
		
		return view('HeThong.danhmuc.tinhtrangthamgiahdktct', compact('model', 'count', 'tennhom'));
	}

	public function store_update_ct(Request $request)
	{
		$input = $request->all();

		if ($input['id'] != null) {
			dmtinhtrangthamgiahdktct::FindOrFail($input['id'])->update($input);
		} else {
			dmtinhtrangthamgiahdktct::create([
				'manhom' => $request->manhom,
				'madmtgktct' => date('YmdHis'),
				'tentgktct' => $request->tentgktct,
				'mota' => $request->mota,
				'trangthai' => $request->trangthai,
				'stt' => $request->stt,
			]);
		}
		return redirect('/danh_muc/dm_tinh_trang_tham_gia_hdkt/chi_tiet?manhom=' .$request->manhom);
	}

	public function delete_ct($id)
	{	
		$manhom = dmtinhtrangthamgiahdktct::select('manhom')->Find($id)->first();
		$id_delete1 = dmtinhtrangthamgiahdktct::findOrFail($id);
		$id_delete2 = dmtinhtrangthamgiahdktct2::Where('manhom', $id_delete1->madmtgktct);
		$model = dmtinhtrangthamgiahdktct::where('stt', '>=', $id_delete1->stt)->get();
		if ($model != null) {
			foreach ($model as $item) {
				dmtinhtrangthamgiahdktct::Find($item->id)->update(['stt' => $item->stt - 1]);
			}
		}
		$id_delete1->delete();
		$id_delete2->delete();
		return redirect('/danh_muc/dm_tinh_trang_tham_gia_hdkt/chi_tiet?manhom=' .$manhom->manhom);
	}

	public function edit_ct($id)
	{
		$model = dmtinhtrangthamgiahdktct::Find($id);
		die($model);
	}
	

		// chi tiết 2

		public function index_ct2(Request $request)
		{		
		
			$model = dmtinhtrangthamgiahdktct2::Where('manhom2', $request->manhom)->get();
			$tennhom = dmtinhtrangthamgiahdktct::select('tentgktct','madmtgktct','manhom')->Where('madmtgktct', $request->manhom)->first();
			$nhom = $tennhom->manhom;
		
			$count = Count($model);
			return view('HeThong.danhmuc.tinhtrangthamgiahdktct2', compact('model', 'count', 'tennhom','nhom'));
		}
	
		public function store_update_ct2(Request $request)
		{
			$input = $request->all();

			if ($input['id'] != null) {
				dmtinhtrangthamgiahdktct2::FindOrFail($input['id'])->update($input);
			} else {
				dmtinhtrangthamgiahdktct2::create([
					'manhom2' => $request->manhom2,
					'madmtgktct2' => date('YmdHis'),
					'tentgktct2' => $request->tentgktct2,
					'mota' => $request->mota,
					'trangthai' => $request->trangthai,
					'stt' => $request->stt,
				]);
			}
			return redirect('/danh_muc/dm_tinh_trang_tham_gia_hdkt/chi_tiet_2?manhom=' .$request->manhom2);
		}
	
		public function delete_ct2($id)
		{	
			$manhom = dmtinhtrangthamgiahdktct2::select('manhom2')->Find($id)->first();
			$id_delete = dmtinhtrangthamgiahdktct2::findOrFail($id);
			$model = dmtinhtrangthamgiahdktct2::where('stt', '>=', $id_delete->stt)->get();
			if ($model != null) {
				foreach ($model as $item) {
					dmtinhtrangthamgiahdktct2::Find($item->id)->update(['stt' => $item->stt - 1]);
				}
			}
			$id_delete->delete();
			return redirect('/danh_muc/dm_tinh_trang_tham_gia_hdkt/chi_tiet_2?manhom=' .$manhom->manhom2);
		}
	
		public function edit_ct2($id)
		{
			$model = dmtinhtrangthamgiahdktct2::Find($id);
			die($model);
		}
}
