<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Company extends Model 
{


	protected $table = 'company';
	
	

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
	public $timestamps = false;

}
