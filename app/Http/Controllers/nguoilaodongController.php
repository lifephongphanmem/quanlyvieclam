<?php

namespace App\Http\Controllers;

use App\Models\nguoilaodong;
use App\Models\thongbaocungld;
use Illuminate\Http\Request;
use DB;

class nguoilaodongController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // $model=nguoilaodong::paginate(20); 
    $model = nguoilaodong::where('madb',session('admin')['madv'])
                            ->OrderBy('id', 'DESC')->get();
    return view('pages.nguoilaodong.index')
      ->with('model', $model);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $countries_list = $this->getCountries();
    // get params
    $dmhc = $this->getdanhmuc();
    $list_cmkt = $this->getParamsByNametype('Trình độ CMKT');
    $list_tdgd = $this->getParamsByNametype('Trình độ học vấn');
    $list_nghe = $this->getParamsByNametype('Nghề nghiệp người lao động');
    $list_vithe = $this->getParamsByNametype('Vị thế việc làm');
    $list_linhvuc = $this->getParamsByNametype('Lĩnh vực đào tạo');
    $list_hdld = $this->getParamsByNametype('Loại hợp đồng lao động');

    // return view ('pages.employer.new')
    return view('pages.nguoilaodong.create')
      ->with('countries_list', $countries_list)
      ->with('dmhc', $dmhc)
      ->with('list_cmkt', $list_cmkt)
      ->with('list_tdgd', $list_tdgd)
      ->with('list_nghe', $list_nghe)
      ->with('list_vithe', $list_vithe)
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
    $inputs = $request->all();
    $inputs['madb']=session('admin')['madv'];
    $inputs['ma_nld']=getdate()[0];
    $model=nguoilaodong::where('cmnd',$inputs['cmnd'])->first();
    if($model != null){
      return view('errors.tontai_dulieu')
            ->with('message','Người lao động đã có trong danh sách')
            ->with('furl','/nguoilaodong');
    }
    nguoilaodong::create($inputs);
    return redirect('/nguoilaodong');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $countries_list = $this->getCountries();
    // get params
    $dmhc = $this->getdanhmuc();
    $list_cmkt = $this->getParamsByNametype('Trình độ CMKT');
    $list_tdgd = $this->getParamsByNametype('Trình độ học vấn');
    $list_nghe = $this->getParamsByNametype('Nghề nghiệp người lao động');
    $list_vithe = $this->getParamsByNametype('Vị thế việc làm');
    $list_linhvuc = $this->getParamsByNametype('Lĩnh vực đào tạo');
    $list_hdld = $this->getParamsByNametype('Loại hợp đồng lao động');
    $model = nguoilaodong::findOrFail($id);
    return view('pages.nguoilaodong.edit')
      ->with('countries_list', $countries_list)
      ->with('dmhc', $dmhc)
      ->with('list_cmkt', $list_cmkt)
      ->with('list_tdgd', $list_tdgd)
      ->with('list_nghe', $list_nghe)
      ->with('list_vithe', $list_vithe)
      ->with('list_linhvuc', $list_linhvuc)
      ->with('list_hdld', $list_hdld)
      ->with('model', $model);
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
    $inputs=$request->all();
    $model=nguoilaodong::findOrFail($id);
    $model->update($inputs);
    return redirect('/nguoilaodong');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $model = nguoilaodong::findOrFail($id);
    $model->delete();
    return redirect('/nguoilaodong');
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

}