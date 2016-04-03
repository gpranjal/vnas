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
		Schema::create('etl_process_log', function(Blueprint $table)
		{
			$table->increments('PROCESS_LOG_SKEY')->unique();
			$table->timestamp('START_DT');
			$table->timestamp('END_DT');
			$table->integer('SOURCE_RECORD_READ_CNT');
			$table->integer('SOURCE_RECORD_REJECT_CNT');
			$table->integer('TARGET_RECORD_INSERT_CNT');
			$table->integer('TARGET_RECORD_UPDATE_CNT');
			$table->integer('TARGET_RECORD_DELETE_CNT');
			$table->integer('ERROR_CNT');
			$table->string('REC_STATUS',20);
			$table->string('JOB_NM',255);
			$table->string('REJECT_RSN_TXT',255);
			$table->string('CREATED_BY',100);
			$table->timestamp('CREATED_DATE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('etl_process_log');
	}

}
