<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role_dcod extends Model {

	protected $table = "VNAS_GEN_REF";
	
	public function Caregiver_record()
	{
		return $this->hasMany('App\User_role_dcod');
	}
	
	public static function getClientRoleDcodIds()
	{
		$result = User_role_dcod::where( "CLIENT_IND" , "=" , 1)->get();
		return $result;
	}
	
	public static function getCaregiverRoleDcodIds()
	{
		$result = User_role_dcod::where( "CLIENT_IND" , "!=" , 1)->get();
		return $result;
	}
}
