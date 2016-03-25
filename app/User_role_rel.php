<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User_role_dcod;

class User_role_rel extends Model {

	protected $table = "vnas_vna_user_rel";
	
	public function Caregiver_record()
	{
		return $this->hasMany('App\User_role_rel');
	}
	
	public static function getClientIds($myRoles)
	{
		$myClientIds = null;
		$myClientDcodIds = User_role_dcod::getClientRoleDcodIds();
		
		foreach ( $myRoles as $myIntRole )
		{
			foreach( $myClientDcodIds as $myClientDcodId )
			{
				if( $myIntRole->vna_user_role_cd == $myClientDcodId->gen_ref_id  )
				{
					$myClientIds[count($myClientIds)] = $myIntRole->vna_user_id;
				}
			}
		}
		return $myClientIds;
	}
	
	public static function getCaregiverIds($myRoles)
	{
		$myCareGiverIds = null;
		$myClientDcodIds = User_role_dcod::getCaregiverRoleDcodIds();
		
		foreach ( $myRoles as $myIntRole )
		{
			foreach( $myClientDcodIds as $myClientDcodId )
			{
				if( $myIntRole->vna_user_role_cd == $myClientDcodId->gen_ref_id )
				{
					$myCareGiverIds[count($myCareGiverIds)] = $myIntRole->vna_user_id;
				}
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
