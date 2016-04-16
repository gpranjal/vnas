<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use SSH;

class VnasETLCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	
	protected $name = "exec:etl";

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Execute VNA ETL Script on server.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	
	/* cd /var/lib/openshift/56b6e9612d527164d3000155/mysql/data/app */
	/* mysql app < ./VNASApplicationDatabaseETLLoadScript.sql */
	
	/* cd /c/wamp/bin/mysql/mysql5.6.17/data/vnas/ */
	/* mysql vnas < ./VNASApplicationDatabaseETLLoadScript.sql */
	public function fire()
	{
		$this->info('--- START Running VNAS ETL Fire... ---');

		exec("mysql --protocol=TCP -h$_ENV[OPENSHIFT_MYSQL_DB_HOST] -P3306 -udevuser -pdevpass app < ./database/ETL/ETL_LoadScript.sql");

		$this->info('--- STOP Running VNAS ETL Fire... ---');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
// 	protected function getArguments()
// 	{
// 		return [
// 			['example', InputArgument::REQUIRED, 'An example argument.'],
// 		];
// 	}

// 	/**
// 	 * Get the console command options.
// 	 *
// 	 * @return array
// 	 */
// 	protected function getOptions()
// 	{
// 		return [
// 			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
// 		];
// 	}

}
