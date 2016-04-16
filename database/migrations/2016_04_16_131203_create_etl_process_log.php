<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtlProcessLog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('ETL_PROCESS_LOG');

		Schema::create('ETL_PROCESS_LOG', function(Blueprint $table)
		{
			$table->increments('PROCESS_LOG_SKEY')->unique();
			$table->integer('LANDING_TBL_REC_CNT')->nullable();
			$table->string('LANDING_TBL_DATE_RANGE',50)->nullable();
			$table->integer('CHANGED_CALENDAR_CNT')->nullable();
			$table->string('ETL_PROCESS_STATUS',20)->nullable();
			$table->integer('ERROR_CNT')->nullable();
			$table->string('ERROR_DESC',50)->nullable();
			$table->integer('ERROR_CALENDAR_SK')->nullable();
			$table->string('ERROR_CARE_GIVER_ID',20)->nullable();
			$table->string('ERROR_CLIENT_ID',20)->nullable();
			$table->string('ERROR_CALENDAR_TYPE',40)->nullable();
			$table->string('REC_CDC_NUM',32)->nullable();
			$table->string('CREATED_BY',100)->default('app_user');
			$table->timestamp('CREATED_DATE')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ETL_PROCESS_LOG');
	}

}
