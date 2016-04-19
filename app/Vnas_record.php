<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        return $this->hasMany('App\Vnas_record');
    }
    
    public static function updateChangedScheduleRecords( $myResults )
    {
    	$myTmp = DB::table('VNAS_SCHEDULE')
	    	->where( 'STS' , '=' , 'C' );
    	
	    foreach( $myResults as $myResult )
	    {
	    	$myTmp = $myTmp->where( 'SCHEDULE_SK' , '=' , $myResult->SCHEDULE_SK );
	    }
	    
	    $myTmp = $myTmp->update( ['STS' => 'F' ] );
    }
    
    public static function getChangedScheduleRecords()
    {
    	$myResult = Vnas_record::where( 'USER_SK' , '=' , Auth::user()->id )
				->where( 'SCHEDULE_START_DTTM' , '>=' , Carbon::now() )
				->where( 'STS' , '=' , 'C' )
				->get( array('SCHEDULE_SK') );
    	
		if( count( $myResult ) > 0 )
		{
			$myTmp = Vnas_record::updateChangedScheduleRecords( $myResult );
		}
		
    	return $myResult;
    }
   
    public static function getNextCntl( $isCareGiver , $isPatient )
    {
    	$nextCntl = null;
    	if( ( $isCareGiver && !$isPatient )  ) // Is a caregiver only
    	{
    		$nextCntl = "VnasRecordsController@sch";
    	}
    	else if ( $isPatient && !$isCareGiver  ) // Is a patient only
    	{
    		$nextCntl = "VnasRecordsController@patientsch";
    	}
    	else if( $isCareGiver && $isPatient ) // Is both roles
    	{
    		$nextCntl = "VnasRecordsController@multirolesch";
    	}
    	return $nextCntl;
    }
    
    public static function getNextView( $isCareGiver , $isPatient )
    {
    	$myView = null;
    	if( ( $isCareGiver && !$isPatient )  ) // Is a caregiver only
    	{
    		$myView = "vnas_records.care";
    	}
    	else if ( $isPatient && !$isCareGiver  ) // Is a patient only
    	{
    		$myView = "vnas_records.index";
    	}
    	else if( $isCareGiver && $isPatient ) // Is both roles
    	{
    		$myView = "vnas_records.multirole";//{{ action( $nextCntl , [$Vnas_record->id]) }}
    	}
    	return $myView;
    }
    
    public static function filterForSchType( $Vnas_records , $myRangeValue )
    {
    	if($myRangeValue == "Current")
    	{
    		$Vnas_records = $Vnas_records->where( 'SCHEDULE_END_DTTM' , '>=' , Carbon::now() )
    		->orderBy('SCHEDULE_START_DTTM', 'ASC');
    	}
    	else if($myRangeValue == "History")
    	{
    		$Vnas_records = $Vnas_records->where( 'SCHEDULE_END_DTTM' , '<=' , Carbon::now() )
    		->orderBy('SCHEDULE_START_DTTM', 'DESC');
    	}
    	
    	return $Vnas_records;
    }
}
