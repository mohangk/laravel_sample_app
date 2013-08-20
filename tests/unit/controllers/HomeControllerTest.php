<?php

class HomeControllerTest extends ControllerTest {

  public function tearDown() {
    Mockery::close();
  }

  public function testShowWelcomeHasUsers() {
    $user = new User(['name' => 'Sean Carter',
                      'email' => 'jay-z@example.com',
                      'password' => 'password',
                      'created_at' => new DateTime(),
                      'updated_at' => new DateTime()]);

    $mock = Mockery::mock('User', ['all' => [$user]]);
    App::instance('User', $mock);

    $response = $this->get('/');
    $this->assertResponseOk();
    $this->assertViewHas('users');
    $this->assertContains('Sean Carter',
                          $response->getContent());
  }

}
