<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Etl_process_log extends Model {

	protected $table = "ETL_PROCESS_LOG";
	protected $dates = [ 'START_DT','END_DT','CREATED_DATE' ];

	
	public function Etl_process_log()
	{
		return $this->hasMany('App\Etl_process_log');
	}
}
