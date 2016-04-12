<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class VnasETLCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	/* mysql app < ./VNSApplicationDatabaseETLLoadScript.sql */
	/* mysql vnas < ./VNSApplicationDatabaseETLLoadScript.sql */
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
	public function fire()
	{
		//$this->call('mysql vnas < ./VNSApplicationDatabaseETLLoadScript.sql');
		$this->call('mysql vnas < ./VNSApplicationDatabaseETLLoadScript.sql');
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
