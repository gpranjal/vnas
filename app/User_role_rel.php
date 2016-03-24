<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role_rel extends Model {

	protected $table = "vnas_vna_user_rel";
	
	public function Caregiver_record()
	{
		return $this->hasMany('App\User_role_rel');
	}

}
