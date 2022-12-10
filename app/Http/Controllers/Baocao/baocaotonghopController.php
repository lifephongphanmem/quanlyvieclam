<?php

namespace App\Http\Controllers\Baocao;

use App\Models\Company;
use App\Models\Danhmuc\dmloaihinhhdkt;
use App\Models\Nguoilaodong\nguoilaodong;
use App\Models\Caulaodong\nhucautuyendung;
use App\Models\Caulaodong\nhucautuyendungct;
use App\Models\Thongbao\thongbao;
use App\Models\Cunglaodong\tonghopdanhsachcungld;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Cunglaodong\tonghopdanhsachcungld_ct;
use App\Models\Danhmuc\dmmanghetrinhdo;
use App\Models\Danhmuc\dmtinhtrangthamgiahdktct;
use App\Models\Danhmuc\dmtinhtrangthamgiahdktct2;
use App\Models\Danhmuc\dmtrinhdokythuat;
use Illuminate\Support\Facades\Session;

class baocaotonghopController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin')) {
                return redirect('/home');
            };
            return $next($request);
        });
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // người sử dụng lao động
    public function index()
    {
        $madv = session('admin')['madv'];
        $nguoidung = Company::where('madv',$madv)->first();
   
        $tonghopcungld = tonghopdanhsachcungld::all();
        $company = Company::all();
        $thongbaocungld = Thongbao::all();
        return view('reports.baocaotonghop.index', compact('nguoidung', 'tonghopcungld', 'company','thongbaocungld'));
    }


    public function doanhnghiep(Request $request)
    {
        $madv = session('admin')['madv'];
        $nguoidung = Company::where('madv',$madv)->first();
        $model = nguoilaodong::where('company', $request->id)->where('madb', $request->madb)->get();
        return view('reports.baocaotonghop.cungld.doanhnghiep', compact('model', 'nguoidung'))
            ->with('pageTitle', 'Báo thông tin người lao động');
    }

    // sở lao động thương binh và xã hội
    public function soldtbxh(Request $request)
    {
        $dotthongbao = nguoilaodong::where('madb', $request->madb)->get();
        $doanhnghiep = $dotthongbao->where('loaihinh', '!=', ['81', '51']);
        $hoptacxa = $dotthongbao->where('loaihinh', ['81', '51']);

        //doanh nghiệp
        $tong_dn = count($doanhnghiep);
        $ldnu_dn  = count($doanhnghiep->where('gioitinh', 'nu'));
        $ldtren35_dn  = 0;
        $bhxh_dn  = count($doanhnghiep->where('bdbhxh', '!=', null));
        $cmktquanly_dn  = count($doanhnghiep->where('nghenghiep', ['Nhà lãnh đạo', 'Giám đốc']));
        $cmktcao_dn  = count($doanhnghiep->where('trinhdocmkt', 'Đại học trở lên'));
        $cmkttrung_dn  = count($doanhnghiep->where('trinhdocmkt', '!=', 'Đại học trở lên'));
        $cmktkhac_dn  = 0;
        $lhldco_dn  = count($doanhnghiep->where('loaihdld', '!=', 'Không xác định thời hạn')->where('loaihdld', '!=', 'Dưới 3 tháng'));
        $lhldkhong_dn  = count($doanhnghiep->where('loaihdld', 'Không xác định thời hạn'));
        $lhldkhac_dn  = count($doanhnghiep->where('loaihdld', 'Dưới 3 tháng'));

        //hợp tác xã
        $tong_htx = count($hoptacxa);
        $ldnu_htx = count($hoptacxa->where('gioitinh', 'nu'));
        $ldtren35_htx = 0;
        $bhxh_htx = count($hoptacxa->where('bdbhxh', '!=', null));
        $cmktquanly_htx = count($hoptacxa->where('nghenghiep', ['Nhà lãnh đạo', 'Giám đốc']));
        $cmktcao_htx = count($hoptacxa->where('trinhdocmkt', 'Đại học trở lên'));
        $cmkttrung_htx = count($hoptacxa->where('trinhdocmkt', '!=', 'Đại học trở lên'));
        $cmktkhac_htx = 0;
        $lhldco_htx = count($hoptacxa->where('loaihdld', '!=', 'Không xác định thời hạn')->where('loaihdld', '!=', 'Dưới 3 tháng'));
        $lhldkhong_htx = count($hoptacxa->where('loaihdld', 'Không xác định thời hạn'));
        $lhldkhac_htx = count($hoptacxa->where('loaihdld', 'Dưới 3 tháng'));

        $model_doanhnghiep = [$tong_dn, $ldnu_dn, $ldtren35_dn, $bhxh_dn,  $cmktquanly_dn, $cmktcao_dn, $cmkttrung_dn, $cmktkhac_dn, $lhldco_dn, $lhldkhong_dn, $lhldkhac_dn];
        $model_hoptacxa = [$tong_htx, $ldnu_htx, $ldtren35_htx, $bhxh_htx,  $cmktquanly_htx, $cmktcao_htx, $cmkttrung_htx, $cmktkhac_htx, $lhldco_htx, $lhldkhong_htx, $lhldkhac_htx];
        return view('reports.baocaotonghop.cungld.solaodongtbxh', compact('model_doanhnghiep', 'model_hoptacxa'))
            ->with('pageTitle', 'Báo thông tin người lao động');
    }

    public function thongtincungld()
    {
        return view('reports.baocaotonghop.cungld.thongtincungld')
            ->with('pageTitle', 'Thông tin cung lao động lao động');
    }
    public function laodongnuocngoai()
    {
        return view('reports.baocaotonghop.cungld.laodongnuocngoai')
            ->with('pageTitle', 'Thông tin người lao động nước ngoài');
    }
    
    public function tinhhinhsudungld()
    {
        return view('reports.baocaotonghop.cauld.tinhhinhsudungld')
            ->with('pageTitle', 'Tình hình sử dụng lao động');
    }

    public function dsttcungld()
    {
        return view('reports.baocaotonghop.cungld.dsttcungld')
            ->with('pageTitle', 'Danh sách thông tin cung dụng lao động');
    }
    public function nhucautuyendungld()
    {
        return view('reports.baocaotonghop.cauld.nhucautuyendungld')
            ->with('pageTitle', 'Thông tin nhu cầu tuyển dụng lao động');
    }
    public function cungldcapxahuyen()
    {
        return view('reports.baocaotonghop.cungld.cungldcapxahuyen')
            ->with('pageTitle', 'Báo cáo tổng hợp về thông tin về cung lao động dành cho cấp xã và cấp huyện');
    }
    public function thongtinthitruongld(Request $request)
    {
        $nam = $request->nam;

        $tonghopdanhsachcungld_ct = tonghopdanhsachcungld_ct::all();


        $loaihinhkt = dmloaihinhhdkt::all();
        $company = Company::all();
        $nhucautuyendungct = nhucautuyendungct::all();
        $dmmanghetrinhdo = dmmanghetrinhdo::all();
        $dmtrinhdokythuat = dmtrinhdokythuat::all();
        $dmvithevieclam = dmtinhtrangthamgiahdktct2::where('manhom2','20221108050528')->get();
        $tgthatnghiep= dmtinhtrangthamgiahdktct2::where('manhom2','20221123034628')->get();
        $lydoktg= dmtinhtrangthamgiahdktct::where('manhom','20221108050508')->get();
        $vitrivl= dmtinhtrangthamgiahdktct2::where('manhom2','20221108050559')->get();
        $nhucautuyendung = nhucautuyendung::join('nhucautuyendungct', 'nhucautuyendung.mahs' ,'=','nhucautuyendungct.mahs')
        ->select('nhucautuyendungct.*', 'nhucautuyendung.*')->get();
        // dd($nhucautuyendung);
        return view('reports.baocaotonghop.cauld.thongtinthitruongld',compact('loaihinhkt','company','nhucautuyendung',
        'dmmanghetrinhdo','nam','tonghopdanhsachcungld_ct','dmtrinhdokythuat','dmvithevieclam','tgthatnghiep','lydoktg','vitrivl'))
        ->with('pageTitle', 'Báo cáo về thông tin thị trường lao động');
    }
}
