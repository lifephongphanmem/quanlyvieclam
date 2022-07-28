<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Report;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class Employer extends Model 

{


	protected $table = 'nguoilaodong';
	
	

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  //  protected $fillable = ['*'];
		protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
	public $timestamps = true;
	
	public function getEmployersExport()
	{ 
	  $request= request();
	  
	  $uid = $request->user()->id;
	  $cid= DB::table('company')->select('id')->where('user',$uid)->first();

	  $lds= Employer::select("hoten","gioitinh","ngaysinh","cmnd","dantoc","nation","tinh","huyen","xa","address","sobaohiem","trinhdogiaoduc","trinhdocmkt","nghenghiep","linhvucdaotao","loaihdld","bdhopdong","kthopdong","luong","pcchucvu","pcthamnien","pcthamniennghe","pcluong","pcbosung","bddochai","ktdochai","vitri","chucvu","bdbhxh","ktbhxh","luongbhxh","ghichu","created_at","updated_at", "state","fromttdvvl")
						->where('state','<',3)
						->where('company', $cid->id)
						->get();
		
	 $parramfields= ["trinhdogiaoduc","trinhdocmkt","nghenghiep","linhvucdaotao","loaihdld"];	
	 
		foreach($lds as $ld){
			
			foreach ($parramfields as $key=>$field){
				
				$pid=$ld->$field;
				$pname= DB::table('param')->select('name')->where('id',$pid)->first();
				if($pname){$ld->$field = $pname->name;};

			}
			
		}
		;


		return $lds;
	}
	public function update_info( )
	{	
		$request=request();
		$eid= $request->id;
		$ld=Employer::find($eid);
		
		//$validate = $request->validate([			
		//		'dkkd' => 'required|max:255|unique:company',				
		//				]);
			
		$data = $request->all();
		
		$ld->fill($data);
		
		$dirty=$ld->getDirty();
		$sqty=count($dirty);
		
		$danhsach= array();
		
		foreach ($dirty as $field => $newdata)
        {
          $olddata = $ld->getOriginal($field);
          if ($olddata != $newdata)
          {
           $danhsach[]=$field. " thay đổi từ ".$olddata." sang ".$newdata;
          }
        }
		
		if($sqty>0) {
			$ld->save();
			$result= 1;
			// add to log system`
				$rm= new Report();
				
				$note= $request->note.' . '.$sqty." mục thay đổi  ." . implode($danhsach, " . ");
				
				
				$rm->report('updateinfo', $result, 'nguoilaodong',$eid,1, $note);
				
			
			} else{ 
			$result = 0;
			};
		
		
		return redirect('report-fa')->with('message', $sqty.' thông tin lưu thành công! ');
		
		
	}
	
	
	 public function update_state( $eid, $state,$note)
	{
		$ld=Employer::find($eid);
		$olddata=$ld->state;
		
		if($olddata==$state){			
			return redirect('report-fa')->withErrors(['message'=>"Cập nhật ko thành công"]);
		};
		$ld->state= $state;
		
		$result=$ld->save();
		// add to log system`
	
		switch ($state){
			case 2 : 
				$updateinfo = "tamdung" ;					
				break;
			case 1 : 
				$updateinfo = "kethuctamdung";					
				break;
			case 3 : 
				$updateinfo = "baogiam";				
				break;
			
		};
		 
		
		$rm= new Report();
		$rm->report( $updateinfo , $result, 'nguoilaodong',$eid,1,$note);
		if($result){
			return redirect('report-fa')->with('message',"Cập nhật thành công");
		}else{
			return redirect('report-fa')->withErrors(['message'=>"Cập nhật ko thành công"]);
		}
		
	}
	public function getQuymo($cid){
	
		$q = Employer::where('company', $cid)
							->where('state', '<', 3)
							->count();
		 return $q;
		
	}
	public function getTonghop($cid){
		$info= array();
		$info['slld']= Employer::where('company', $cid)
							->where('state', '<', 3)
							->count();
		$info['trongtinh']=  Employer::where('company', $cid)
							->where('state', '<', 3)
							->where('tinh', 'Quảng Bình')
							->count();				
		$info['tructiep']= $info['slld'];//// chua ro khai niem
		
		$info['nu']=  Employer::where('company', $cid)
							->where('state', '<', 3)
							->where('gioitinh','like','nu')
							->count();	
		
		$info['nudakyhd']=  Employer::where('company', $cid)
							->where('state', '<', 3)
							->where('gioitinh','like', 'nu')
							->whereNotIn('bdhopdong', [null])
							->count();	
		$info['dakyhd']=  Employer::where('company', $cid)
							->where('state', '<', 3)
							->whereNotIn('bdhopdong', [null])
							->count();	
		$info['nuocngoai']=  Employer::where('company', $cid)
							->where('state', '<', 3)
							->whereNotIn('nation', ['VN','vn','Việt Nam'])
							->count();	
		$info['nunuocngoai']=  Employer::where('company', $cid)
							->where('state', '<', 3)
							->where('gioitinh','like', 'nu')
							->whereNotIn('nation', ['VN','vn','Việt Nam'])
							->count();	
		$info['tnpt']=  Employer::where('company', $cid)
							->where('state', '<', 3)
							->where('trinhdogiaoduc',"Tốt nghiệp THPT trở lên") // 65 Tot nghiep THPT
							->count();	
		
		$info['maxluong']=	Employer::where('company', $cid)
							->where('state', '<', 3)
							->max('luong');		
		$info['minluong']=	Employer::where('company', $cid)
							->where('state', '<', 3)
							->min('luong');	
		$info['avgluong']=	Employer::where('company', $cid)
							->where('state', '<', 3)
							->avg('luong');	
		Return $info;
		
	}
	public function getPhanbo($cid,$ptype){
		
		$params= DB::table('param')->where('type',$ptype)->get();
		$pb= array();
		$colname="hoten";
		switch ($ptype) {
			case 3 : $colname="trinhdocmkt"; break;
			case 4 : $colname="trinhdogiaoduc"; break;
			case 9 : $colname="nghenghiep"; break;
			case 11 : $colname="linhvucdaotao"; break;
			
		}
		foreach( $params as $p) {
			$pb[$p->name]= Employer::where('company', $cid)
							->where('state', '<', 3)
							->where($colname, $p->name) // 65 Tot nghiep THPT
							->count();	
		};
		
		return $pb;
		
	}
	
	public function import($cid )
	{	
		
		$request= request();
		// Get the csv rows as an array
		$file= $request->file('import_file');
		$dataObj = new \stdClass();
		$theArray = Excel::toArray($dataObj,$file );
		$arr=$theArray[0];
		// check file excel
		
		$lds = array();
		$nfield= 34;
		for ($i = 1; $i < count($arr); $i++){
			
		$data = array();
			for ($j = 0; $j < $nfield; $j++){
				
				$data[$arr[0][$j]]= $arr[$i][$j];
				
			}
			// check data
		if(!$data['hoten']){ break;};
		$data['cmnd']=str_replace('\'','',$data['cmnd']);	
		
		if(!$this->checkCmndExits($data['cmnd']))
		{	
			$data['company']= $cid;
			
			$unix_date = ($data['ngaysinh'] - 25569) * 86400;
			
			$data['ngaysinh']= date('Y-m-d',$unix_date);
			if(!$data['state']){$data['state']=1;}
			
			if ($data['bdbhxh']){
		
			$unix_date = ($data['bdbhxh'] - 25569) * 86400;
			
			$data['bdbhxh']= date('Y-m-d',$unix_date);
				
			}
			if ($data['bdhopdong']){
			
			$unix_date = ($data['bdhopdong'] - 25569) * 86400;
			
			$data['bdhopdong']= date('Y-m-d',$unix_date);
				
			}
			if ($data['bddochai']){
			
			$unix_date = ($data['bddochai'] - 25569) * 86400;
			
			$data['bddochai']= date('Y-m-d',$unix_date);
				
			}
			if ($data['ktdochai']){
			
			$unix_date = ($data['ktdochai'] - 25569) * 86400;
			
			$data['ktdochai']= date('Y-m-d',$unix_date);
				
			}
			if ($data['kthopdong']){
			
			$unix_date = ($data['kthopdong'] - 25569) * 86400;
			
			$data['kthopdong']= date('Y-m-d',$unix_date);
				
			}
			if ($data['ktbhxh']){
			
			$unix_date = ($data['ktbhxh'] - 25569) * 86400;
			
			$data['ktbhxh']= date('Y-m-d',$unix_date);
				
			}
			$lds[]=	$data;
		}
		
		}
	$num_valid_ld= count($lds);
	if($num_valid_ld){
		$result= DB::table('nguoilaodong')->insert($lds);

		// add to log system`
		$rm= new Report();
		$rm->report('import', $result, 'nguoilaodong',DB::getPdo()->lastInsertId(),$num_valid_ld);
		return $result;
	 }
		// navigate
	return $num_valid_ld;
	}
	
	public function checkCmndExits($cmnd){
		
    	$result= DB::table('nguoilaodong')->select('id')->where('cmnd',$cmnd)->whereNotIn('state',[3])->get()->first();
		if($result)
		{return $result->id ;}else{
			
			return 0 ;
		}
	}
	
	
}
