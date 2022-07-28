<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use Session;
use Illuminate\Http\RedirectResponse;

session_start();

class AdminEmployer extends Controller
{
   

	public function __construct() {
		$this->middleware('auth');
	}
	
   public function show_all($cid = null)
	{
		//makelist
		$request = request();
		$dmhc_list= $this->getDmhc();
		//filter
		$search = $request->search;
		
		
		$lds= DB::table('nguoilaodong')
				->when($search, function ($query, $search) {
                    return $query->where('nguoilaodong.hoten', 'like', '%'.$search.'%')
							->orWhere('nguoilaodong.cmnd', 'like', '%'.$search.'%');
					})
				->when($cid, function ($query, $cid) {
                    return $query->where('nguoilaodong.company', $cid);
					})
				->paginate(20);
		

		foreach($lds as $ld){
			
			$cty= DB::table('company')->where('id',$ld->company)->get()->first();
			$ld->ctyname=$cty->name;
		}		
		return view ('admin.employer.all')
					->with('lds', $lds)
					->with('dmhc_list', $dmhc_list)
					->with('search', $search)
					;
	}
	
	public function getDmhc()
	{
		$cats=DB::table('danhmuchanhchinh')->where('level','huyện')->orwhere('level','thành phố')->get();
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
		$other_info=$em->getTonghop($dn->id);
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
			
			Session::put('message',"Thêm mới thành công");
			return redirect('ptype-ba');
		}
		
        else{
			Session::put('message',"Có lỗi xảy ra");
			return redirect('ptype-bn');
		}
		
	}
	
	 
	 public function edit($cid)
	{	$dmhc =$this->getdanhmuc();
		$kcn = $this->getParamsByNametype("Khu công nghiệp");// lấy danh mục khu công nghiệp
		$ctype = $this->getParamsByNametype("Loại hình doanh nghiệp");// lấy loại hình doanh nghiệp
		$cfield = $this->getParamsByNametype("Ngành nghề doanh nghiệp");// lấy ngành nghề doanh nghiệp
		
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
			
			Session::put('message',"Cập nhật thành công");
			return redirect('ptype-bs');
		}
		
        else{
			Session::put('message',"Có lỗi xảy ra");
			return redirect('/ptype-be/'.$catid);
		}
		
	}
	public function delete($catid)
	{
		// Check param
		$param= DB::table('param')->where('type',$catid)->count();
			if ($param){
				Session::put('message'," Tham số còn có giá trị, không thể xóa");
				return redirect('ptype-bs');
			}
		
		
		
		// Delete
		$result= DB::table('paramtype')->where('id',$catid)->delete();
		
		if($result){
			
			Session::put('message',"Xóa thành công");
			return redirect('ptype-bs');
		}
		
        else{
			Session::put('message',"Có lỗi xảy ra");
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
