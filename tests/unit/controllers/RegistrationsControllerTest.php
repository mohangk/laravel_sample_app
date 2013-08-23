<?php

use Woodling\Woodling;

class RegistrationsControllerTest extends ControllerTest {

  use Codeception\Specify;

  public function testIndex() {
    $path = URL::action('RegistrationsController@index', [], false);

    $this->specify("it renders the view", function() use($path) {
      $response = $this->call('get', $path);
      $this->assertResponseOk();
      $this->assertContains('form', $response->getContent());
    });
  }

  public function testStore() {
    $validInputs = Woodling::retrieve('User')->getAttributes();
    $path = URL::action('RegistrationsController@store', [], false);

    $this->specify("when valid, it persists the user and redirects to root", function() use($path, $validInputs) {
      $response = $this->call('post', $path, $validInputs);
      $this->assertRedirectedToRoute('root');
    });
 
    $this->specify("when invalid, flashes errors and redirects to index", function() use($path, $validInputs) {
      $invalidInputs = array_only($validInputs, ['name']);
      $response = $this->call('post', $path, $invalidInputs);
      $this->assertRedirectedToRoute('sign-up.index');
    });

    // This is quite helpful for partially mocking the user, We're still
    // confused as to why the Input::shouldReceive facade doesn't work.
    // The User mock does work, because the supplied inputs, [], aren't valid and
    // would noramlly redirect the user to sign-up.index.
    $this->specify("lets us mock things, like a boss", function() use($path, $validInputs) {
      $userMock = Mockery::mock('User', ['save' => true])->makePartial();
      $userMock->shouldReceive('fill')->once();
      App::instance('User', $userMock);

      Input::shouldReceive('only')
        // ->once()
        // ->with('name', 'email', 'password')
        ->andReturn($validInputs);

      $response = $this->call('post', $path, []);
      $this->assertRedirectedToRoute('root');
    });
  }

}
