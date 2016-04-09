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
			$table->string('STS',10)->nullable();
			$table->string('CARE_GIVER_ID',20)->nullable();
			$table->string('CLIENT_ID',20)->nullable();
			$table->string('SCHEDULE_START_DT',20)->nullable();
			$table->string('SCHEDULE_START_TM',20)->nullable();
			$table->string('SCHEDULE_DURATION',20)->nullable();
			$table->string('CALENDAR_TYPE',40)->nullable();
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
			$table->string('CDC_NUM',32)->nullable();
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
