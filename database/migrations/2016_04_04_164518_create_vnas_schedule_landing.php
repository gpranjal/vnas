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
		Schema::create('VNAS_SCHEDULE_LANDING', function(Blueprint $table)
		{
			$table->string('STS',10);
			$table->string('CARE_GIVER_ID',20);
			$table->string('CLIENT_ID',20);
			$table->string('SCHEDULE_START_DT',20);
			$table->string('SCHEDULE_START_TM',20);
			$table->string('SCHEDULE_DURATION',20);
			$table->string('CALENDAR_TYPE',40);
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
			$table->string('CDC_NUM',32);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('VNAS_SCHEDULE_LANDING');
	}

}
