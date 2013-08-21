<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DbDump extends Command {

	protected $name = 'db:dump';

	protected $description = 'Create a dump.sql for testing.';

  public function fire() {
    $this->info("Dump is running as ".App::environment());

    $this->info("Running pg_dump");
    shell_exec('rm tests/_data/dump.sql');
    shell_exec('pg_dump laravel_sample_app_test > tests/_data/dump.sql');
    $this->comment("complete");
	}

}
