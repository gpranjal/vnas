<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUserSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_settings', function($table)
		{
			$table->string('app_root_key',255);
			$table->string('ETLLoadScriptPath',255);
		});
	}
}
