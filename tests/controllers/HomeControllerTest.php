<?php

class HomeControllerTest extends TestCase {

  // echo print_r(get_class_methods($response));

	public function testShowWelcomeRequiresAuth() {
    Route::enableFilters();
		$this->get('/');
    $this->assertRedirectedTo('login');
	}

  public function testShowWelcomeHasUsers() {
    $user = new User(['name' => 'John Doe',
                      'email' => 'user@example.com',
                      'password' => 'password']);

    $this->mock = Mockery::mock('Eloquent', 'User');
    $this->mock
         ->shouldReceive('all')
         ->once()
         ->andReturn([$user]);

    $this->app->instance('User', $this->mock);

		$response = $this->get('/');
    $this->assertResponseOk();
    $this->assertViewHas('users');
    $this->assertContains('John Doe',
                          $response->getContent());

    Mockery::close();
  }

}
