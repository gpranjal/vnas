<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVnasApmtTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vnas_apmt', function(Blueprint $table)
		{
			$table->increments('id')->unique();
			$table->date('v_date');
			$table->time('v_time_in');
			$table->time('v_time_out');
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
		Schema::drop('vnas_apmt');
	}

}
