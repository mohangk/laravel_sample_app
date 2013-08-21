<?php

class HelperTest extends \Codeception\TestCase\Test {

  use Codeception\Specify;

  public function testControllerName() {
    $this->specify("it extracts the controller's name", function() {
      Route::shouldReceive('currentRouteAction')->once()
             ->andReturn('SessionsController@create');

      $this->assertEquals(Helper::controllerName(), 'sessions');
    });
  }

  public function testActionName() {
    $this->specify("it extracts the action's name", function() {
      Route::shouldReceive('currentRouteAction')->once()
             ->andReturn('SessionsController@create');
      $this->assertEquals(Helper::actionName(), 'create');
    });

    $this->specify("when store, it returns create", function() {
      Route::shouldReceive('currentRouteAction')->once()
             ->andReturn('SessionsController@store');
      $this->assertEquals(Helper::actionName(), 'create');
    });

    $this->specify("when update, it returns edit", function() {
      Route::shouldReceive('currentRouteAction')->once()
             ->andReturn('SessionsController@update');
      $this->assertEquals(Helper::actionName(), 'edit');
    });
  }

}
