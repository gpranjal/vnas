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
		Schema::create('vnas_user', function(Blueprint $table)
		{
			$table->increments('user_sk');
			$table->string('email',80);
			$table->string('first_name',40);
			$table->string('last_name',40);
			$table->string('password',60);
			$table->string('token',60);
			$table->integer('failed_attempt_cnt');
			$table->date('last_login_tsp');
			$table->string('user_id',20);
			$table->string('created_by',100);
			$table->timestamp('created_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vnas_user');
	}

}
