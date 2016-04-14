<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
		'App\Console\Commands\VnasETLCommand',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 * 
	 * $schedule->command('cache:clear')
		    ->everyFiveMinutes()
		    ->sendOutputTo('/public/uploads/output.txt')
		    ->emailOutputTo('zheath@unomaha.edu');
		
		$schedule->exec('mysql vnas < ./VNSApplicationDatabaseETLLoadScript.sql')
			->everyFiveMinutes()
			->sendOutputTo('/public/uploads/output.txt')
			->emailOutputTo('zheath@unomaha.edu');
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->exec('exec:etl')
			->everyThirtyMinutes()
			->sendOutputTo('~/app-root/runtime/repo/public/uploads/output.txt')
			->emailOutputTo('vnastest@gmail.com');
	}

}
