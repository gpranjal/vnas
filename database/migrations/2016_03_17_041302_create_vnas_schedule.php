<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVnasSchedule extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vnas_schedule', function(Blueprint $table)
		{
			$table->increments('schedule_sk');
			$table->string('client_id',20);
			$table->string('care_giver_id',20);
			$table->dateTime('schedule_start_dttm');
			$table->dateTime('schedule_end_dttm');
			$table->string('calendar_type',40);
			$table->string('current_calendar_ind',1);
			$table->char('sts',1);
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
			$table->string('rec_cdc_num',32);
			$table->string('nk_cdc_num',32);
			$table->timestamp('create_tsp');
			$table->timestamp('etl_load_tsp');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vnas_schedule');
	}

}
