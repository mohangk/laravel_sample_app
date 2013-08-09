<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

  protected $useDatabase = true;

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication() {
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../bootstrap/start.php';
  }

  public function setUp() {
    parent::setUp();
    if($this->useDatabase) {
      Artisan::call('migrate:refresh');
    }
  }

  public function tearDown() {
    if($this->useDatabase) { }
  }

	/**
	 * Helper methods exposing things like $this->get('posts')
	 */
  public function __call($method,$args) {
    if (in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
      return $this->call($method, $args[0]);
    }

    throw new BadMethodCallException;
  }

}
