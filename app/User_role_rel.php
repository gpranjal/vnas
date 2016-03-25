<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role_rel extends Model {

	protected $table = "vnas_vna_user_rel";
	
	public function Caregiver_record()
	{
		return $this->hasMany('App\User_role_rel');
	}
	
	public static function getClientIds($myRoles)
	{
		$myClientIds = null;
		foreach ( $myRoles as $myIntRole )
		{
			if( $myIntRole->vna_user_role_cd == 2 || $myIntRole->vna_user_role_cd == 3 )
			{
				$myClientIds[count($myClientIds)] = $myIntRole->vna_user_id;
			}
		}
		return $myClientIds;
	}
	
	public static function getCaregiverIds($myRoles)
	{
		$myCareGiverIds = null;
		foreach ( $myRoles as $myIntRole )
		{
			if( $myIntRole->vna_user_role_cd != 2 && $myIntRole->vna_user_role_cd != 3 )
			{
				$myCareGiverIds[count($myCareGiverIds)] = $myIntRole->vna_user_id;
			}			
		}
		return $myCareGiverIds;
	}
	
	public static function getCurrRole( $myRoles )
	{
		$myCurrRole = null;
		foreach ( $myRoles as $myIntRole )
		{
			$myCurrRole[count($myCurrRole)] = $myIntRole->vna_user_role_cd;
		}
		return $myCurrRole;
	}
	
}
