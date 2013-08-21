<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ServerCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'server';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = "Serve the app in the passed in env";

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$this->checkPhpVersion();

		chdir($this->laravel['path.base']);

		$host = $this->input->getOption('host');

		$port = $this->input->getOption('port');

    $env = $this->getEnv();

    putenv("LARAVEL_ENV=$env");

		$public = $this->laravel['path.public'];

		$this->info("Laravel development server started on http://{$host}:{$port} with LARAVEL_ENV set to '$env'");

		passthru("php -S {$host}:{$port} -t \"{$public}\" server.php");
	}

  public function getEnv() {
		$env = $this->input->getOption('env');

    if(strlen($env)) {
      return $env;
    } else {
      return 'development';
    }
  }

	/**
	 * Check the current PHP version is >= 5.4.
	 *
	 * @return void
	 */
	protected function checkPhpVersion()
	{
		if (version_compare(PHP_VERSION, '5.4.0', '<'))
		{
			throw new \Exception('This PHP binary is not version 5.4 or greater.');
		}
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('host', null, InputOption::VALUE_OPTIONAL, 'The host address to serve the application on.', 'localhost'),

			array('port', null, InputOption::VALUE_OPTIONAL, 'The port to serve the application on.', 8000),

		);
	}

}
