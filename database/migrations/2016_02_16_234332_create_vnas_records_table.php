<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVnasRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vnas_records', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('patient_id');
			$table->string('patient_fname');
			$table->string('patient_lname');
			$table->string('patient_email');
			$table->string('patient_phone');
			$table->string('patient_address');
			$table->string('caregiver_id');
			$table->string('caregiver_role');
			$table->string('caregiver_fname');
			$table->string('caregiver_lname');
			$table->string('caregiver_phone');
			$table->string('caregiver_mob');
			$table->string('ap_title');
			$table->date('ap_date');
			$table->time('ap_time');
			$table->integer('ap_lov');
			$table->text('ap_comments');
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
		Schema::drop('vnas_records');
	}

}
