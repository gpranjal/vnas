<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVnasVnaUserRel extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('VNAS_VNA_USER_REL', function(Blueprint $table)
		{
			$table->integer('USER_SK')->index();
			$table->string('VNA_USER_ID',20)->index();
			$table->datetime('EFFECTIVE_DT');
			$table->datetime('END_DT');
			$table->integer('VNA_USER_ROLE_CD');
			$table->integer('VNA_USER_TYPE_CD');
			$table->increments('USER_REL_SK')->unique();
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
		Schema::drop('VNAS_VNA_USER_REL');
	}

}
