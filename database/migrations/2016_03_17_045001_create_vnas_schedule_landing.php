<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVnasScheduleLanding extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vnas_schedule_landing', function(Blueprint $table)
		{
			$table->string('sts',10);
			$table->string('care_giver_id',20);
			$table->string('client_id',20);
			$table->string('schedule_start_dt',20);
			$table->string('schedule_start_tm',20);
			$table->string('schedule_duration',20);
			$table->string('calendar_type',40);
			$table->string('care_giver_type',100);
			$table->string('care_giver_first_nme',25);
			$table->string('care_giver_last_nme',50);
			$table->string('care_giver_office_ph',20);
			$table->string('care_giver_mobile_ph',20);
			$table->string('client_first_nme',25);
			$table->string('client_last_nme',50);
			$table->string('client_address',100);
			$table->string('client_city',50);
			$table->string('client_state',20);
			$table->string('client_zip',20);
			$table->string('client_phone',20);
			$table->string('comments',4000);
			$table->string('cdc_num',32);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vnas_schedule_landing');
	}

}
