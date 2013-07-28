<?php namespace DaveJamesMiller\Boris;

use Boris\Boris;
use Illuminate\Console\Command;
use Illuminate\Foundation\AliasLoader;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class BorisCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'boris';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts a REPL session with Boris';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        // Disable the exception/error handlers so Boris can handle them
        restore_error_handler();
        restore_exception_handler();
        $this->laravel->make('artisan')->setCatchExceptions(false);

        // Stop the shutdown handler outputting a JSON error object
        $this->laravel->error(function() { return ''; });

        // Run Boris
        $boris = new Boris;
        $boris->start();
    }

}
