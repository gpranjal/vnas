<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVnasUserLog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('VNAS_USER_LOG', function(Blueprint $table)
		{
			$table->string('EMAIL',80);
			$table->string('FIRST_NAME',40);
			$table->string('LAST_NAME',40);
			$table->string('PASSWORD',60);
			$table->string('TOKEN',60);
			$table->integer('FAILED_ATTEMPT_CNT');
			$table->date('LOGIN_TSP');
			$table->string('USER_ID',20);
			$table->string('CREATED_BY',100);
			$table->timestamp('CREATED_DATE');
			$table->integer('USER_SK');
			$table->increments('USER_LOG_SK')->unique();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('VNAS_USER_LOG');
	}

}
