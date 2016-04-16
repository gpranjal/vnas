<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVnasUserInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('CREATE VIEW VNAS_USER_INFO
						AS
							SELECT VNAS_SCHEDULE.CLIENT_ID AS VNA_USER_ID, "CLIENT" AS VNA_USER_TYPE,
							VNAS_SCHEDULE.CLIENT_FIRST_NME AS FIRST_NME,VNAS_SCHEDULE.CLIENT_LAST_NME AS LAST_NME,
							CONCAT(VNAS_SCHEDULE.CLIENT_FIRST_NME," ",VNAS_SCHEDULE.CLIENT_LAST_NME) AS FULL_NME FROM VNAS_SCHEDULE
							UNION
							SELECT VNAS_SCHEDULE.CARE_GIVER_ID AS VNA_USER_ID, "CAREGIVER" AS VNA_USER_TYPE,VNAS_SCHEDULE.
							CARE_GIVER_FIRST_NME AS FIRST_NME,VNAS_SCHEDULE.CARE_GIVER_LAST_NME AS LAST_NME,
							CONCAT(VNAS_SCHEDULE.CARE_GIVER_FIRST_NME," ",VNAS_SCHEDULE.CARE_GIVER_LAST_NME) AS FULL_NME
							FROM VNAS_SCHEDULE;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('DROP VIEW VNAS_USER_INFO');
	}

}
