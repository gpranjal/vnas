<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserSettings extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_settings';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['session_timeout_minutes', 'google_maps_api_key', 'paypal_api_key'];

	public static function getUserSettingsSessionTimeout() {
		$mySettings = UserSettings::get(array('session_timeout_minutes'))
					->take(1);
		$myTimeout = $mySettings[0]->session_timeout_minutes;
 	    return $myTimeout;
	}
	
	public static function getMapsAPIKey() {
		$mySettings = UserSettings::get(array('google_maps_api_key'))
		->take(1);
		$mapsAPIKey = $mySettings[0]->google_maps_api_key;
		return $mapsAPIKey;
	}
	
	public static function getDonateAPIKey() {
		$mySettings = UserSettings::get(array('paypal_api_key'))
		->take(1);
		$donateAPIKey = $mySettings[0]->paypal_api_key;
		return $donateAPIKey;
	}
	
	public static function getEmailLockoutCount() {
		$mySettings = UserSettings::get(array('email_lockout_count'))
		->take(1);
		$emailLockoutCount = $mySettings[0]->email_lockout_count;
		return $emailLockoutCount;
	}
	
	public static function getEmailLockoutDuration() {
		$mySettings = UserSettings::get(array('email_lockout_duration_mins'))
		->take(1);
		$emailLockoutDuration = $mySettings[0]->email_lockout_duration_mins;
		return $emailLockoutDuration;
	}
	
	public static function getMyAcctNoRcrdMsg() {
		$mySettings = UserSettings::get(array('my_acct_no_rcrd_msg'))
		->take(1);
		$result = $mySettings[0]->my_acct_no_rcrd_msg;
		return $result;
	}
	
	public static function getSchNoRcrdMsg() {
		$mySettings = UserSettings::get(array('sch_no_rcrd_msg'))
		->take(1);
		$result = $mySettings[0]->sch_no_rcrd_msg;
		return $result;
	}
	
	public static function getSchChgMsg() {
		$mySettings = UserSettings::get(array('sch_chg_msg'))
		->take(1);
		$result = $mySettings[0]->sch_chg_msg;
		return $result;
	}

	public static function getAppRootKey() {
		$mySettings = UserSettings::get(array('app_root_key'))
			->take(1);
		$appRootKey = $mySettings[0]->app_root_key;
		return $appRootKey;
	}
}
