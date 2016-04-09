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
		Schema::create('ETL_PROCESS_LOG', function(Blueprint $table)
		{
			$table->increments('PROCESS_LOG_SKEY')->unique();
			$table->timestamp('START_DT')->nullable();
			$table->timestamp('END_DT')->nullable();
			$table->integer('SOURCE_RECORD_READ_CNT')->nullable();
			$table->integer('SOURCE_RECORD_REJECT_CNT')->nullable();
			$table->integer('TARGET_RECORD_INSERT_CNT')->nullable();
			$table->integer('TARGET_RECORD_UPDATE_CNT')->nullable();
			$table->integer('TARGET_RECORD_DELETE_CNT')->nullable();
			$table->integer('ERROR_CNT')->nullable();
			$table->string('REC_STATUS',20)->nullable();
			$table->string('JOB_NM',255)->nullable();
			$table->string('REJECT_RSN_TXT',255)->nullable();
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
