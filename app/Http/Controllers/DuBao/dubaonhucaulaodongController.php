<?php

namespace App\Http\Controllers\DuBao;

use App\Http\Controllers\Controller;
use App\Models\DuBao\dubaonhucaulaodong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Collection;

class dubaonhucaulaodongController extends Controller
{

    public static $url = '/dubaonhucaulaodong/';
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin')) {
                return redirect('/');
            };
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if (!chkPhanQuyen('dubaonhucaulaodong', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'dubaonhucaulaodong');
        }
        $inputs = $request->all();
        $inputs['url'] = static::$url;
        $m_donvi = getDonVi(session('admin')->sadmin, 'dubaonhucaulaodong');
        $m_donvi = $m_donvi->where('phanloaitaikhoan', 'TH');
        $inputs['madv'] = $inputs['madv'] ?? $m_donvi->first()->madv;

        $model = dubaonhucaulaodong::where('madonvi', $inputs['madv'])->get();

        return view('DuBao.DanhSach')
            ->with('model', $model)
            ->with('a_dsdv', array_column($m_donvi->toarray(), 'tendv', 'madv'))
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Danh sách dự báo nhu cầu lao động');
    }

    public function them(Request $request)
    {
        $inputs = $request->all();
        $model = new dubaonhucaulaodong();
        $model->madubao = (string)getdate()[0];
        $model->thoigian = date('Y-m-d');
        $model->madv = $inputs['madv'];
        $inputs['url'] = static::$url;

        return view('DuBao.ThayDoi')
            ->with('model', $model)
            ->with('model_cung', nullValue())
            ->with('model_cau', nullValue())
            ->with('model_khac', nullValue())
            ->with('inputs', $inputs)
            ->with('pageTitle', 'Thông tin dự báo nhu cầu lao động');
    }
}
