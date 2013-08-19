<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TestingDump extends Command {

	protected $name = 'testing:dump';

	protected $description = 'Create a dump.sql with seed data for testing.';

  public function fire() {
    echo("testing:dump is running as ".App::environment());

    $this->info("Running migrate:refresh");
    $this->call('migrate:refresh', array('--env' => 'testing'));
    $this->comment("complete");

    $this->info("Running db:seed");
    $this->call('db:seed', array('--env' => 'testing'));
    $this->comment("complete");

    $this->info("Running pg_dump");
    shell_exec('rm tests/_data/dump.sql');
    shell_exec('pg_dump laravel_sample_app_test > tests/_data/dump.sql');
    $this->comment("complete");
	}

}
