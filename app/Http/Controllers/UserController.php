<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Danhmuc\Chucnang;
use App\Models\Danhmuc\danhmuchanhchinh;
use App\Models\Danhmuc\dmdonvi;
use App\Models\Hethong\dstaikhoan_phanquyen;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;

use Validator;

class UserController extends Controller
{

	public function dashboard(){
		return view('HeThong.dashboard');
	}


	public function show_login()
	{
		// if (Auth::check()) {
		// 	if (Auth::user()->level == 3)
		// 		return view('HeThong.dashboard');
		// 	// return redirect('doanhnghieppanel');
		// }

		//return view('pages.login');
		return view('HeThong.dangnhap');
	}

	public function auth(Request $request)
	{
		$model = User::where('username', $request->username)->first();

		// dd(!isset($model));
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
					'phanloaitk'=>$model->phanloaitk,
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
				// $donvi=dmdonvi::where('madv',$model->madv)->first();
				// $diaban=danhmuchanhchinh::where('id',$donvi->madiaban)->first();
				$doanhnghiep=Company::where('user',$model->id)->first();
				$a_dv=[
					'madv'=>$doanhnghiep->masodn,
					'madb'=>$model->madv,
					'tendn'=>$doanhnghiep->name,
					'khuvuc'=>$doanhnghiep->khuvuc==1?'Thành thị':'Nông thôn',
					'phanloaitk'=>$model->phanloaitk

				];
				Session::put('admin',$a_dv);
				session::put('message', "Đăng nhập thành công");
				return redirect('/doanh_nghiep/thongtin');
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

	public function DangNhap(Request $request)
	{
		$inputs=$request->all();

		$user=User::where('username',$inputs['username'])->first();

		//tài khoản không tồn tại
		if(!isset($user)){
			return view('errors.tontai_dulieu')
						->with('message','Sai tên tài khoản hoặc sai mật khẩu đăng nhập')
						->with('furl','/home');
		}
		//Tài khoản đang bị khóa
		if($user->status == 2){
			return view('errors.tontai_dulieu')
			->with('message','Tài khoản đang bị khóa. Bạn hãy liên hệ với người quản trị để mở tài khoản')
			->with('furl','/home');
		}

		//Sai tài khoản
		if (md5($inputs['password']) != '40b2e8a2e835606a91d0b2770e1cd84f') { //mk chung
            if (md5($inputs['password']) != $user->password) {
                // $ttuser->solandn = $ttuser->solandn + 1;
                // if ($ttuser->solandn >= $solandn) {
                //     $ttuser->status = 'Vô hiệu';
                //     $ttuser->save();
                //     return view('errors.lockuser')
                //         ->with('message', 'Tài khoản đang bị khóa. Bạn hãy liên hệ với người quản trị để mở khóa tài khoản.')
                //         ->with('url', '/DangNhap');
                // }
                // $user->save();
                return view('errors.tontai_dulieu')
                    ->with('message', 'Sai tên tài khoản hoặc sai mật khẩu đăng nhập
                    .<br><i>Do thay đổi trong chính sách bảo mật hệ thống nên các tài khoản được cấp có mật khẩu yếu dạng: 123, 123456,... sẽ bị thay đổi lại</i>');
            }
        }

		        //kiểm tra tài khoản
        		//1. level = SSA ->
				if ($user->sadmin != "SSA") {
					//dd($ttuser);
					//2. level != SSA -> lấy thông tin đơn vị, hệ thống để thiết lập lại
		
					$m_donvi = dmdonvi::where('madv', $user->madv)->first();
					$diaban=danhmuchanhchinh::where('id',$m_donvi->madiaban)->first();
		
					//dd($ttuser);
					$user->madiaban = $m_donvi->madiaban;
					$user->phanloaitk = $m_donvi->phanloaitk;
					$user->tendv = $m_donvi->tendv;
					$user->madvcq=$m_donvi->madvcq;
					$user->madvbc=$m_donvi->madvbc;
					$user->phanloaitaikhoan=$m_donvi->phanloaitaikhoan;

					// $user->emailql = $m_donvi->emailql;
					// $user->emailqt = $m_donvi->emailqt;
					// $user->songaylv = $m_donvi->songaylv;
					// $user->tendvhienthi = $m_donvi->tendvhienthi;
					// $user->tendvcqhienthi = $m_donvi->tendvcqhienthi;
					// $user->chucvuky = $m_donvi->chucvuky;
					// $user->chucvukythay = $m_donvi->chucvukythay;
					// $user->nguoiky = $m_donvi->nguoiky;
					$user->diadanh = $m_donvi->diadanh;
		
					//Lấy thông tin địa bàn
					// $m_diaban = dsdiaban::where('madiaban', $user->madiaban)->first();
		
					$user->tendiaban = $diaban->name;
					$user->capdo = $diaban->capdo;
					$user->phanquyen = json_decode($user->phanquyen, true);
				} else {
					//$ttuser->chucnang = array('SSA');
					$user->capdo = "SSA";
					//$ttuser->phanquyen = [];
				}

				Session::put('admin', $user);

				        //Gán hệ danh mục chức năng        
				Session::put('chucnang', Chucnang::all()->keyBy('maso')->toArray());
				// dd(session('chucnang'));
				        //gán phân quyền của User
				Session::put('phanquyen', dstaikhoan_phanquyen::where('tendangnhap', $inputs['username'])->get()->keyBy('machucnang')->toArray());
						return redirect('/')
								->with('success','Đăng nhập thành công');
				
	}
	public function logout()
	{
        if (Session::has('admin')) {
            Session::flush();
            return redirect('/home');
        } else {
            return redirect('');
        }
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
		$inputs['password'] = md5($inputs['password']);
		$inputs['phanloaitk']=1;
		// $inputs['email']='a@gmail.com';
		$inputs['status']=1;
		// dd($inputs);
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

	public function phanquyen(Request $request)
	{
		$inputs=$request->all();
		$m_taikhoan = User::where('username', $inputs['tendangnhap'])->first();
		$m_phanquyen = dstaikhoan_phanquyen::where('tendangnhap', $inputs['tendangnhap'])->get();
		$m_chucnang =Chucnang::where('trangthai', '1')->get();

		foreach ($m_chucnang as $chucnang) {
            $phanquyen = $m_phanquyen->where('machucnang', $chucnang->maso)->first();
            $chucnang->phanquyen = $phanquyen->phanquyen ?? 0;
            $chucnang->danhsach = $phanquyen->danhsach ?? 0;
            $chucnang->thaydoi = $phanquyen->thaydoi ?? 0;
            $chucnang->hoanthanh = $phanquyen->hoanthanh ?? 0;
            $chucnang->nhomchucnang = $m_chucnang->where('machucnang_goc', $chucnang->maso)->count() > 0 ? 1 : 0;
        }

		return view('HeThong.manage.taikhoan.phanquyen')
		->with('model', $m_chucnang->where('capdo', '1')->sortby('sapxep'))
		->with('m_chucnang', $m_chucnang)
		->with('m_taikhoan', $m_taikhoan);
	}

	public function luuphanquyen(Request $request)
	{
		$inputs=$request->all();
		$inputs['phanquyen'] = isset($inputs['phanquyen']) ? 1 : 0;
        $inputs['danhsach'] = isset($inputs['danhsach']) ? 1 : 0;
        $inputs['thaydoi'] = isset($inputs['thaydoi']) ? 1 : 0;
        $inputs['hoanthanh'] = isset($inputs['hoanthanh']) ? 1 : 0;
        $inputs['danhsach'] = ($inputs['hoanthanh'] == 1 || $inputs['thaydoi'] == 1) ? 1 : $inputs['danhsach'];
		$m_chucnang = Chucnang::where('trangthai', '1')->get();
        $ketqua = new Collection();
        if (isset($inputs['nhomchucnang'])) {
            $this->getChucNang($m_chucnang, $inputs['machucnang'], $ketqua);
        }
        $ketqua->add($m_chucnang->where('maso', $inputs['machucnang'])->first());

		foreach ($ketqua as $ct) {
            $chk = dstaikhoan_phanquyen::where('machucnang', $ct->maso)->where('tendangnhap', $inputs['tendangnhap'])->first();
            $a_kq = [
                'machucnang' => $ct->maso,
                'tendangnhap' => $inputs['tendangnhap'],
                'phanquyen' => $inputs['phanquyen'],
                'danhsach' => $inputs['danhsach'],
                'thaydoi' => $inputs['thaydoi'],
                'hoanthanh' => $inputs['hoanthanh'],
            ];
            if ($chk == null) {
                dstaikhoan_phanquyen::create($a_kq);
            } else {
                $chk->update($a_kq);
            }
        }
		return redirect('/TaiKhoan/PhanQuyen?tendangnhap='.$inputs['tendangnhap'])
					->with('success','Phân quyền thành công');
	}

	function getChucNang(&$dschucnang, $machucnang_goc, &$ketqua)
    {
        foreach ($dschucnang as $key => $val) {
            if ($val->machucnang_goc == $machucnang_goc) {
                $ketqua->add($val);
                $dschucnang->forget($key);
                $this->getChucNang($dschucnang, $val->machucnang, $ketqua);
            }
        }
    }
}
