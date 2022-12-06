<?php

namespace App\Http\Controllers\Nguoilaodong;

use App\Models\Company;
use App\Models\Danhmuc\dmchucvu;
use App\Models\Danhmuc\dmchuyenmondaotao;
use App\Models\Danhmuc\dmdoituonguutien;
use App\Models\Danhmuc\dmdonvi;
use App\Models\Danhmuc\dmhinhthuclamviec;
use App\Models\Danhmuc\dmloaihieuluchdld;
use App\Models\Danhmuc\dmtinhtrangthamgiahdkt;
use App\Models\Danhmuc\dmtinhtrangthamgiahdktct;
use App\Models\Danhmuc\dmtinhtrangthamgiahdktct2;
use App\Models\Danhmuc\dmtrinhdogdpt;
use App\Models\Danhmuc\dmtrinhdokythuat;
use App\Models\Danhmuc\nghecongviec;
use App\Models\Nguoilaodong\nguoilaodong;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;
use App\Models\Report;
use Illuminate\Support\Facades\Session;

class nguoilaodongController extends Controller
{
  public function __construct()
  {
    $this->middleware(function ($request, $next) {
      if (!Session::has('admin')) {
        return redirect('/');
      };
      return $next($request);
    });
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (!chkPhanQuyen('laodongtrongnuoc', 'danhsach')) {
      return view('errors.noperm')->with('machucnang', 'laodongtrongnuoc');
    }
    // $model=nguoilaodong::paginate(20); 
    $model = nguoilaodong::where('madb', session('admin')['madv'])
      ->OrderBy('id', 'DESC')->get();
    $a_chucvu = array_column(dmchucvu::all()->toarray(), 'tencv', 'id');
    return view('nguoilaodong.index')
      ->with('model', $model)
      ->with('a_chucvu', $a_chucvu);
  }

  public function index_nuocngoai()
  {
    if (!chkPhanQuyen('laodongnguoinuocngoai', 'danhsach')) {
      return view('errors.noperm')->with('machucnang', 'laodongnguoinuocngoai');
    }
    // $model = nguoilaodong::wherenotin('nation', ['VN', 'Việt Nam'])
    //   ->OrderBy('id', 'DESC')->get();
    $model = nguoilaodong::where('madb', session('admin')['madv'])
      ->OrderBy('id', 'DESC')->get();
    return view('nguoilaodong.nuocngoai.index')
      ->with('model', $model);
  }

  public function create_nuocngoai()
  {

    if (!chkPhanQuyen('laodongnguoinuocngoai', 'thaydoi')) {
      return view('errors.noperm')->with('machucnang', 'laodongnguoinuocngoai');
    }
    $countries_list = $this->getCountries();
    $dmchuyenmon = dmchuyenmondaotao::all();
    $dmnghecongviec = nghecongviec::all();
    $dmhinhthuccv = dmhinhthuclamviec::all();
    return view('nguoilaodong.nuocngoai.create')
      ->with('countries_list', $countries_list)
      ->with('dmchuyenmon', $dmchuyenmon)
      ->with('dmnghecongviec', $dmnghecongviec)
      ->with('dmhinhthuccv', $dmhinhthuccv);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    if (!chkPhanQuyen('laodongtrongnuoc', 'thaydoi')) {
      return view('errors.noperm')->with('machucnang', 'laodongtrongnuoc');
    }
    $countries_list = $this->getCountries();
    // get params
    $dmhc = $this->getdanhmuc();
    // $list_cmkt = $this->getParamsByNametype('Trình độ CMKT');
    // $list_tdgd = $this->getParamsByNametype('Trình độ học vấn');
    // $list_nghe = $this->getParamsByNametype('Nghề nghiệp người lao động');
    // $list_vithe = $this->getParamsByNametype('Vị thế việc làm');
    // $list_linhvuc = $this->getParamsByNametype('Lĩnh vực đào tạo');
    // $list_hdld = $this->getParamsByNametype('Loại hợp đồng lao động');
    $list_cmkt = dmtrinhdokythuat::all();
    $list_tdgd = dmtrinhdogdpt::all();
    $list_nghe = $this->getParamsByNametype('Nghề nghiệp người lao động');
    $list_linhvuc = dmchuyenmondaotao::all();
    $list_hdld = dmloaihieuluchdld::all();
    $doituong_ut = dmdoituonguutien::all();
    $chucvu = dmchucvu::all();
    $congty = Company::all();

    $list_tinhtrangvl = dmtinhtrangthamgiahdkt::all();
    $list_tinhtrangvl1 = dmtinhtrangthamgiahdktct::all();
    $list_tinhtrangvl2 = dmtinhtrangthamgiahdktct2::all();

    //lấy danh sách các trường có ở bảng ct2
    $a_vithevl = array(
      // array('madm'=>'','tendm'=>'')
    );
    $a_thoigianthatnghiep = array();
    $a_nguoithatnghiep = array();
    $a_lydo_khongthamgia_hdkt = array();
    foreach ($list_tinhtrangvl1 as $item) {
      $model = $list_tinhtrangvl2->where('manhom2', $item->madmtgktct);
      if (count($model) > 0) {
        foreach ($model as $key => $ct) {
          if ($item->tentgktct == 'Vị thế việc làm') {
            $a_vithevl[$key]['madm'] = $ct->madmtgktct2;
            $a_vithevl[$key]['tendm'] = $ct->tentgktct2;
          }
          if ($item->tentgktct == 'Thời gian thất nghiệp') {
            $a_thoigianthatnghiep[$key]['madm'] = $ct->madmtgktct2;
            $a_thoigianthatnghiep[$key]['tendm'] = $ct->tentgktct2;
          }
        }
      }
    }

    foreach ($list_tinhtrangvl as $val) {
      $m = $list_tinhtrangvl1->where('manhom', $val->madmtgkt);
      if (count($m)) {
        foreach ($m as $k => $ct) {
          if ($val->tentgkt == 'Người thất nghiệp' && $ct->tentgktct != 'Thời gian thất nghiệp') {
            $a_nguoithatnghiep[$k]['madm'] = $ct->madmtgktct;
            $a_nguoithatnghiep[$k]['tendm'] = $ct->tentgktct;
          }

          if ($val->tentgkt == 'Không tham gia hoạt động kinh tế') {
            $a_lydo_khongthamgia_hdkt[$k]['madm'] = $ct->madmtgktct;
            $a_lydo_khongthamgia_hdkt[$k]['tendm'] = $ct->tentgktct;
          }
        }
      }
    }
    // dd($a_lydo_khongthamgia_hdkt);
    // return view ('pages.employer.new')
    return view('nguoilaodong.create')
      ->with('countries_list', $countries_list)
      ->with('dmhc', $dmhc)
      ->with('chucvu', $chucvu)
      ->with('congty', $congty)
      ->with('a_vithevl', $a_vithevl)
      ->with('a_thoigianthatnghiep', $a_thoigianthatnghiep)
      ->with('a_nguoithatnghiep', $a_nguoithatnghiep)
      ->with('a_lydo_khongthamgia_hdkt', $a_lydo_khongthamgia_hdkt)
      ->with('list_tinhtrangvl', $list_tinhtrangvl)
      ->with('doituong_ut', $doituong_ut)
      ->with('list_cmkt', $list_cmkt)
      ->with('list_tdgd', $list_tdgd)
      ->with('list_nghe', $list_nghe)
      ->with('list_linhvuc', $list_linhvuc)
      ->with('list_hdld', $list_hdld);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if (!chkPhanQuyen('laodongtrongnuoc', 'thaydoi')) {
      return view('errors.noperm')->with('machucnang', 'laodongtrongnuoc');
    }
    $inputs = $request->all();
    $inputs['madb'] = session('admin')['madv'];
    $inputs['ma_nld'] = getdate()[0];
    $model = nguoilaodong::where('cmnd', $inputs['cmnd'])->first();
    if ($model != null) {
      return view('errors.tontai_dulieu')
        ->with('message', 'Người lao động đã có trong danh sách')
        ->with('furl', '/nguoilaodong');
    }
    nguoilaodong::create($inputs);
    return redirect('/nguoilaodong')
      ->with('success', 'Thêm mới thành công');
  }

  public function store_nuocngoai(Request $request)
  {
    if (!chkPhanQuyen('laodongnguoinuocngoai', 'thaydoi')) {
      return view('errors.noperm')->with('machucnang', 'laodongnguoinuocngoai');
    }
    $inputs = $request->all();
    $inputs['ma_nld'] = getdate()[0];
    $inputs['sohc'] = $inputs['cmnd'];
    $inputs['madb']=session('admin')->madv;
    $model = nguoilaodong::where('sohc', $inputs['sohc'])->first();
    if ($model != null) {
      return view('errors.tontai_dulieu')
        ->with('message', 'Người lao động đã có trong danh sách')
        ->with('furl', '/nguoilaodong/nuoc_ngoai');
    }
    nguoilaodong::create($inputs);
    return redirect('/nguoilaodong/nuoc_ngoai')
      ->with('success', 'Thêm mới thành công');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    if (!chkPhanQuyen('laodongtrongnuoc', 'thaydoi')) {
      return view('errors.noperm')->with('machucnang', 'laodongtrongnuoc');
    }
    $countries_list = $this->getCountries();
    // get params
    $dmhc = $this->getdanhmuc();
    $list_cmkt = dmtrinhdokythuat::all();
    $list_tdgd = dmtrinhdogdpt::all();
    $list_nghe = $this->getParamsByNametype('Nghề nghiệp người lao động');
    $list_linhvuc = dmchuyenmondaotao::all();
    $list_hdld = dmloaihieuluchdld::all();
    $doituong_ut = dmdoituonguutien::all();
    $chucvu = dmchucvu::all();
    $congty = Company::all();
    $model_ld = nguoilaodong::findOrFail($id);

    $list_tinhtrangvl = dmtinhtrangthamgiahdkt::all();
    $list_tinhtrangvl1 = dmtinhtrangthamgiahdktct::all();
    $list_tinhtrangvl2 = dmtinhtrangthamgiahdktct2::all();


    $a_vithevl = array();
    $a_thoigianthatnghiep = array();
    $a_nguoithatnghiep = array();
    $a_lydo_khongthamgia_hdkt = array();
    foreach ($list_tinhtrangvl1 as $item) {
      $model = $list_tinhtrangvl2->where('manhom2', $item->madmtgktct);
      if (count($model) > 0) {
        foreach ($model as $key => $ct) {
          if ($item->tentgktct == 'Vị thế việc làm') {
            $a_vithevl[$key]['madm'] = $ct->madmtgktct2;
            $a_vithevl[$key]['tendm'] = $ct->tentgktct2;
          }
          if ($item->tentgktct == 'Thời gian thất nghiệp') {
            $a_thoigianthatnghiep[$key]['madm'] = $ct->madmtgktct2;
            $a_thoigianthatnghiep[$key]['tendm'] = $ct->tentgktct2;
          }
        }
      }
    }

    foreach ($list_tinhtrangvl as $val) {
      $m = $list_tinhtrangvl1->where('manhom', $val->madmtgkt);
      if (count($m)) {
        foreach ($m as $k => $ct) {
          if ($val->tentgkt == 'Người thất nghiệp' && $ct->tentgktct != 'Thời gian thất nghiệp') {
            $a_nguoithatnghiep[$k]['madm'] = $ct->madmtgktct;
            $a_nguoithatnghiep[$k]['tendm'] = $ct->tentgktct;
          }

          if ($val->tentgkt == 'Không tham gia hoạt động kinh tế') {
            $a_lydo_khongthamgia_hdkt[$k]['madm'] = $ct->madmtgktct;
            $a_lydo_khongthamgia_hdkt[$k]['tendm'] = $ct->tentgktct;
          }
        }
      }
    }
    return view('nguoilaodong.edit')
      ->with('countries_list', $countries_list)
      ->with('dmhc', $dmhc)
      ->with('chucvu', $chucvu)
      ->with('doituong_ut', $doituong_ut)
      ->with('congty', $congty)
      ->with('list_cmkt', $list_cmkt)
      ->with('list_tdgd', $list_tdgd)
      ->with('list_nghe', $list_nghe)
      ->with('a_vithevl', $a_vithevl)
      ->with('a_thoigianthatnghiep', $a_thoigianthatnghiep)
      ->with('a_nguoithatnghiep', $a_nguoithatnghiep)
      ->with('a_lydo_khongthamgia_hdkt', $a_lydo_khongthamgia_hdkt)
      ->with('list_tinhtrangvl', $list_tinhtrangvl)
      ->with('list_linhvuc', $list_linhvuc)
      ->with('list_hdld', $list_hdld)
      ->with('model', $model_ld);
  }

  public function edit_nuocngoai($id)
  {
    if (!chkPhanQuyen('laodongnguoinuocngoai', 'thaydoi')) {
      return view('errors.noperm')->with('machucnang', 'laodongnguoinuocngoai');
    }
    $countries_list = $this->getCountries();
    $dmchuyenmon = dmchuyenmondaotao::all();
    $dmnghecongviec = nghecongviec::all();
    $dmhinhthuccv = dmhinhthuclamviec::all();
    $model = nguoilaodong::findOrFail($id);
    return view('nguoilaodong.nuocngoai.edit')
      ->with('model', $model)
      ->with('countries_list', $countries_list)
      ->with('dmchuyenmon', $dmchuyenmon)
      ->with('dmnghecongviec', $dmnghecongviec)
      ->with('dmhinhthuccv', $dmhinhthuccv)
      ->with('success', 'Cập nhật thành công');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    if (!chkPhanQuyen('laodongtrongnuoc', 'thaydoi')) {
      return view('errors.noperm')->with('machucnang', 'laodongtrongnuoc');
    }
    $inputs = $request->all();
    $model = nguoilaodong::findOrFail($id);
    $model->update($inputs);
    return redirect('/nguoilaodong')
      ->with('success', 'Cập nhật thành công');
  }

  public function update_nuocngoai(Request $request, $id)
  {
    if (!chkPhanQuyen('laodongnguoinuocngoai', 'thaydoi')) {
      return view('errors.noperm')->with('machucnang', 'laodongnguoinuocngoai');
    }
    $inputs = $request->all();
    $inputs['sohc'] = $inputs['cmnd'];
    $model = nguoilaodong::findOrFail($id);
    $model->update($inputs);
    return redirect('/nguoilaoding/nuoc_ngoai')
      ->with('success', 'Cập nhật thành công');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    if (!chkPhanQuyen('laodongtrongnuoc', 'thaydoi')) {
      return view('errors.noperm')->with('machucnang', 'laodongtrongnuoc');
    }
    $model = nguoilaodong::findOrFail($id);
    $model->delete();
    return redirect('/nguoilaodong')
      ->with('success', 'Xóa thành công');
  }

  public function destroy_nuocngoai($id)
  {
    if (!chkPhanQuyen('laodongnguoinuocngoai', 'thaydoi')) {
      return view('errors.noperm')->with('machucnang', 'laodongnguoinuocngoai');
    }
    $model = nguoilaodong::findOrFail($id);
    $model->delete();
    return redirect('/nguoilaodong/nuoc_ngoai')
      ->with('success', 'Xóa thành công');
  }

  public function danhsach_nuocngoai()
  {
    $model = nguoilaodong::wherenotin('nation', ['VN', 'Việt Nam'])->get();
    $m_dv = dmdonvi::where('madv', session('admin')['madv'])->first();
    return view('reports.laodongnuocngoai.danhsach')
      ->with('model', $model)
      ->with('m_dv', $m_dv)
      ->with('pageTitle', 'Danh sách lao động nước ngoài');
  }

  public function getCompany($uid)
  {

    $dn = DB::table('company')->where('user', $uid)->first();
    return $dn;
  }
  public function getdanhmuc()
  {

    $dm = DB::table('danhmuchanhchinh')->where('public', '1')->get();
    return $dm;
  }


  public function getParamsByNametype($paramtype)
  {
    $cats = array();
    $type = DB::table('paramtype')->where('name', $paramtype)->get()->first();
    if ($type) {
      $cats = DB::table('param')->where('type', $type->id)->get();
    }
    return $cats;
  }

  public function getCountries()
  {

    return  $countries_list = array(
      "AF" => "Afghanistan",
      "AX" => "Aland Islands",
      "AL" => "Albania",
      "DZ" => "Algeria",
      "AS" => "American Samoa",
      "AD" => "Andorra",
      "AO" => "Angola",
      "AI" => "Anguilla",
      "AQ" => "Antarctica",
      "AG" => "Antigua and Barbuda",
      "AR" => "Argentina",
      "AM" => "Armenia",
      "AW" => "Aruba",
      "AU" => "Australia",
      "AT" => "Austria",
      "AZ" => "Azerbaijan",
      "BS" => "Bahamas",
      "BH" => "Bahrain",
      "BD" => "Bangladesh",
      "BB" => "Barbados",
      "BY" => "Belarus",
      "BE" => "Belgium",
      "BZ" => "Belize",
      "BJ" => "Benin",
      "BM" => "Bermuda",
      "BT" => "Bhutan",
      "BO" => "Bolivia",
      "BQ" => "Bonaire, Sint Eustatius and Saba",
      "BA" => "Bosnia and Herzegovina",
      "BW" => "Botswana",
      "BV" => "Bouvet Island",
      "BR" => "Brazil",
      "IO" => "British Indian Ocean Territory",
      "BN" => "Brunei Darussalam",
      "BG" => "Bulgaria",
      "BF" => "Burkina Faso",
      "BI" => "Burundi",
      "KH" => "Cambodia",
      "CM" => "Cameroon",
      "CA" => "Canada",
      "CV" => "Cape Verde",
      "KY" => "Cayman Islands",
      "CF" => "Central African Republic",
      "TD" => "Chad",
      "CL" => "Chile",
      "CN" => "China",
      "CX" => "Christmas Island",
      "CC" => "Cocos (Keeling) Islands",
      "CO" => "Colombia",
      "KM" => "Comoros",
      "CG" => "Congo",
      "CD" => "Congo, the Democratic Republic of the",
      "CK" => "Cook Islands",
      "CR" => "Costa Rica",
      "CI" => "Cote D'Ivoire",
      "HR" => "Croatia",
      "CU" => "Cuba",
      "CW" => "Curacao",
      "CY" => "Cyprus",
      "CZ" => "Czech Republic",
      "DK" => "Denmark",
      "DJ" => "Djibouti",
      "DM" => "Dominica",
      "DO" => "Dominican Republic",
      "EC" => "Ecuador",
      "EG" => "Egypt",
      "SV" => "El Salvador",
      "GQ" => "Equatorial Guinea",
      "ER" => "Eritrea",
      "EE" => "Estonia",
      "ET" => "Ethiopia",
      "FK" => "Falkland Islands (Malvinas)",
      "FO" => "Faroe Islands",
      "FJ" => "Fiji",
      "FI" => "Finland",
      "FR" => "France",
      "GF" => "French Guiana",
      "PF" => "French Polynesia",
      "TF" => "French Southern Territories",
      "GA" => "Gabon",
      "GM" => "Gambia",
      "GE" => "Georgia",
      "DE" => "Germany",
      "GH" => "Ghana",
      "GI" => "Gibraltar",
      "GR" => "Greece",
      "GL" => "Greenland",
      "GD" => "Grenada",
      "GP" => "Guadeloupe",
      "GU" => "Guam",
      "GT" => "Guatemala",
      "GG" => "Guernsey",
      "GN" => "Guinea",
      "GW" => "Guinea-Bissau",
      "GY" => "Guyana",
      "HT" => "Haiti",
      "HM" => "Heard Island and Mcdonald Islands",
      "VA" => "Holy See (Vatican City State)",
      "HN" => "Honduras",
      "HK" => "Hong Kong",
      "HU" => "Hungary",
      "IS" => "Iceland",
      "IN" => "India",
      "ID" => "Indonesia",
      "IR" => "Iran, Islamic Republic of",
      "IQ" => "Iraq",
      "IE" => "Ireland",
      "IM" => "Isle of Man",
      "IL" => "Israel",
      "IT" => "Italy",
      "JM" => "Jamaica",
      "JP" => "Japan",
      "JE" => "Jersey",
      "JO" => "Jordan",
      "KZ" => "Kazakhstan",
      "KE" => "Kenya",
      "KI" => "Kiribati",
      "KP" => "Korea, Democratic People's Republic of",
      "KR" => "Korea, Republic of",
      "XK" => "Kosovo",
      "KW" => "Kuwait",
      "KG" => "Kyrgyzstan",
      "LA" => "Lao People's Democratic Republic",
      "LV" => "Latvia",
      "LB" => "Lebanon",
      "LS" => "Lesotho",
      "LR" => "Liberia",
      "LY" => "Libyan Arab Jamahiriya",
      "LI" => "Liechtenstein",
      "LT" => "Lithuania",
      "LU" => "Luxembourg",
      "MO" => "Macao",
      "MK" => "Macedonia, the Former Yugoslav Republic of",
      "MG" => "Madagascar",
      "MW" => "Malawi",
      "MY" => "Malaysia",
      "MV" => "Maldives",
      "ML" => "Mali",
      "MT" => "Malta",
      "MH" => "Marshall Islands",
      "MQ" => "Martinique",
      "MR" => "Mauritania",
      "MU" => "Mauritius",
      "YT" => "Mayotte",
      "MX" => "Mexico",
      "FM" => "Micronesia, Federated States of",
      "MD" => "Moldova, Republic of",
      "MC" => "Monaco",
      "MN" => "Mongolia",
      "ME" => "Montenegro",
      "MS" => "Montserrat",
      "MA" => "Morocco",
      "MZ" => "Mozambique",
      "MM" => "Myanmar",
      "NA" => "Namibia",
      "NR" => "Nauru",
      "NP" => "Nepal",
      "NL" => "Netherlands",
      "AN" => "Netherlands Antilles",
      "NC" => "New Caledonia",
      "NZ" => "New Zealand",
      "NI" => "Nicaragua",
      "NE" => "Niger",
      "NG" => "Nigeria",
      "NU" => "Niue",
      "NF" => "Norfolk Island",
      "MP" => "Northern Mariana Islands",
      "NO" => "Norway",
      "OM" => "Oman",
      "PK" => "Pakistan",
      "PW" => "Palau",
      "PS" => "Palestinian Territory, Occupied",
      "PA" => "Panama",
      "PG" => "Papua New Guinea",
      "PY" => "Paraguay",
      "PE" => "Peru",
      "PH" => "Philippines",
      "PN" => "Pitcairn",
      "PL" => "Poland",
      "PT" => "Portugal",
      "PR" => "Puerto Rico",
      "QA" => "Qatar",
      "RE" => "Reunion",
      "RO" => "Romania",
      "RU" => "Russian Federation",
      "RW" => "Rwanda",
      "BL" => "Saint Barthelemy",
      "SH" => "Saint Helena",
      "KN" => "Saint Kitts and Nevis",
      "LC" => "Saint Lucia",
      "MF" => "Saint Martin",
      "PM" => "Saint Pierre and Miquelon",
      "VC" => "Saint Vincent and the Grenadines",
      "WS" => "Samoa",
      "SM" => "San Marino",
      "ST" => "Sao Tome and Principe",
      "SA" => "Saudi Arabia",
      "SN" => "Senegal",
      "RS" => "Serbia",
      "CS" => "Serbia and Montenegro",
      "SC" => "Seychelles",
      "SL" => "Sierra Leone",
      "SG" => "Singapore",
      "SX" => "Sint Maarten",
      "SK" => "Slovakia",
      "SI" => "Slovenia",
      "SB" => "Solomon Islands",
      "SO" => "Somalia",
      "ZA" => "South Africa",
      "GS" => "South Georgia and the South Sandwich Islands",
      "SS" => "South Sudan",
      "ES" => "Spain",
      "LK" => "Sri Lanka",
      "SD" => "Sudan",
      "SR" => "Suriname",
      "SJ" => "Svalbard and Jan Mayen",
      "SZ" => "Swaziland",
      "SE" => "Sweden",
      "CH" => "Switzerland",
      "SY" => "Syrian Arab Republic",
      "TW" => "Taiwan, Province of China",
      "TJ" => "Tajikistan",
      "TZ" => "Tanzania, United Republic of",
      "TH" => "Thailand",
      "TL" => "Timor-Leste",
      "TG" => "Togo",
      "TK" => "Tokelau",
      "TO" => "Tonga",
      "TT" => "Trinidad and Tobago",
      "TN" => "Tunisia",
      "TR" => "Turkey",
      "TM" => "Turkmenistan",
      "TC" => "Turks and Caicos Islands",
      "TV" => "Tuvalu",
      "UG" => "Uganda",
      "UA" => "Ukraine",
      "AE" => "United Arab Emirates",
      "GB" => "United Kingdom",
      "US" => "United States",
      "UM" => "United States Minor Outlying Islands",
      "UY" => "Uruguay",
      "UZ" => "Uzbekistan",
      "VU" => "Vanuatu",
      "VE" => "Venezuela",
      "VN" => "Viet Nam",
      "VG" => "Virgin Islands, British",
      "VI" => "Virgin Islands, U.s.",
      "WF" => "Wallis and Futuna",
      "EH" => "Western Sahara",
      "YE" => "Yemen",
      "ZM" => "Zambia",
      "ZW" => "Zimbabwe"
    );
  }

  public function importFile(Request $request)
  {
    $file = $request->file('import_file');
    $dataOject = new stdClass();
    $theArray = Excel::toArray($dataOject, $file);
    $arr = $theArray[0];
    $lds = array();
    $nfield = 34;
    for ($i = 1; $i < count($arr); $i++) {

      $data = array();
      for ($j = 0; $j < $nfield; $j++) {

        $data[$arr[0][$j]] = $arr[$i][$j];
      }
      // check data
      if (!$data['hoten']) {
        break;
      };
      $data['cmnd'] = str_replace('\'', '', $data['cmnd']);

      if (!$this->checkCmndExits($data['cmnd'])) {
        $data['company'] = session('admin')['madv'];
        $data['ma_nld'] = getdate()[0];
        $unix_date = ($data['ngaysinh'] - 25569) * 86400;

        $data['ngaysinh'] = date('Y-m-d', $unix_date);

        if (!$data['state']) {
          $data['state'] = 1;
        }

        if ($data['bdbhxh']) {

          $unix_date = ($data['bdbhxh'] - 25569) * 86400;

          $data['bdbhxh'] = date('Y-m-d', $unix_date);
        }
        if ($data['bdhopdong']) {

          $unix_date = ($data['bdhopdong'] - 25569) * 86400;

          $data['bdhopdong'] = date('Y-m-d', $unix_date);
        }

        if ($data['bddochai']) {

          $unix_date = ($data['bddochai'] - 25569) * 86400;

          $data['bddochai'] = date('Y-m-d', $unix_date);
        }
        if ($data['ktdochai']) {

          $unix_date = ($data['ktdochai'] - 25569) * 86400;

          $data['ktdochai'] = date('Y-m-d', $unix_date);
        }
        if ($data['kthopdong']) {

          $unix_date = ($data['kthopdong'] - 25569) * 86400;

          $data['kthopdong'] = date('Y-m-d', $unix_date);
        }
        if ($data['ktbhxh']) {

          $unix_date = ($data['ktbhxh'] - 25569) * 86400;

          $data['ktbhxh'] = date('Y-m-d', $unix_date);
        }
        $lds[] =  $data;
      }
    }
    $num_valid_ld = count($lds);
    if ($num_valid_ld) {
      $result = DB::table('nguoilaodong')->insert($lds);
      // $result=nguoilaodong::create($lds);
      $note = "Đã lưu thành công " . $num_valid_ld . " lao động.";
      // add to log system`
      $rm = new Report();
      $rm->report('import', $result, 'nguoilaodong', DB::getPdo()->lastInsertId(), $num_valid_ld, $note);
      return redirect('/nguoilaodong')
        ->with('success', $note);
    } else {
      return redirect('nguoilaodong')
        ->with('error', 'Người lao động đã có trong danh sách');
    }
  }

  // Kiểm tra CMND của người lao động, đảm bảo tính duy nhất
  public function checkCmndExits($cmnd)
  {

    $result = DB::table('nguoilaodong')->select('id')->where('cmnd', $cmnd)->whereNotIn('state', [3])->get()->first();
    if ($result) {
      return $result->id;
    } else {

      return 0;
    }
  }
}
