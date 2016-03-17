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
			$table->increments('process_log_skey');
			$table->timestamp('start_dt');
			$table->timestamp('end_dt');
			$table->integer('source_record_read_cnt');
			$table->integer('source_record_reject_cnt');
			$table->integer('target_record_insert_cnt');
			$table->integer('target_record_update_cnt');
			$table->integer('target_record_delete_cnt');
			$table->integer('error_cnt');
			$table->string('rec_status',20);
			$table->string('job_nm');
			$table->string('reject_rsn_txt');
			$table->string('created_by',100);
			$table->timestamp('created_date');
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
