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
		Schema::create('vnas_user_log', function(Blueprint $table)
		{
			$table->string('email',80)->nullable();
			$table->string('first_name',40)->nullable();
			$table->string('last_name',40)->nullable();
			$table->string('password',60)->nullable();
			$table->string('token',60)->nullable();
			$table->integer('failed_attempt_cnt')->nullable();
			$table->date('login_tsp')->nullable();
			$table->string('user_id',20);
			$table->string('created_by',100);
			$table->timestamp('created_date');
			$table->integer('user_sk');
			$table->increments('user_log_sk');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vnas_user_log');
	}

}
