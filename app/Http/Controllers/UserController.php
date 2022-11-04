<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\danhmuchanhchinh;
use App\Models\dmdonvi;
use Illuminate\Http\Request;
use DB;
use Session;
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

	public function show_login()
	{
		if (Auth::check()) {
			if (Auth::user()->level == 3)
				return view('HeThong.dashboard');
			// return redirect('doanhnghieppanel');
		}

		//return view('pages.login');
		return view('HeThong.dangnhap');
	}

	public function auth(Request $request)
	{
		$model = User::where('username', $request->username)->first();
		// dd(!isset($model));
		// dd($model);
		if (!isset($model)) {
			return redirect('home')->withErrors(
				[
					'message' => 'Đăng nhập không thành công'
				]
			);
		}
		if ($model->phanloaitk == 1) {
			$data = [
				'username' => $request->username,
				'password' => $request->password,
				// 'public' => 1,
				'phanloaitk' => 1,
			];
			// dd($data);
			$ret = Auth::attempt($data);
			// dd($ret);
			if ($ret) {
				$donvi=dmdonvi::where('madv',$model->madv)->first();
				$diaban=danhmuchanhchinh::where('id',$donvi->madiaban)->first();
				$a_dv=[
					'madv'=>$donvi->madv,
					'tendv'=>$donvi->tendv,
					'madvcq'=>$donvi->madvcq,
					'madvbc'=>$donvi->madvbc,
					'madb'=>$diaban->madb,
					'tendiaban'=>$diaban->name,
					'level'=>$diaban->level,
					'parent'=>$diaban->parent,
					'maquocgia'=>$diaban->maquocgia,
					'phanloaitaikhoan'=>$donvi->phanloaitaikhoan
				];
				Session::put('admin',$a_dv);
				$request->session()->regenerate();
				$request->session()->flash('message', 'Đăng nhập thành công');
				return redirect('/dmdonvi/danh_sach');
			} else {
				return redirect('home')->withErrors(
					[
						'message' => 'Đăng nhập không thành công'
					]
				);
			}
		} else {
			$data = [
				'username' => $request->username,
				'password' => $request->password,
				'public' => 1,
				// 'level' => [2, 1], // level 1 2 for backen user
				'level'=>3,
				'phanloaitk'=>2
			];
			Auth::logout();
			$ret = Auth::attempt($data);

			if ($ret) {
				$request->session()->regenerate();
				Session::put('message', "Đăng nhập thành công");
				return redirect('/doanhnghiep/thongtin');
			} else {
				return redirect('admin')->withErrors(
					[
						'email' => 'Đăng nhập không thành công'
					]
				);
			}
		}
		// if ($model->level == '3') {
		// 	$data = [
		// 		'email' => $request->email,
		// 		'password' => $request->password,
		// 		'public' => 1,
		// 		'level' => 3,
		// 	];
		// 	$ret = Auth::attempt($data);

		// 	if ($ret) {
		// 		$request->session()->regenerate();
		// 		$request->session()->flash('message', 'Đăng nhập thành công');
		// 		return redirect('/doanhnghiep/thongtin');
		// 	} else {

		// 		return redirect('home')->withErrors(
		// 			[
		// 				'message' => 'Đăng nhập không thành công'
		// 			]
		// 		);
		// 	}
		// } else {

		// 	$data = [
		// 		'email' => $request->email,
		// 		'password' => $request->password,
		// 		'public' => 1,
		// 		'level' => [2, 1], // level 1 2 for backen user
		// 	];
		// 	Auth::logout();
		// 	$ret = Auth::attempt($data);

		// 	if ($ret) {
		// 		$request->session()->regenerate();
		// 		Session::put('message', "Đăng nhập thành công");
		// 		return redirect('dashboard');
		// 	} else {

		// 		return redirect('admin')->withErrors(
		// 			[
		// 				'email' => 'Đăng nhập không thành công'
		// 			]
		// 		);
		// 	}
		// }
	}

	public function logout()
	{
		Auth::logout();
		return redirect('home');
	}
	public function edit()
	{

		$user = Auth::user();

		return view('pages.user.edit')
			->with('user', $user);
	}

	public function update(Request $request)
	{
		$uid = $request->id;
		$user = User::find($uid);
		$validate = $request->validate([
			'name' => 'required|max:255',
			//'email' => 'required|email|max:255|unique:users',						

		]);


		$data['name'] = $request->name;

		$user->fill($data);
		if ($request->password) {
			$user->password = Hash::make($request->password);
		}

		$result = $user->save();
		// add to log system`
		$rm = new Report();
		$rm->report('update', $result, 'users', $uid, 1);
		// navigate
		if ($result) {

			Session::put('message', "Cập nhật thành công");
			return redirect('user-fe/');
		} else {
			Session::put('message', "Có lỗi xảy ra");
			return redirect('/user-fe/');
		}
	}

	public function signup(Request $request)
	{

		//validate data sign up
		$validate = $request->validate([
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'dkkd' => 'required|max:20|unique:company',
			'password' => 'required|min:8|confirmed',
		]);




		$data = array();
		$data['name'] = $request->name;
		$data['ctyname'] = $request->ctyname;
		$data['dkkd'] = $request->dkkd;
		$data['public'] = 1;
		$data['email'] = $request->email;
		$data['level'] = 3;
		$data['phanloaitk'] = 2;
		$data['password'] = Hash::make($request->password);

		// creat user

		$user = User::create($data);



		$rm = new Report();

		// navigate
		if ($user) {
			// add to log system`
			$rm->report('add', true, 'users', $user->id, 1);
			// creat company
			$result = DB::table('company')->insertGetId([
				'dkkd' => $request->dkkd,
				'name' => $request->ctyname,
				'user' => $user->id
			]);
			if ($result) {

				$rm->report('add', true, 'company', $result, 1);
			}
			$request->session()->flash('message', 'Đăng ký thành công');
			return redirect('home');
		}

		// add to log system`
		$rm->report('add', false, 'users', $user->id, 1);
		$request->session()->flash('message', 'Đăng ký không thành công');
		return redirect('home');
	}

	public function index_nn()
	{
		$model = User::where('phanloaitk', 1)->get();
		$model_dv = dmdonvi::all();
		$model_hc = danhmuchanhchinh::all();
		return view('HeThong.manage.taikhoan.index')
			->with('model', $model)
			->with('model_dv', $model_dv)
			->with('model_hc', $model_hc);
	}

	public function chitiet(Request $request)
	{
		$inputs = $request->all();
		$model = dmdonvi::where('madv', $inputs['madv'])->first();
		$model_tk = User::where('madv', $inputs['madv'])->get();
		return view('HeThong.manage.taikhoan.chitiet')
			->with('model', $model)
			->with('model_tk', $model_tk);
	}

	public function create(Request $request)
	{
		$inputs['id'] = $request->id;
		$model = dmdonvi::findOrFail($inputs['id']);
		return view('HeThong.manage.taikhoan.create')
			->with('model', $model);
	}

	public function store(Request $request)
	{
		$inputs = $request->all();
		$inputs['password'] = Hash::make($inputs['password']);
		User::create($inputs);
		return redirect('/TaiKhoan/DanhSach/?madv=' . $inputs['madv']);
	}

	public function edit_tk($id)
	{
		$model = User::findOrFail($id);
		$model_dv = dmdonvi::where('madv', $model->madv)->first();
		return view('HeThong.manage.taikhoan.edit')
			->with('model', $model)
			->with('model_dv', $model_dv);
	}

	public function update_tk(Request $request, $id)
	{
		$inputs = $request->all();
		$model = User::findOrFail($id);
		if ($inputs['password'] == '') {
			$inputs['password'] = $model->password;
		} else {
			$inputs['password'] = Hash::make($inputs['password']);
		}
		$model->update($inputs);
		return redirect('/TaiKhoan/DanhSach?madv=' . $model->madv);
	}

	public function destroy($id)
	{
		$model = User::findOrFail($id);
		$model->delete();
		return redirect('/TaiKhoan/DanhSach?madv=' . $model->madv);
	}
}
