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
		Schema::create('vnas_vna_user_rel', function(Blueprint $table)
		{
			$table->integer('user_sk')->nullable();
			$table->string('vna_user_id',20)->nullable();
			$table->datetime('effective_dt')->nullable();
			$table->datetime('end_dt')->nullable();
			$table->integer('vna_user_role_cd')->nullable();
			$table->integer('vna_user_type_cd')->nullable();
			$table->increments('user_rel_sk');
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
		Schema::drop('vnas_vna_user_rel');
	}

}
