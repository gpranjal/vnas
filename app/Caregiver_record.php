<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Caregiver_record extends Model {

	protected $table = "vnas_care_giver_calendar";
	protected $dates = [ 'SCHEDULE_START_DTTM', 'SCHEDULE_END_DTTM' ];
	
	public function Caregiver_record()
	{
		return $this->hasMany('App\Caregiver_record');
	}
}
