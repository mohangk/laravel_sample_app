<?php
 
class ControllerTest extends Illuminate\Foundation\Testing\TestCase {
 
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
 
  /**
   * Helper methods exposing things like $this->get('posts')
   */
  public function __call($method, $args) {
    if (in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
      if (count($args) == 1) {
        return $this->call($method, $args[0]);
      } elseif (count($args) == 2) {
        return $this->call($method, $args[0], $args[1]);
      } else {
        return $this->call($method, $args[0], $args[1], $args[2]);
      }
    }
 
    throw new BadMethodCallException;
  }
 
}
