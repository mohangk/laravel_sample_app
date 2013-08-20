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

    $this->specify("it returns returns create instead of store", function() {
      Route::shouldReceive('currentRouteAction')->once()
             ->andReturn('SessionsController@store');
      $this->assertEquals(Helper::actionName(), 'create');
    });

    $this->specify("it returns returns edit instead of update", function() {
      Route::shouldReceive('currentRouteAction')->once()
             ->andReturn('SessionsController@update');
      $this->assertEquals(Helper::actionName(), 'edit');
    });
  }

}
