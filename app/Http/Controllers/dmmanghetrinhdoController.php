<?php

namespace App\Http\Controllers;

use App\Models\dmmanghetrinhdo;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class dmmanghetrinhdoController extends Controller
{
    public function index()
    {
        $model = dmmanghetrinhdo::all()->sortBy('stt');
        $count = Count($model);
        return view('HeThong.danhmuc.manghetrinhdo', compact('model', 'count'));
    }


    public function store_update(Request $request)
    {
        $input = $request->all();

        if ($input['id'] != null) {
            dmmanghetrinhdo::FindOrFail($input['id'])->update($input);
        } else {
            $input["madmmntd"] = date('YmdHis');
            dmmanghetrinhdo::create($input);
        }
        return redirect('/danh_muc/dm_ma_nghe_trinh_do');
    }


    public function delete($id)
    {
        $id_delete = dmmanghetrinhdo::findOrFail($id);
        $model = dmmanghetrinhdo::where('stt', '>=', $id_delete->stt)->get();
        if ($model != null) {
            foreach ($model as $item) {
                dmmanghetrinhdo::Find($item->id)->update(['stt' => $item->stt - 1]);
            }
        }
        $id_delete->delete();
        return redirect('/danh_muc/dm_ma_nghe_trinh_do');
    }


    public function edit($id)
    {
        $model = dmmanghetrinhdo::Find($id);
        die($model);
    }
}
