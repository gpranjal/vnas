<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVnasGenRef extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('VNAS_GEN_REF', function(Blueprint $table)
		{
			$table->increments('GEN_REF_ID')->unique();
			$table->string('GEN_REF_NME',40);
			$table->string('GEN_REF_DESC',100);
			$table->integer('CLIENT_IND');
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
		Schema::drop('VNAS_GEN_REF');
	}

}
