<?php

class HomeControllerTest extends ControllerTest {

  use Codeception\Specify;

  protected $user;

  public function setUp() {
    parent::setUp();
    $this->user = new User(['name' => 'Sean Carter',
                            'email' => 'jay-z@example.com',
                            'password' => 'password',
                            'created_at' => new DateTime(),
                            'updated_at' => new DateTime()]);
  }

  public function testIndex() {
    $this->path = URL::action('HomeController@index', [], false);

    $this->specify("it renders all users", function() {
      App::instance('User', Mockery::mock('User', ['all' => [$this->user]]));

      $response = $this->get($this->path);
      $this->assertResponseOk();
      $this->assertContains('Sean Carter', $response->getContent());
    });

  }

}
