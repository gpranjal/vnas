<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->float('session_timeout_minutes')->unsigned()->nullable();
			$table->string('google_maps_api_key');
			$table->string('paypal_api_key');
			$table->integer('email_lockout_count');
			$table->float('email_lockout_duration_mins')->unsigned();
			$table->string('my_acct_no_rcrd_msg');
			$table->string('sch_no_rcrd_msg');
			$table->string('sch_chg_msg');
			$table->timestamps();
		});
		
		// Insert default values provided by VNA
		DB::table('user_settings')->insert(
			array(
					'session_timeout_minutes' => '15',
					'google_maps_api_key' => 'AIzaSyDUpg0PlDtAK9fsqO9QFE4zkAjKKzdy7y4',
					'paypal_api_key'=> 'GHN68S7FB25TG',
					'email_lockout_count'=> '5',
					'email_lockout_duration_mins'=> '60',
					'my_acct_no_rcrd_msg' => 'You currently have no schedule records with VNA.  Contact VNA by clicking the email or phone buttons below to set up your account!',
					'sch_no_rcrd_msg' => 'You currently have no VNA accounts assigned to you; therefore, you have no schedule records.  Contact VNA by clicking the contact buttons below to get scheduled today!',
					'sch_chg_msg' => 'Your schedule has changed since your last login.  Please view your schedule by clicking the \"My Schedule\" button.'
			)
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_settings');
	}

}
