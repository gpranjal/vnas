<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Client_record extends Model {

	protected $table = "vnas_client_calendar";
	protected $dates = [ 'SCHEDULE_START_DTTM', 'SCHEDULE_END_DTTM' ];//format("mm/dd/yyyy");
	
	public function Caregiver_record()
	{
		return $this->hasMany('App\Client_record');
	}
}
