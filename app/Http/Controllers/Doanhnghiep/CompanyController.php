<?php 
namespace App\Http\Controllers\Doanhnghiep;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Danhmuc\danhmuchanhchinh;
use App\Models\Danhmuc\dmloaihinhhdkt;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;
use App\Models\Employer;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
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
   
	 public function show($action=null)
    {
		// get filter
		$request=request();
		$search = $request->search;
		switch($action){
			case "tamdung": $state_filter = 1; break;
			case "kethuctamdung": $state_filter = 2; break;
			default: $state_filter = $request->input('state_filter',1);
		}
		// dd(session('admin'));
		// get Parrams
		
		$dmhc =$this->getdanhmuc();
		$list_cmkt=$this->getParamsByNametype('Trình độ CMKT');
		$list_tdgd=$this->getParamsByNametype('Trình độ học vấn');
		$list_nghe=$this->getParamsByNametype('Nghề nghiệp người lao động');
		$list_vithe=$this->getParamsByNametype('Vị thế việc làm');
		$list_linhvuc=$this->getParamsByNametype('Lĩnh vực đào tạo');
		$list_hdld=$this->getParamsByNametype('Loại hợp đồng lao động');
		
		$kcn = $this->getParamsByNametype("Khu công nghiệp");// lấy danh mục khu công nghiệp
		$ctype = $this->getParamsByNametype("Loại hình doanh nghiệp");// lấy loại hình doanh nghiệp
		$cfield = $this->getParamsByNametype("Ngành nghề doanh nghiệp");// lấy ngành nghề doanh nghiệp
		
		
		// thông in công ty
		
		$uid= Auth::user()->id;
		$info =$this->getInfo($uid);
	
		if(!$info->email ){
			$info->email=Auth::user()->email;
		};
		
		// Thông tin người lao động
		$cid =$info->id;
		// get Employers
		$lds= DB::table('nguoilaodong')->where('company',$cid)
					->when($search, function ($query, $search) {
                    return $query->where('nguoilaodong.hoten', 'like', '%'.$search.'%')
								->orwhere('nguoilaodong.cmnd', 'like', '%'.$search.'%');
					})
					->when($state_filter, function ($query, $state_filter) {
                    return $query->where('nguoilaodong.state', $state_filter);
					})
					->paginate(20);
	
		
		return view('pages.doanhnghiep.thongtin')
				->with('info',$info)
				->with('ctype',$ctype)
				->with('kcn',$kcn)
				->with('cfield',$cfield)
				->with('lds',$lds)
				->with('dmhc',$dmhc)
				->with('company',$info)
				->with('list_cmkt',$list_cmkt)
				->with('list_tdgd',$list_tdgd)
				->with('list_nghe',$list_nghe)
				->with('list_vithe',$list_vithe)
				->with('list_linhvuc',$list_linhvuc)
				->with('list_hdld',$list_hdld)
				->with('search',$search)
				->with('state_filter',$state_filter)
				->with('action',$action)
				;
	
    }
	
	public function nguoilaodong($action=null)
    {
		// get filter
		$request=request();
		$search = $request->search;
		switch($action){
			case "tamdung": $state_filter = 1; break;
			case "kethuctamdung": $state_filter = 2; break;
			default: $state_filter = $request->input('state_filter',1);
		}
		// get Parrams

		$dmhc =$this->getdanhmuc();
		$list_cmkt=$this->getParamsByNametype('Trình độ CMKT');
		$list_tdgd=$this->getParamsByNametype('Trình độ học vấn');
		$list_nghe=$this->getParamsByNametype('Nghề nghiệp người lao động');
		$list_vithe=$this->getParamsByNametype('Vị thế việc làm');
		$list_linhvuc=$this->getParamsByNametype('Lĩnh vực đào tạo');
		$list_hdld=$this->getParamsByNametype('Loại hợp đồng lao động');
		
		$kcn = $this->getParamsByNametype("Khu công nghiệp");// lấy danh mục khu công nghiệp
		$ctype = $this->getParamsByNametype("Loại hình doanh nghiệp");// lấy loại hình doanh nghiệp
		$cfield = $this->getParamsByNametype("Ngành nghề doanh nghiệp");// lấy ngành nghề doanh nghiệp
		
		
		// thông in công ty
		
		$uid= Auth::user()->id;
		$info =$this->getInfo($uid);
	
		if(!$info->email ){
			$info->email=Auth::user()->email;
		};
		
		// Thông tin người lao động
		$cid =$info->id;
		// get Employers
		$lds= DB::table('nguoilaodong')->where('company',$cid)
					->when($search, function ($query, $search) {
                    return $query->where('nguoilaodong.hoten', 'like', '%'.$search.'%')
								->orwhere('nguoilaodong.cmnd', 'like', '%'.$search.'%');
					})
					->when($state_filter, function ($query, $state_filter) {
                    return $query->where('nguoilaodong.state', $state_filter);
					})
					->paginate(20);	

		return view('pages.nguoilaodong.thongtin')
				->with('info',$info)
				->with('ctype',$ctype)
				->with('kcn',$kcn)
				->with('cfield',$cfield)
				->with('lds',$lds)
				->with('dmhc',$dmhc)
				->with('company',$info)
				->with('list_cmkt',$list_cmkt)
				->with('list_tdgd',$list_tdgd)
				->with('list_nghe',$list_nghe)
				->with('list_vithe',$list_vithe)
				->with('list_linhvuc',$list_linhvuc)
				->with('list_hdld',$list_hdld)
				->with('search',$search)
				->with('state_filter',$state_filter)
				->with('action',$action)
				;
	
    }
	
	  public function getInfo($uid){
		  
		 $dn= DB::table('company')->where('user',$uid)->first();
		$em= new Employer;
		$other_info=$em->getTonghop($dn->id);
		$dn->tonghop =$other_info;
		$dn->pbcmkt=$em->getPhanbo($dn->id,3);
		$dn->pblvdt=$em->getPhanbo($dn->id,11);
		$dn->pbnghenghiep=$em->getPhanbo($dn->id,9);
		return $dn;
	  }
	
	  
	  public function getdanhmuc(){
		  
		 $dm= DB::table('danhmuchanhchinh')->where('public','1')->get();
		 return $dm;
	  }
	  
	  
	 public function getParamsByNametype($paramtype)
	{
		$cats= array();
		$type= DB::table('paramtype')->where('name',$paramtype)->get()->first();
		if($type){
			$cats=DB::table('param')->where('type',$type->id)->get();
		}
		return $cats;
	}

	  
	 public function update( Request $request)
	{
		$cid= $request->id;
		
		//$validate = $request->validate([			
		//		'dkkd' => 'required|max:255|unique:company',				
		//				]);
			
		$data = array();
		$data['name']= $request->name;
		$data['dkkd']= $request->dkkd;
		$data['masodn']= $request->tinh." ".$request->huyen." ".$request->xa." ".$cid;
		
		$data['public']= $request->public;
		
		$data['fax']= $request->fax;
		$data['phone']= $request->phone;
		$data['email']= $request->email;
		$data['website']= $request->website;
		
		$data['tinh']=  $this->code2name($request->tinh);
		$data['huyen']= $this->code2name( $request->huyen);
		$data['xa']= $this->code2name($request->xa);
		$data['adress']= $request->adress;
		$data['khuvuc']= $request->khuvuc;
		$data['khucn']= $request->khucn;
		
		$data['loaihinh']= $request->loaihinh;
		$data['nganhnghe']= $request->nganhnghe;
		
		$image =$request->File('image');
		if($image){
			$data['image']= $image->store('DNDKKD');
		}
		
		
		$result= DB::table('company')->where('id',$cid)->update($data);
		
		// add to log system`
		$rm= new Report();
		$rm->report('updateinfo', $result, 'company',$cid,1);
		
		if($result){

			return redirect('doanhnghieppanel')->with('message',"Cập nhật thành công");
		}else{

			 return redirect('doanhnghieppanel')->withErrors(['message'=>"Cập nhật ko thành công"]);
		}
		
	}
	public function code2name($code){
		 $dm= DB::table('danhmuchanhchinh')->where('maquocgia',$code)->get()->first();
		 
		 if($dm){
			 return $dm->name;
			 }else{
			 return $code;
		 }
	}

	public function danhsach()
	{
		if (!chkPhanQuyen('danhsachdoanhnghiep', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'danhsachdoanhnghiep');
        }
		$model=Company::orderBy('id','DESC')->get();
		$kcn = $this->getParamsByNametype("Khu công nghiệp");// lấy danh mục khu công nghiệp
		// $ctype = $this->getParamsByNametype("Loại hình doanh nghiệp");// lấy loại hình doanh nghiệp
		$ctype=dmloaihinhhdkt::all();
		$cfield = $this->getParamsByNametype("Ngành nghề doanh nghiệp");
		return view('doanhnghiep.danhsach')
					->with('model',$model)
					->with('kcn',$kcn)
					->with('loaihinh',$ctype)
					->with('ngnahnghe',$cfield);
	}

	public function create()
	{
		if (!chkPhanQuyen('danhsachdoanhnghiep', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'danhsachdoanhnghiep');
        }
		$kcn = $this->getParamsByNametype("Khu công nghiệp");// lấy danh mục khu công nghiệp
		// $ctype = $this->getParamsByNametype("Loại hình doanh nghiệp");// lấy loại hình doanh nghiệp
		$ctype=dmloaihinhhdkt::all();
		$cfield = $this->getParamsByNametype("Ngành nghề doanh nghiệp");// lấy ngành nghề doanh nghiệp

		$dmhanhchinh=danhmuchanhchinh::all();
		return view('admin.company.create')
					->with('kcn',$kcn)
					->with('loaihinh',$ctype)
					->with('dmhanhchinh',$dmhanhchinh)
					->with('nganhnghe',$cfield);
	}
	
	public function store(Request $request)
	{
		if (!chkPhanQuyen('danhsachdoanhnghiep', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'danhsachdoanhnghiep');
        }
		$inputs=$request->all();

		Company::create($inputs);
		return redirect('/doanh_nghiep/danh_sach')
						->with('success','Thêm mới thành công');
	}

	public function edit(Request $request,$id)
	{
		if (!chkPhanQuyen('danhsachdoanhnghiep', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'danhsachdoanhnghiep');
        }
		$inputs=$request->edit;
		$model=Company::findOrFail($id);
		$dmhanhchinh=danhmuchanhchinh::all();
		$kcn = $this->getParamsByNametype("Khu công nghiệp");// lấy danh mục khu công nghiệp
		$ctype = $this->getParamsByNametype("Loại hình doanh nghiệp");// lấy loại hình doanh nghiệp
		$cfield = $this->getParamsByNametype("Ngành nghề doanh nghiệp");// lấy ngành nghề doanh nghiệp
		if(isset($inputs)){
			$inputs=$inputs;
			$url='/doanh_nghiep/thongtin';
		}else{
			$inputs=0;
			$url='/doanh_nghiep/danh_sach';
		}
		return view('admin.company.capnhat')
					->with('model',$model)
					->with('kcn',$kcn)
					->with('loaihinh',$ctype)
					->with('dmhanhchinh',$dmhanhchinh)
					->with('input',$inputs)
					->with('url',$url)
					->with('nganhnghe',$cfield);
	}

	public function update_dn(Request $request,$id)
	{
		if (!chkPhanQuyen('danhsachdoanhnghiep', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'danhsachdoanhnghiep');
        }
		$inputs=$request->all();
		$model=Company::findOrFail($id);
		$model->update($inputs);
		if($inputs['edit']==0){
			return redirect('/doanh_nghiep/danh_sach')
			->with('success','Cập nhật thành công');
		}else{
			return redirect('/doanh_nghiep/thongtin')
			->with('success','Cập nhật thành công');
		}

	}

	public function destroy($id)
	{
		if (!chkPhanQuyen('danhsachdoanhnghiep', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'danhsachdoanhnghiep');
        }
		$model=Company::findOrFail($id);
		$model->delete();
		return redirect('/doanh_nghiep/danh_sach')
				->with('success','Xóa thành công');
	}

	public function indanhsach($id)
	{
		if (!chkPhanQuyen('danhsachdoanhnghiep', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'danhsachdoanhnghiep');
        }
		$model=Company::findOrFail($id);
		$kcn = $this->getParamsByNametype("Khu công nghiệp");// lấy danh mục khu công nghiệp
		$ctype = $this->getParamsByNametype("Loại hình doanh nghiệp");// lấy loại hình doanh nghiệp
		$cfield = $this->getParamsByNametype("Ngành nghề doanh nghiệp");// lấy ngành nghề doanh nghiệp
		foreach($kcn as $cn)
		{
			if(isset($model)){
				$cn->id==$model->khucn?$model->khucn=$cn->name:'';
			}
		}
		foreach($ctype as $lh)
		{
			if(isset($model)){
				$lh->id==$model->loaihinh?$model->loaihinh=$lh->name:'';
			}
		}
		foreach($cfield as $nn)
		{
			if(isset($model)){
				$nn->id==$model->nganhnghe?$model->nganhnghe=$nn->name:'';
			}
		}
		return view('doanhnghiep.export.thongtin')
				->with('model',$model)
				->with('loaihinh',$ctype)
				->with('nganhnghe',$cfield)
				->with('pageTitle','Thông tin doanh nghiệp');
	}

	public function intonghop()
	{
		if (!chkPhanQuyen('danhsachdoanhnghiep', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'danhsachdoanhnghiep');
        }
		$model=Company::all();
		$kcn = $this->getParamsByNametype("Khu công nghiệp");// lấy danh mục khu công nghiệp
		$ctype = $this->getParamsByNametype("Loại hình doanh nghiệp");// lấy loại hình doanh nghiệp
		$cfield = $this->getParamsByNametype("Ngành nghề doanh nghiệp");// lấy ngành nghề doanh nghiệp
		foreach($model as $ct)
		{
			foreach($kcn as $cn)
		{
			if(isset($model)){
				$cn->id==$ct->khucn?$ct->khucn=$cn->name:'';
			}
		}
		foreach($ctype as $lh)
		{
			if(isset($model)){
				$lh->id==$ct->loaihinh?$ct->loaihinh=$lh->name:'';
			}
		}
		foreach($cfield as $nn)
		{
			if(isset($model)){
				$nn->id==$ct->nganhnghe?$ct->nganhnghe=$nn->name:'';
			}
		}
		}
		return view('doanhnghiep.export.tonghop')
				->with('model',$model)
				->with('pageTitle','Danh sách doanh nghiệp');
	}

	public function thongtin()
	{
		if (!chkPhanQuyen('chitietdoanhnghiep', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'quanlythongtindoanhnghiep');
        }
		$model=Company::where('masodn',session('admin')['madv'])->first();
		$kcn = $this->getParamsByNametype("Khu công nghiệp");// lấy danh mục khu công nghiệp
		$ctype = $this->getParamsByNametype("Loại hình doanh nghiệp");// lấy loại hình doanh nghiệp
		$cfield = $this->getParamsByNametype("Ngành nghề doanh nghiệp");// lấy ngành nghề doanh nghiệp
		$dmhanhchinh=danhmuchanhchinh::all();
		foreach($kcn as $cn)
		{
			if(isset($model)){
				$cn->id==$model->khucn?$model->khucn=$cn->name:'';
			}
		}
		foreach($ctype as $lh)
		{
			if(isset($model)){
				$lh->id==$model->loaihinh?$model->loaihinh=$lh->name:'';
			}
		}
		foreach($cfield as $nn)
		{
			if(isset($model)){
				$nn->id==$model->nganhnghe?$model->nganhnghe=$nn->name:'';
			}
		}

		return view('doanhnghiep.thongtin')
					->with('model',$model)
					->with('dmhanhchinh',$dmhanhchinh)
					->with('kcn',$kcn)
					->with('loaihinh',$ctype)
					->with('nganhnghe',$cfield);

	}
}
