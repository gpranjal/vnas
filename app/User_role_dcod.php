<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role_dcod extends Model {

	protected $table = "vnas_gen_ref";
	
	public function Caregiver_record()
	{
		return $this->hasMany('App\User_role_dcod');
	}
	
	public static function getClientRoleDcodIds()
	{
		$result = User_role_dcod::where( "gen_ref_desc" , "=" , 'PATIENT')
			->orWhere( 'gen_ref_desc' , '=' , 'CLIENT')->get();
		return $result;
	}
	
	public static function getCaregiverRoleDcodIds()
	{
		$result = User_role_dcod::where( "gen_ref_desc" , "!=" , 'PATIENT')
			->where( 'gen_ref_desc' , '!=' , 'CLIENT')->get();
		
		return $result;
	}
}
