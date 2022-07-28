<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Report extends Model 
{


	protected $table = 'report';
	
	

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'result', 'datatable','lastid','numrow','user','note','iprequest'
    ];

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
	public $timestamps = false;
	
	public function getReports($uid,$time_filter){
		
		switch ($time_filter){
			
			case '1': 
				$dateS = Carbon::now()->startOfMonth();
				$dateE = Carbon::now()->addHour(7); 
				break;
			case '2': 
				$dateS = Carbon::now()->startOfMonth()->subMonth(1);
				$dateE = Carbon::now()->startOfMonth(); 
				break;
			default:  
				$dateS = Carbon::now()->startOfYear();
				$dateE = Carbon::now() ->addHour(7); 
				break;
			
		}
		$request = request();
		
		$reports = Report::whereBetween("time",[$dateS,$dateE] )
			->where('user',$uid)
			->whereNotIn('type', ['tuyendung','dangkydichvu','login'])
			->orderBy('time','desc')
			->paginate(20);

		return $reports;
	}
	
	public function report($type,$result,$tbl,$rowid,$num,$note=null ){
		// write report 
		$r = array();
		$r['type']= $type;
		$r['result']= $result;
		$r['datatable']= $tbl;	
		$r['lastid']= $rowid;	
		$r['numrow']= $num;	
		$r['note']= $note;	
		$request = request();
		$r['iprequest']= $request->ip(); 
		
		if ( Auth::check()) {
			$r['user']= Auth::user()->id;	
		}else{
		
			$r['user']= 0;	
		}
		$report= $this->create($r);
	}
}
