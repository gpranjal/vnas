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
		Schema::create('vnas_gen_ref', function(Blueprint $table)
		{
			$table->increments('gen_ref_id');
			$table->string('gen_ref_nme',40);
			$table->string('gen_ref_desc',100);
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
		Schema::drop('vnas_gen_ref');
	}

}
