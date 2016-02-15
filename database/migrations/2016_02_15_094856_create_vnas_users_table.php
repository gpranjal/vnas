<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVnasUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vnas_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('patient_id')->unique();
			$table->string('name');
			$table->string('email');
			$table->string('patient_phone');
			$table->string('patient_address');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vnas_users');
	}

}
