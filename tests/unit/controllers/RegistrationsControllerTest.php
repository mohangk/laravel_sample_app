<?php

class RegistrationsControllerTest extends ControllerTest {

  use Codeception\Specify;

  protected $validInputs;
  protected $invalidInputs;

  public function setUp() {
    parent::setUp();

    $this->validInputs = ['name' => 'Sean Carter',
                          'email' => 'jay-z@example.com',
                          'password' => 'password' ];
  }

  public function testIndex() {
    $this->path = URL::action('RegistrationsController@index', [], false);

    $this->specify("it renders the view", function() {
      $response = $this->call('get', $this->path);
      $this->assertResponseOk();
      $this->assertContains('form', $response->getContent());
    });
  }

  public function testStore() {
    $this->path = URL::action('RegistrationsController@store', [], false);

    $this->specify("when valid, it persists the user and redirects to root", function() {
      $response = $this->call('post', $this->path, $this->validInputs);
      $this->assertRedirectedToRoute('root');
    });
 
    $this->specify("when invalid, flashes errors and redirects to index", function() {
      $invalidInputs = array_only($this->validInputs, ['name']);
      $response = $this->call('post', $this->path, $invalidInputs);
      $this->assertRedirectedToRoute('sign-up.index');
    });

    // This is quite helpful for partially mocking the user, We're still
    // confused as to why the Input::shouldReceive facade doesn't work.
    // The User mock does work, because the supplied inputs, [], aren't valid and
    // would noramlly redirect the user to sign-up.index.
    $this->specify("lets us mock things, like a boss", function() {
      $userMock = Mockery::mock('User', ['save' => true])->makePartial();
      $userMock->shouldReceive('fill')->once();
      App::instance('User', $userMock);

      Input::shouldReceive('only')
        // ->once()
        // ->with('name', 'email', 'password')
        ->andReturn($this->validInputs);

      $response = $this->call('post', $this->path, []);
      $this->assertRedirectedToRoute('root');
    });
  }

}
