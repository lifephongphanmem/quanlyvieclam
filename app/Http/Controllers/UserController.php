<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Report;
use Validator;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
	
	  public function show_login () {
		  
		 
		if (Auth::check()) {
			if (Auth::user()->level==3)
			return view('HeThong.dashboard');
          // return redirect('doanhnghieppanel');
        } 
		
		return view('pages.login');
		
	}
	 public function auth(Request $request)
    {
        $data = [
					'email' => $request->email,
					'password' => $request->password,
					'public' => 1,
					'level' => 3, // level 3 for frontend user
				];
		Auth::logout();
		$ret = Auth::attempt($data);
		
		if($ret){
			$request->session()->regenerate();
			$request->session()->flash('message', 'Đăng nhập thành công');
            return redirect('doanhnghieppanel');
		}else{
			
		return redirect('home')->withErrors([
					'message' => 'Đăng nhập không thành công'
					]
				);
		}
			
    }
	
	 public function logout()
    {
			Auth::logout();
			return redirect('home');
    } 
	 public function edit()
	{
		
		$user= Auth::user();

		return view ('pages.user.edit')
					->with('user', $user)
					;
	}
	
	public function update( Request $request)
	{
		$uid= $request->id;
		$user= User::find($uid);
		$validate = $request->validate([
			'name' => 'required|max:255',
			//'email' => 'required|email|max:255|unique:users',						
			
			]);
			
	
		$data['name']= $request->name;
		
		$user->fill($data);
			if($request->password){
			$user->password= Hash::make($request->password);
			}
		
		$result= $user->save();
		// add to log system`
		$rm= new Report();
		$rm->report('update', $result, 'users',$uid,1);
		// navigate
		if($result){
			
			Session::put('message',"Cập nhật thành công");
			return redirect('user-fe/');
		}
		
        else{
			Session::put('message',"Có lỗi xảy ra");
			return redirect('/user-fe/');
		}
		
	}
	
	public function signup( Request $request)
	{
		
		//validate data sign up
		$validate = $request->validate([
				'name' => 'required|max:255',
				'email' => 'required|email|max:255|unique:users',				
				'dkkd' => 'required|max:20|unique:company',				
				'password' => 'required|min:8|confirmed',
				]);
				
	
		
		
		$data = array();
		$data['name']= $request->name;
		$data['ctyname']= $request->ctyname;
		$data['dkkd']= $request->dkkd;
		$data['public']= 1;
		$data['email']= $request->email;
		$data['level']= 3;
		$data['password']= Hash::make($request->password);
		
		// creat user
		
		$user= User::create($data);
		
		
		
		$rm= new Report();
		
		// navigate
		if($user){
				// add to log system`
			$rm->report('add', true , 'users',$user->id,1);	
		// creat company
			$result= DB::table('company')->insertGetId([
				'dkkd' => $request->dkkd,
				'name' => $request->ctyname,
				'user'=>$user->id
			]);
			if ($result) {
				
				$rm->report('add', true , 'company',$result,1);	
			}
			$request->session()->flash('message', 'Đăng ký thành công');
			return redirect('home');
		}
		
    	// add to log system`
			$rm->report('add', false , 'users',$user->id,1);		
			$request->session()->flash('message', 'Đăng ký không thành công');
			return redirect('home');
		
		
	}
	

	
}

?>