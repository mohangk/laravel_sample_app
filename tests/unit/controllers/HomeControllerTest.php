<?php
 
class HomeControllerTest extends ControllerTest {
 
  public function testShowWelcomeRequiresAuth() {
    Route::enableFilters();
    $this->get('/');
    $this->assertRedirectedTo('sign-in');
  }
 
  public function testShowWelcomeHasUsers() {
    $user = new User(['name' => 'John Doe',
                      'email' => 'user@example.com',
                      'password' => 'password']);
    $user->save();
 
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
