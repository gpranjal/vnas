<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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
		$process = new Process('mysql vnas < ./VNSApplicationDatabaseETLLoadScript.sql');
		$process->run();
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
