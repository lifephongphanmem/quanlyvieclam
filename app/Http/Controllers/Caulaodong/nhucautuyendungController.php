<?php

namespace App\Http\Controllers\Caulaodong;

use App\Models\Company;
use App\Models\Danhmuc\dmmanghetrinhdo;
use App\Models\Danhmuc\dmtrinhdogdpt;
use App\Models\Danhmuc\dmtrinhdokythuat;
use App\Models\Caulaodong\nhucautuyendung;
use App\Models\Caulaodong\nhucautuyendungct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Imports\CollectionImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class nhucautuyendungController extends Controller
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


    //khai báo
    public function index_khaibao(Request $request)
    {  
        $model = nhucautuyendung::where('matb', $request->matb)->where('madn',session('admin')['madv'])->get();
        $matb = $request->matb;
        return view('Caulaodong.khaibao.index', compact('model', 'matb'));
    }
    
    public function create(Request $request)
    {
       
        nhucautuyendungct::where('xd', 'cxd')->delete();
        $matb = $request->matb;
        $mahs = date('YmdHis');
        $modelct = null;
        $dmtrinhdogdpt = dmtrinhdogdpt::all();
        $dmtrinhdokythuat = dmtrinhdokythuat::all();
        $dmmanghetrinhdo = dmmanghetrinhdo::where('trangthai','kh')->get();
        $manghefirst = dmmanghetrinhdo::select('madmmntd')->first();
        return view('Caulaodong.khaibao.create', compact('matb', 'mahs', 'modelct', 'dmtrinhdokythuat', 'dmtrinhdogdpt','dmmanghetrinhdo','manghefirst'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['nam'] = date('Y');
        $input['trangthai'] = 'cc';
        $input['madn'] = session('admin')['madv'];
        nhucautuyendung::create($input);
        nhucautuyendungct::where('mahs',$request->mahs)->update(['xd'=>'xd']);
        return redirect('tuyen_dung/khai_bao_nhu_cau?matb=' . $request->matb);
    }

    public function edit(Request $request)
    {
        $modelct = nhucautuyendungct::where('mahs', $request->mahs)->get();
        $dmtrinhdogdpt = dmtrinhdogdpt::all();
        $dmtrinhdokythuat = dmtrinhdokythuat::all();
        $dmmanghetrinhdo = dmmanghetrinhdo::where('trangthai','kh')->get();
        $model = nhucautuyendung::where('mahs', $request->mahs)->first();
        $matb = $model->matb;
        $mahs = $model->mahs;
        $manghefirst = dmmanghetrinhdo::select('madmmntd')->first();
        return view('Caulaodong.khaibao.edit', compact('model','matb','modelct', 'dmtrinhdokythuat', 'dmtrinhdogdpt','mahs','dmmanghetrinhdo','manghefirst'));
    }
    public function update(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        nhucautuyendung::where('mahs',$request->mahs)->update($input);
        nhucautuyendungct::where('mahs',$request->mahs)->update(['xd'=>'xd']);
        return redirect('tuyen_dung/khai_bao_nhu_cau?matb=' . $request->matb);
    }

    public function chuyen(Request $request)
    {
       $model = nhucautuyendung::where('mahs',$request->mahs)->first();
       $matb = $model->matb;
       $model->update(['trangthai'=> 'dc']);
        return redirect('tuyen_dung/khai_bao_nhu_cau?matb=' . $matb);
    }
    
    public function show(Request $request)
    {
        $model = nhucautuyendung::where('mahs', $request->mahs)->first();
        $matb = $model->matb;
        $modelct = nhucautuyendungct::where('mahs', $request->mahs)->get();
        $dmmanghetrinhdo = dmmanghetrinhdo::where('trangthai','kh')->get();
        return view('Caulaodong.khaibao.show', compact('model','matb','modelct','dmmanghetrinhdo'));
    }

    public function delete($id)
    {
        $model = nhucautuyendung::find($id);
        $model->delete();
        $matb = $model->matb;
        return redirect('tuyen_dung/khai_bao_nhu_cau?matb=' . $matb);
    }

    //toongt hợp
    public function index_tonghop(Request $request)
    {
        $model = nhucautuyendung::where('matb', $request->matb)->where('trangthai','dc')->get();
        $matb = $request->matb;
        $doanhnghiep = Company::all();
        return view('Caulaodong.tonghop.index', compact('model', 'matb','doanhnghiep'));
    }

    public function tralai(Request $request)
    {
        nhucautuyendung::where('mahs',$request->mahs)->update(['lydo'=>$request->lydo, 'trangthai' => 'btl']);
        return redirect('tuyen_dung/khai_bao_nhu_cau?matb=' . $request->matb);
    }

    public function nhanExcel(Request $request)
    {
        $inputs=$request->all();
        $file = $request->file('import_file');
        $dataOject = new CollectionImport(true);
        $theArray = Excel::toArray($dataOject, $file);
        $arr = $theArray[0];
        //Tìm mã đơn vị dựa trên mã xã khi công ty insert người lao động
        $lds = array();
        $lds_ct = array();
        $nfield = 4;
    
        for ($i = 1; $i < count($arr); $i++) {
    
          $data = array();
          $dulieu = array();
          $dulieu_ct= array();
          for ($j = 0; $j < $nfield; $j++) {
    
            $data[$arr[0][$j]] = $arr[$i][$j];
          }
          // check data
          if (!$data['Nghề nghiệp']) {
            break;
          };
    
            $dulieu_ct['mahs'] = date('YmdHis');;
            $dulieu_ct['tencongviec'] = $data['manghe'];
            $dulieu_ct['soluong'] = $data['Số lượng'];
            $dulieu_ct['soluongnu'] = $data['Số lượng nữ'];
            $dulieu_ct['nam'] = date('Y');
            $dulieu_ct['xd'] = 'xd';

            $dulieu['mahs']=date('YmdHis');;
            $dulieu['madn']=session('admin')->madv;
            $dulieu['matb']=$inputs['matb'];
            $dulieu['nam']=date('Y');
            $lds[] =  $dulieu;
            $lds_ct[]=$dulieu_ct;
          }
        

        $num_valid_ld = count($lds);
        if ($num_valid_ld) {
            DB::table('nhucautuyendung')->insert($lds);
            DB::table('nhucautuyendungct')->insert($lds_ct);
        //   // $result=nguoilaodong::create($lds);
        //   $note = "Đã lưu thành công " . $num_valid_ld . " lao động.";
        //   // add to log system`
        //   $rm = new Report();
        //   $rm->report('import', $result, 'nguoilaodong', DB::getPdo()->lastInsertId(), $num_valid_ld, $note);
          return redirect('/tuyen_dung/khai_bao_nhu_cau?matb='.$inputs['matb'])
            ->with('success', 'Lưu thành công');
        } else {
          return redirect('/tuyen_dung/khai_bao_nhu_cau?matb='.$inputs['matb'])
            ->with('error', 'Không thành công');
        }
      }
    
}
