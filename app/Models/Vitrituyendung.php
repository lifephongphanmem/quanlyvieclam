<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Vitrituyendung extends Model 

{


	protected $table = 'vitrituyendung';
	
	

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
	
	public function inserts($tdid )
	{	
		$request=request();
		$data=$request->all();
		$qty=$request->quantity;
		
		
		for($i=0;$i<$qty;$i++){
			
			
			$tmp= array();
			
			foreach ($data as $key => $value) {
				if(isset($value[$i])){
					$tmp[$key]=$value[$i];
					};
				
			}
			
			
			$tmp['idtuyendung']= $tdid;
			
			$td = new Vitrituyendung;
			$td->fill($tmp);
			$td->save();
			
		}
			
	}
	
	public function getVitris($tdid)
	{
		 return $vts =Vitrituyendung::select('name','soluong','description')
						->where('idtuyendung',$tdid)
						->get();
		
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
	
	
	
}
