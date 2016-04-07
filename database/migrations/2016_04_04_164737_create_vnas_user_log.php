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
			$table->string('EMAIL',80)->nullable();
			$table->string('FIRST_NAME',40)->nullable();
			$table->string('LAST_NAME',40)->nullable();
			$table->string('PASSWORD',60)->nullable();
			$table->string('TOKEN',60)->nullable();
			$table->integer('FAILED_ATTEMPT_CNT')->nullable();
			$table->date('LOGIN_TSP')->nullable();
			$table->string('USER_ID',20);
			$table->string('CREATED_BY',100)->default('app_user');
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
