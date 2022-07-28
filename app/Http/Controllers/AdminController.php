<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employer;
use App\Models\Report;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Exports\BaocaoExport;
use Maatwebsite\Excel\Facades\Excel;


class AdminController extends Controller
{
    
    public function login()
    {
		
        return view('admin.login');
    }
	
	public function dashboard()
    {
        if (Auth::check()) {
          if(Auth::user()->level<3){
			  
			  
			 $dinfo=$this->getDashboard(); 
			 $emodel= new Employer;
			 $einfo=$emodel->getEmployerState();
			 $rmodel= new Report;
			 $thismonth= date('Y-m');
			 $lastmonth= date("Y-m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
			 
			 $ebd=$rmodel->getBiendong($thismonth);

			 $rinfoup=$emodel->getEmployerStateById($ebd->tang['eid']);
			 $rinfodown=$emodel->getEmployerStateById($ebd->giam['eid']);
			 
			 $last_ebd=$rmodel->getBiendong($lastmonth);
			 $last_rinfoup=$emodel->getEmployerStateById($last_ebd->tang['eid']);
			 $last_rinfodown=$emodel->getEmployerStateById($last_ebd->giam['eid']);
			 
			$request = request();
			$export= $request->export;
		
			if($export){
				return Excel::download(new BaocaoExport, 'tinhhinhsudunglaodong'.date('m-d-Y-His A e').'.xlsx');
				
			} 
			return view('admin.dashboard')
					->with('einfo',$einfo)
					->with('dinfo',$dinfo) 
					->with('last_rinfoup',$last_rinfoup)
					->with('last_rinfodown',$last_rinfodown)
					->with('rinfoup',$rinfoup)
					->with('rinfodown',$rinfodown); 
		  }
        }
		
		return redirect('admin');
    }
	 
	 public function getDashboard(){
		$info = array();
		$info['pcompany']= Db::table('company')->where('public',1)->count();
		$info['upcompany']= Db::table('company')->where('public',2)->count();
		$info['laodong']= Db::table('nguoilaodong')
						->whereIn('nguoilaodong.state', [1,2,3])
						->whereRaw('`id` IN (SELECT MAX(id) AS id FROM `nguoilaodong` GROUP BY `cmnd` )')
						->count();
		$info['tuyendung']= Db::table('tuyendung')->where('state',1)->count();
		$info['report']= Db::table('report')->whereIn('datatable',['nguoilaodong','company','notable'])->count();
		 
		 return $info;
	 }
	 public function auth(Request $request)
    {
        $data = [
					'email' => $request->email,
					'password' => $request->password,
					'public' => 1,
					'level' => [2,1], // level 1 2 for backen user
				];
		Auth::logout();
		$ret = Auth::attempt($data);
		
		if($ret){
			$request->session()->regenerate();
			Session::put('message',"Đăng nhập thành công");
            return redirect('dashboard');
		}else{
			
		return redirect('admin')->withErrors([
					'email' => 'Đăng nhập không thành công'
					]
				);
		}
			
    }
	
	 public function logout()
    {
			Auth::logout();
			return redirect('admin');
    }
}