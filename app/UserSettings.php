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
}
