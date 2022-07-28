<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employer;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



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
			return view('admin.dashboard')->with('dinfo',$dinfo); 
		  }
        }
		
		return redirect('admin');
    }
	 
	 public function getDashboard(){
		$info = array();
		$info['pcompany']= Db::table('company')->where('public',1)->count();
		$info['upcompany']= Db::table('company')->where('public',2)->count();
		$info['laodong']= Db::table('nguoilaodong')->where('state',1)->count();
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