<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../bootstrap/start.php';
  }


	/**
	 * Helper methods exposing things like $this->get('posts')
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
  public function __call($method,$args)
  {
    if (in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
      return $this->call($method, $args[0]);
    }

    throw new BadMethodCallException;
  }

}
