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
	/* mysql app < ./VNSApplicationDatabaseETLLoadScript.sql */
	
	/* cd /c/wamp/bin/mysql/mysql5.6.17/data/vnas/ */
	/* mysql vnas < ./VNSApplicationDatabaseETLLoadScript.sql */
	public function fire()
	{
		//$this->call('mysql vnas < ./VNSApplicationDatabaseETLLoadScript.sql');
		//$process = new Process('cd /c/wamp/bin/mysql/mysql5.6.17/data/vnas/ && mysql vnas < ./VNSApplicationDatabaseETLLoadScript.sql');
		//$process->run();
		
		/*
		exec("cd /c/wamp/bin/mysql/mysql5.6.17/data/vnas");
		exec("mysql vnas < ./VNSApplicationDatabaseETLLoadScript.sql");
		*/
		
		exec("cd /var/lib/openshift/56b6e9612d527164d3000155/mysql/data/app");
		exec("mysql app < ./VNSApplicationDatabaseETLLoadScript.sql");
		
		$this->info('Supposedly, this process ran.');
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
