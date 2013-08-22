<?php
use Symfony\Component\Process\Process;

class AcceptanceDevServer extends \Codeception\Platform\Extension
{
    // list events to listen to
    static $events = [
    'suite.before' => 'beforeSuite',
     'suite.after' => 'afterSuite',
   ];


    function beforeSuite(\Codeception\Event\Suite $e) {
      if($e->getSuite()->getName() == 'acceptance') {

        $appRoot = realpath(__DIR__.'/../../');

        $this->process = new Process("exec php artisan server --host={$this->config['host']} --port={$this->config['port']} --env=testing", $appRoot);
        $this->process->start(function ($type, $buffer) {
            if ('err' === $type) {
                echo 'ERR > '.$buffer;
            } else {
                echo 'OUT > '.$buffer;
            }
        });
      }
    }

    function afterSuite(\Codeception\Event\Suite $e) {
      // This is ghetto, but $this->process->stop() does not work :(
      if($e->getSuite()->getName() == 'acceptance') {
        passthru("pkill -f {$this->config['host']}:{$this->config['port']}");
      }
    }

}
