<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('role');
			$table->string('caregiver_role');
			$table->string('patient_role');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->rememberToken();
			$table->timestamps();
		});
		// Insert some stuff
		DB::table('users')->insert(
			array(
				'name' => 'vnas-admin',
				'role' => 'admin',
				'email'=> 'vnas-admin@vnas.com',
				'password'=>'$2y$10$XXPu13TtkIf6SK.QQSEcmuW00j3tssAIYJ1Gc831XvLoNZu92pQlG'
			)
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
