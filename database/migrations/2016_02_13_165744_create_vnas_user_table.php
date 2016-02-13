<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVnasUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vnas_user', function(Blueprint $table)
		{
			$table->string('name');
			$table->string('patient_id')->unique();
			$table->string('email');
			$table->string('patient_phone', 20);
			$table->string('patient_address', 90);
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
		Schema::drop('vnas_user');
	}

}
