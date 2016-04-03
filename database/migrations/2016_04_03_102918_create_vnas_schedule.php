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
		Schema::create('VNAS_SCHEDULE', function(Blueprint $table)
		{
			$table->increments('SCHEDULE_SK')->unique();
			$table->string('CLIENT_ID',20);
			$table->string('CARE_GIVER_ID',20);
			$table->dateTime('SCHEDULE_START_DTTM');
			$table->dateTime('SCHEDULE_END_DTTM');
			$table->string('CALENDAR_TYPE',40);
			$table->string('CURRENT_CALENDAR_IND',1);
			$table->char('STS',1);
			$table->string('CARE_GIVER_TYPE',100);
			$table->string('CARE_GIVER_FIRST_NME',25);
			$table->string('CARE_GIVER_LAST_NME',50);
			$table->string('CARE_GIVER_OFFICE_PH',20);
			$table->string('CARE_GIVER_MOBILE_PH',20);
			$table->string('CLIENT_FIRST_NME',25);
			$table->string('CLIENT_LAST_NME',50);
			$table->string('CLIENT_ADDRESS',100);
			$table->string('CLIENT_CITY',50);
			$table->string('CLIENT_STATE',20);
			$table->string('CLIENT_ZIP',20);
			$table->string('CLIENT_PHONE',20);
			$table->string('COMMENTS',4000);
			$table->string('REC_CDC_NUM',32);
			$table->string('NK_CDC_NUM',32);
			$table->timestamp('CREATE_TSP');
			$table->timestamp('ETL_LOAD_TSP');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('VNAS_SCHEDULE');
	}

}
