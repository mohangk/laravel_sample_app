<?php

class LibTest extends Illuminate\Foundation\Testing\TestCase {
  use Codeception\Specify;

  protected $useDatabase = false;
  protected $dbh = null;

    /**
     * Creates the application.
     *
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
     */
  public function createApplication() {
    $unitTesting = true;

    $testEnvironment = 'testing';

    return require __DIR__.'/../../../bootstrap/start.php';
  }

  public function setUp() {
    parent::setUp();

    if($this->useDatabase) {
      $this->dbh = DB::connection()->getPdo();
      $this->dbh->beginTransaction();
    }
  }

  public function tearDown() {
    Mockery::close();

    if($this->useDatabase && $this->dbh->inTransaction()) {
      $this->dbh->rollback();
    }
  }

}
