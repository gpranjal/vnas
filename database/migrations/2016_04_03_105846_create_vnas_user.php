<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVnasUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('VNAS_USER', function(Blueprint $table)
		{
			$table->increments('USER_SK')->unique();
			$table->string('EMAIL',80);
			$table->string('FIRST_NAME',40);
			$table->string('LAST_NAME',40);
			$table->string('PASSWORD',60);
			$table->string('TOKEN',60);
			$table->integer('FAILED_ATTEMPT_CNT');
			$table->date('LAST_LOGIN_TSP');
			$table->string('USER_ID',20);
			$table->string('CREATED_BY',100);
			$table->timestamp('CREATED_DATE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('VNAS_USER');
	}

}
