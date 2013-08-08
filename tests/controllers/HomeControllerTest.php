<?php

class HomeControllerTest extends TestCase {

  // echo print_r(get_class_methods($response()));
  
	public function testShowWelcomeRequiresAuth()
  {
    Route::enableFilters();
		$this->get('/');
    $this->assertRedirectedTo('login');
	}

	public function testShowWelcomeHasUsers()
  {
		$this->get('/');
    $this->assertResponseOk();
    $this->assertViewHas('users');
  }

}
