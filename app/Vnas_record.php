<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vnas_record extends Model {

	protected $table = "VNAS_CALENDAR";

	/*
    protected $fillable = [
        'patient_id',
        'patient_fname',
        'patient_lname',
        'patient_email',
        'patient_phone',
        'patient_address',
        'caregiver_id',
        'caregiver_role',
        'caregiver_fname',
        'caregiver_lname',
        'caregiver_email',
        'caregiver_phone',
        'caregiver_mob',
        'ap_title',
        'ap_date',
        'ap_time',
        'ap_lov',
        'ap_comments',

    ];
	*/
	
    protected $dates = [ 'SCHEDULE_START_DTTM', 'SCHEDULE_END_DTTM' ];

    public function Vnas_record()
    {
        return $this->hasOne('App\Vnas_record');
    }
}
