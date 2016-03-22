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
			$table->timestamps();
		});
		
		// Insert default values provided by VNA
		DB::table('user_settings')->insert(
			array(
					'session_timeout_minutes' => '15',
					'google_maps_api_key' => 'AIzaSyDUpg0PlDtAK9fsqO9QFE4zkAjKKzdy7y4',
					'paypal_api_key'=> 'GHN68S7FB25TG',
					'email_lockout_count'=> '5',
					'email_lockout_duration_mins'=> '60'
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
