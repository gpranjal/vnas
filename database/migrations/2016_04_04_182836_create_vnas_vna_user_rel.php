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
			$table->integer('USER_SK')->nullable()->index();
			$table->string('VNA_USER_ID',20)->nullable()->index();
			$table->datetime('EFFECTIVE_DT')->nullable();
			$table->datetime('END_DT')->nullable();
			$table->integer('VNA_USER_ROLE_CD')->nullable();
			$table->integer('VNA_USER_TYPE_CD')->nullable();
			$table->increments('USER_REL_SK')->nullable()->unique();
			$table->string('CREATED_BY',100)->default('app_user');
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
