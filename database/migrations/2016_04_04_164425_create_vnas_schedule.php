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
			$table->string('CURRENT_CALENDAR_IND',1)->nullable();
			$table->char('STS',1)->nullable();
			$table->string('CARE_GIVER_TYPE',100)->nullable();
			$table->string('CARE_GIVER_FIRST_NME',25)->nullable();
			$table->string('CARE_GIVER_LAST_NME',50)->nullable();
			$table->string('CARE_GIVER_OFFICE_PH',20)->nullable();
			$table->string('CARE_GIVER_MOBILE_PH',20)->nullable();
			$table->string('CLIENT_FIRST_NME',25)->nullable();
			$table->string('CLIENT_LAST_NME',50)->nullable();
			$table->string('CLIENT_ADDRESS',100)->nullable();
			$table->string('CLIENT_CITY',50)->nullable();
			$table->string('CLIENT_STATE',20)->nullable();
			$table->string('CLIENT_ZIP',20)->nullable();
			$table->string('CLIENT_PHONE',20)->nullable();
			$table->string('COMMENTS',4000)->nullable();
			$table->string('REC_CDC_NUM',32)->nullable();
			$table->string('NK_CDC_NUM',32)->nullable();
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
