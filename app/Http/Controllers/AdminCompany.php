<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Employer;
use App\Models\Company;
use Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Exports\CompaniesExport;
use Maatwebsite\Excel\Facades\Excel;
class AdminCompany extends Controller
{
   

	public function __construct() {
		$this->middleware('auth');
	}
	
   public function show_all(Request $request)
	{
		//makelist
		
		$dmhc_list= $this->getDmhc();
		//filter
		$search = $request->search;
		$public_filter = $request->public_filter;
		$dm_filter = $request->dm_filter;
		
		$quymo_min_filter= $request->quymo_min_filter;
		$quymo_max_filter= $request->quymo_max_filter;
		
		$export= $request->export;
		
		if($export){
			
			return Excel::download(new CompaniesExport, 'doanhnghiep.xlsx');
		
			}
		$ctys= Company::withCount(['employers'])
				->when($search, function ($query, $search) {
                    return $query->where('company.name', 'like', '%'.$search.'%');
					})
				->when($public_filter, function ($query, $public_filter) {
                    return $query->where('company.public', $public_filter);
					})
				->when($dm_filter, function ($query, $dm_filter) {
					return $query->where('company.huyen', $dm_filter);
					})
				->when($quymo_min_filter, function ($query, $quymo_min_filter) {
					return $query->having('employers_count', '>=', $quymo_min_filter);
					})
				 ->when($quymo_max_filter, function ($query, $quymo_max_filter) {
					return $query->having('employers_count', '<=', $quymo_max_filter);	
					})
				 ->when($quymo_max_filter==0&&!is_null($quymo_max_filter), function ($query, $quymo_max_filter) {
					return $query->having('employers_count', '=', 0)	;
					})		
				->orderBy('employers_count', 'desc')
				->paginate(20);
				
			
		return view ('admin.company.all')->with('ctys', $ctys)
					->with('dmhc_list', $dmhc_list)
					->with('search', $search)
					->with('dm_filter', $dm_filter)
					->with('public_filter', $public_filter)
					->with('quymo_max_filter', $quymo_max_filter)
					->with('quymo_min_filter', $quymo_min_filter)
					;
	}
	
	public function baocao145($cid)
	{	$info= DB::table('company')->where('id',$cid)->first();
		$em= new Employer;
		$einfo=$em->getEmployerState($cid);
		return view('admin.company.sudunglaodong')
				->with('einfo',$einfo)
				->with('info',$info)
				;
		
	}
	public function baocao145V1($cid)
	{
	
		$info =$this->getInfo45($cid);
		$dmhc =$this->getdanhmuc();
		
		$kcn = $this->getParamsByNametype("Khu c??ng nghi???p");// l???y danh m???c khu c??ng nghi???p
		$ctype = $this->getParamsByNametype("Lo???i h??nh doanh nghi???p");// l???y lo???i h??nh doanh nghi???p
		$cfield = $this->getParamsByNametype("Ng??nh ngh??? doanh nghi???p");// l???y ng??nh ngh??? doanh nghi???p
		
		return view('admin.company.145')->with('info',$info)->with('dmhc',$dmhc)->with('ctype',$ctype)->with('kcn',$kcn)->with('cfield',$cfield);
		
	}
	public function getDmhc()
	{
		$cats=DB::table('danhmuchanhchinh')->where('level','huy???n')->orwhere('level','th??nh ph???')->get();
		return $cats;
	}
	public function getParams($paramtype)
	{
		$type= DB::table('paramtype')->where('name',$paramtype)->get()->first();
		$cats=DB::table('param')->where('type',$type->id)->get();
		return $cats;
	}
	
	 
	public function getInfo28($cid){
		  
		$dn= DB::table('company')->where('id',$cid)->first();
		$em= new Employer;
		$other_info=$em->getTonghop($dn->id);
		$dn->tonghop =$other_info;
		$dn->pbcmkt=$em->getPhanbo($dn->id,3);
		$dn->pblvdt=$em->getPhanbo($dn->id,11);
		$dn->pbnghenghiep=$em->getPhanbo($dn->id,9);
		return $dn;
	  }
	public function getInfo45($cid){
		  
		$dn= DB::table('company')->where('id',$cid)->first();
		$em= new Employer;
		$other_info=$em->getTonghop($cid);
		$dn->tonghop =$other_info;
		$dn->pbcmkt=$em->getPhanbo($dn->id,3);
		$dn->pblvdt=$em->getPhanbo($dn->id,11);
		$dn->pbnghenghiep=$em->getPhanbo($dn->id,9);
		return $dn;
	  }
	 public function new()
	{
		return view ('admin.company.new');
	}
	
	 public function save( Request $request)
	{
		$data = array();
		$data['name']= $request->name;
		$data['description']= $request->description;	
		$result= DB::table('paramtype')->insert($data);
		
		if($result){
			
			Session::put('message',"Th??m m???i th??nh c??ng");
			return redirect('ptype-ba');
		}
		
        else{
			Session::put('message',"C?? l???i x???y ra");
			return redirect('ptype-bn');
		}
		
	}
	
	 
	 public function edit($cid)
	{	$dmhc =$this->getdanhmuc();
		$kcn = $this->getParamsByNametype("Khu c??ng nghi???p");// l???y danh m???c khu c??ng nghi???p
		$ctype = $this->getParamsByNametype("Lo???i h??nh doanh nghi???p");// l???y lo???i h??nh doanh nghi???p
		$cfield = $this->getParamsByNametype("Ng??nh ngh??? doanh nghi???p");// l???y ng??nh ngh??? doanh nghi???p
		
		$company= DB::table('company')->where('id',$cid)->first();
		//print_r($cat);
		return view ('admin.company.edit')
				->with('dmhc', $dmhc)
				->with('info', $company)
				->with('ctype',$ctype)
				->with('kcn',$kcn)
				->with('cfield',$cfield);
		
	}
	
	
	public function update( Request $request)
	{
		$data = array();
		$data['name']= $request->name;
		$data['description']= $request->desc;
		
		$catid= $request->catid;
		
		$result= DB::table('paramtype')->where('id',$catid)->update($data);
		
		if($result){
			
			Session::put('message',"C???p nh???t th??nh c??ng");
			return redirect('ptype-bs');
		}
		
        else{
			Session::put('message',"C?? l???i x???y ra");
			return redirect('/ptype-be/'.$catid);
		}
		
	}
	public function delete($catid)
	{
		// Check param
		$param= DB::table('param')->where('type',$catid)->count();
			if ($param){
				Session::put('message'," Tham s??? c??n c?? gi?? tr???, kh??ng th??? x??a");
				return redirect('ptype-bs');
			}
		
		
		
		// Delete
		$result= DB::table('paramtype')->where('id',$catid)->delete();
		
		if($result){
			
			Session::put('message',"X??a th??nh c??ng");
			return redirect('ptype-bs');
		}
		
        else{
			Session::put('message',"C?? l???i x???y ra");
			return redirect('ptype-bs');
		}
		
	}
	public function report($type,$result,$tbl,$rowid){
		// write report 
		$r = array();
		$r['type']= $type;
		$r['result']= $result;
		$r['tbl']= $tbl;	
		$r['tbl']= $rowid;	
		$r['user']= $rowid;	
		$r['time']= $rowid;	
	
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

}
