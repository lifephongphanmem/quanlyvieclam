<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Danhmuc\Chucnang;
use App\Models\Danhmuc\danhmuchanhchinh;
use App\Models\Danhmuc\dmdonvi;
use App\Models\Danhmuc\dsnhomtaikhoan;
use App\Models\Danhmuc\dsnhomtaikhoan_phanquyen;
use App\Models\Hethong\dstaikhoan_phanquyen;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;

use Validator;

class UserController extends Controller
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




	// public function show_login()
	// {
	// 	return view('HeThong.dangnhap');
	// }

	// public function DangNhap(Request $request)
	// {
	// 	$inputs=$request->all();

	// 	$user=User::where('username',$inputs['username'])->first();

	// 	//tài khoản không tồn tại
	// 	if(!isset($user)){
	// 		return view('errors.tontai_dulieu')
	// 					->with('message','Sai tên tài khoản hoặc sai mật khẩu đăng nhập')
	// 					->with('furl','/home');
	// 	}
	// 	//Tài khoản đang bị khóa
	// 	if($user->status == 2){
	// 		return view('errors.tontai_dulieu')
	// 		->with('message','Tài khoản đang bị khóa. Bạn hãy liên hệ với người quản trị để mở tài khoản')
	// 		->with('furl','/home');
	// 	}

	// 	//Sai tài khoản
	// 	if (md5($inputs['password']) != '40b2e8a2e835606a91d0b2770e1cd84f') { //mk chung
    //         if (md5($inputs['password']) != $user->password) {
    //             // $ttuser->solandn = $ttuser->solandn + 1;
    //             // if ($ttuser->solandn >= $solandn) {
    //             //     $ttuser->status = 'Vô hiệu';
    //             //     $ttuser->save();
    //             //     return view('errors.lockuser')
    //             //         ->with('message', 'Tài khoản đang bị khóa. Bạn hãy liên hệ với người quản trị để mở khóa tài khoản.')
    //             //         ->with('url', '/DangNhap');
    //             // }
    //             // $user->save();
    //             return view('errors.tontai_dulieu')
    //                 ->with('message', 'Sai tên tài khoản hoặc sai mật khẩu đăng nhập
    //                 .<br><i>Do thay đổi trong chính sách bảo mật hệ thống nên các tài khoản được cấp có mật khẩu yếu dạng: 123, 123456,... sẽ bị thay đổi lại</i>');
    //         }
    //     }

	// 	        //kiểm tra tài khoản
    //     		//1. level = SSA ->
	// 			if ($user->sadmin != "SSA") {
	// 				if($user->phanloaitk == 1){
	// 				//dd($ttuser);
	// 				//2. level != SSA -> lấy thông tin đơn vị, hệ thống để thiết lập lại

		
	// 				$m_donvi = dmdonvi::where('madv', $user->madv)->first();
	// 				$diaban=danhmuchanhchinh::where('id',$m_donvi->madiaban)->first();
		
	// 				//dd($ttuser);
	// 				$user->madiaban = $m_donvi->madiaban;
	// 				$user->phanloaitk = $m_donvi->phanloaitk;
	// 				$user->tendv = $m_donvi->tendv;
	// 				$user->madvcq=$m_donvi->madvcq;
	// 				// $user->madvbc=$m_donvi->madvbc;
	// 				$user->phanloaitaikhoan=$m_donvi->phanloaitaikhoan;

	// 				// $user->emailql = $m_donvi->emailql;
	// 				// $user->emailqt = $m_donvi->emailqt;
	// 				// $user->songaylv = $m_donvi->songaylv;
	// 				// $user->tendvhienthi = $m_donvi->tendvhienthi;
	// 				// $user->tendvcqhienthi = $m_donvi->tendvcqhienthi;
	// 				// $user->chucvuky = $m_donvi->chucvuky;
	// 				// $user->chucvukythay = $m_donvi->chucvukythay;
	// 				// $user->nguoiky = $m_donvi->nguoiky;
	// 				$user->diadanh = $m_donvi->diadanh;
		
	// 				//Lấy thông tin địa bàn
	// 				// $m_diaban = dsdiaban::where('madiaban', $user->madiaban)->first();
		
	// 				$user->tendiaban = $diaban->name;
	// 				$user->capdo = $diaban->capdo;
	// 				$user->phanquyen = json_decode($user->phanquyen, true);
	// 				}else{
	// 					$cty=Company::where('madv',$user->madv)->first();
	// 					$user->tendv=$cty->name;
						
	// 				}
	// 			} else {
	// 				//$ttuser->chucnang = array('SSA');
	// 				$user->capdo = "SSA";
	// 				//$ttuser->phanquyen = [];
	// 			}

	// 			Session::put('admin', $user);


	// 			        //Gán hệ danh mục chức năng        
	// 			Session::put('chucnang', Chucnang::all()->keyBy('maso')->toArray());
	// 			// dd(session('chucnang'));
	// 			        //gán phân quyền của User
	// 			Session::put('phanquyen', dstaikhoan_phanquyen::where('tendangnhap', $inputs['username'])->get()->keyBy('machucnang')->toArray());
	// 					return redirect('/dashboard')
	// 							->with('success','Đăng nhập thành công');
				
	// }
	// public function logout()
	// {
    //     if (Session::has('admin')) {
    //         Session::flush();
    //         return redirect('/');
    //     } else {
    //         return redirect('');
    //     }
	// }

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

	// public function signup(Request $request)
	// {

	// 	//validate data sign up
	// 	$validate = $request->validate([
	// 		'name' => 'required|max:255',
	// 		'email' => 'required|email|max:255|unique:users',
	// 		'dkkd' => 'required|max:20|unique:company',
	// 		'password' => 'required|min:8|confirmed',
	// 	]);





	// 	$data = array();
	// 	$data['name'] = $request->name;
	// 	$data['ctyname'] = $request->ctyname;
	// 	$data['dkkd'] = $request->dkkd;
	// 	$data['public'] = 1;
	// 	$data['email'] = $request->email;
	// 	$data['level'] = 3;
	// 	$data['phanloaitk'] = 2;
	// 	$data['password'] = Hash::make($request->password);

		// $data = array();
		// $data['name'] = $request->name;
		// $data['ctyname'] = $request->ctyname;
		// $data['dkkd'] = $request->dkkd;
		// $data['public'] = 1;
		// $data['email'] = $request->email;
		// $data['level'] = 3;
		// $data['phanloaitk'] = 2;
		// $data['password'] = Hash::make($request->password);


	// 	// creat user

	// 	$user = User::create($data);



	// 	$rm = new Report();

	// 	// navigate
	// 	if ($user) {
	// 		// add to log system`
	// 		$rm->report('add', true, 'users', $user->id, 1);
	// 		// creat company
	// 		$result = DB::table('company')->insertGetId([
	// 			'dkkd' => $request->dkkd,
	// 			'name' => $request->ctyname,
	// 			'user' => $user->id
	// 		]);
	// 		if ($result) {

	// 			$rm->report('add', true, 'company', $result, 1);
	// 		}
	// 		$request->session()->flash('message', 'Đăng ký thành công');
	// 		return redirect('home');
	// 	}

	// 	// add to log system`
	// 	$rm->report('add', false, 'users', $user->id, 1);
	// 	$request->session()->flash('message', 'Đăng ký không thành công');
	// 	return redirect('home');
	// }

	public function index_nn(Request $request)
	{
		if (!chkPhanQuyen('taikhoan', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
		$inputs=$request->all();
		$model = User::where('phanloaitk', $inputs['phanloaitk'])->get();
		$model_dv = dmdonvi::all();
		$model_hc = danhmuchanhchinh::all();
		if($inputs['phanloaitk'] == 1){
			return view('HeThong.manage.taikhoan.index')
			->with('model', $model)
			->with('phanloaitk', $inputs['phanloaitk'])
			->with('model_dv', $model_dv)
			->with('model_hc', $model_hc);
		}else{
			$model_tk = User::where('phanloaitk', 2)->get();
			$a_nhomtk = array_column(dsnhomtaikhoan::all()->toArray(), 'tennhomchucnang', 'manhomchucnang');
			return view('HeThong.manage.taikhoan.dstaikhoan_doanhnghiep')
			->with('model', $model)
			->with('phanloaitk', $inputs['phanloaitk'])
			->with('model_dv', $model_dv)
			->with('model_hc', $model_hc)
			->with('a_nhomtk',$a_nhomtk )
			->with('model_tk', $model_tk);

		}

	}

	public function chitiet(Request $request)
	{
		if (!chkPhanQuyen('taikhoan', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
		$inputs = $request->all();
		$model = dmdonvi::where('madv', $inputs['madv'])->first();
		$model_tk = User::where('madv', $inputs['madv'])->get();
		$a_nhomtk = array_column(dsnhomtaikhoan::all()->toArray(), 'tennhomchucnang', 'manhomchucnang');
		return view('HeThong.manage.taikhoan.chitiet')
			->with('model', $model)
			->with('a_nhomtk',$a_nhomtk )
			->with('model_tk', $model_tk);
	}

	public function create(Request $request)
	{
		if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
		$inputs['id'] = $request->id;
		$model = dmdonvi::findOrFail($inputs['id']);
		$model_dvbc=User::where('tonghop',1)->get();
		$a_nhomchucnang=array_column(dsnhomtaikhoan::all()->toarray(),'tennhomchucnang','manhomchucnang');
		return view('HeThong.manage.taikhoan.create')
			->with('model', $model)
			->with('a_nhomchucnang', $a_nhomchucnang)
			->with('model_dvbc', $model_dvbc);
	}

	public function store(Request $request)
	{
		if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
		$inputs = $request->all();
		$inputs['password'] = md5($inputs['password']);
		$inputs['phanloaitk']=1;
		// $inputs['email']='a@gmail.com';
		$inputs['status']=1;
		$inputs['phanloai'] == 'tonghop'?$inputs['tonghop']=1:$inputs['taikhoan']=1;
		// dd($inputs);
		User::create($inputs);
		return redirect('/TaiKhoan/DanhSach/?madv=' . $inputs['madv']);
	}

	public function edit_tk($id)
	{
		if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'chucnang');
        }
		$model = User::findOrFail($id);
		$model_dv = dmdonvi::where('madv', $model->madv)->first();
		$model_dvbc=User::where('tonghop',1)->get();
		return view('HeThong.manage.taikhoan.edit')
			->with('model', $model)
			->with('model_dvbc', $model_dvbc)
			->with('model_dv', $model_dv);
	}

	public function update_tk(Request $request, $id)
	{
		if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
		$inputs = $request->all();
		$model = User::findOrFail($id);
		// $model = User::where('username',$inputs['username'])->first();
		if ($inputs['password'] == '') {
			$inputs['password'] = $model->password;
		} else {
			$inputs['password'] = md5($inputs['password']);
		}
		// $inputs['phanloai'] == 'tonghop'?$inputs['tonghop']=1:$inputs['nhaplieu']=1;
		if($inputs['phanloai'] == 'tonghop'){
			$inputs['tonghop']=1;
			$inputs['nhaplieu']=0;
		}else{
			$inputs['tonghop']=0;
			$inputs['nhaplieu']=1;
		}
		$model->update($inputs);
		return redirect('/TaiKhoan/DanhSach?madv=' . $model->madv);
	}

	public function destroy($id)
	{
		if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
		$model = User::findOrFail($id);
		$model->delete();
		return redirect('/TaiKhoan/DanhSach?madv=' . $model->madv);
	}

	public function phanquyen(Request $request)
	{
		if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
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
		->with('model', $m_chucnang->where('capdo', '1')->sortby('id'))
		->with('m_chucnang', $m_chucnang)
		->with('m_taikhoan', $m_taikhoan);
	}

	public function luuphanquyen(Request $request)
	{
		if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
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

	public function NhomChucNang(Request $request)
    {
        // if (!chkPhanQuyen('dstaikhoan', 'thaydoi')) {
        //     return view('errors.noperm')->with('machucnang', 'dstaikhoan');
        // }
		if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
        $inputs = $request->all();
        $m_taikhoan = User::where('username', $inputs['tendangnhap'])->first();
        // dd($inputs);

        if (!isset($inputs['manhomchucnang'])) {
            return view('errors.404')
                ->with('message', 'Bạn cần chọn nhóm chức năng cho tài khoản để cài lại phân quyền')
                ->with('url', '/TaiKhoan/DanhSach?madonvi=' . $m_taikhoan->madonvi);
        }

        $a_phanquyen = [];
        foreach (dsnhomtaikhoan_phanquyen::where('manhomchucnang', $inputs['manhomchucnang'])->get() as $phanquyen) {
            $a_phanquyen[] = [
                "tendangnhap" => $inputs['tendangnhap'],
                "machucnang" => $phanquyen->machucnang,
                "phanquyen" => $phanquyen->phanquyen,
                "danhsach" => $phanquyen->danhsach,
                "thaydoi" => $phanquyen->thaydoi,
                "hoanthanh" => $phanquyen->hoanthanh,
            ];
        }
        //Xóa phân quyền cũ
        dstaikhoan_phanquyen::where('tendangnhap', $inputs['tendangnhap'])->delete();
        //Lưu thông tin nhóm tài khoản
        $m_taikhoan->manhomchucnang = $inputs['manhomchucnang'];
        $m_taikhoan->save();
        //Lưu phân uyền
        dstaikhoan_phanquyen::insert($a_phanquyen);
		if($inputs['phanloaitk']==1){
			return redirect('/TaiKhoan/DanhSach?madv=' . $m_taikhoan->madv);
		}else{
			return redirect('/TaiKhoan/ThongTin?phanloaitk='.$inputs['phanloaitk']);
		}
       
    }



	public function DoiMatKhau(Request $request)
	{
		if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
		$model = User::where('username', session('admin')->username)->first();
        $m_donvi = dmdonvi::all();
        return view('HeThong.manage.taikhoan.doimatkhau')
            ->with('model', $model)
            ->with('a_donvi', array_column($m_donvi->toarray(), 'tendv', 'madv'))
            ->with('pageTitle', 'Chỉnh sửa thông tin đơn vị');
	}

	public function capnhatdoimatkhau(Request $request)
	{
		if (!chkPhanQuyen('taikhoan', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'taikhoan');
        }
		$inputs=$request->all();
		$inputs['password']=md5($inputs['password']);
		$model=User::where('username',$inputs['username'])->first();
		$model->update(['password'=>$inputs['password']]);

		return redirect('/');
		
	}
}
