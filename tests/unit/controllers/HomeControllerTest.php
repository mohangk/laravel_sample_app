<?php

use Woodling\Woodling;

class HomeControllerTest extends ControllerTest {

  use Codeception\Specify;

  public function testIndex() {
    $path = URL::action('HomeController@index', [], false);

    $this->specify("it renders all users", function() use($path) {
      App::instance('User', $userMock = Mockery::mock('User'));

      $users = Woodling::retrieveList('User', 3);
      $userMock->shouldReceive('all')->andReturn($users);

      $response = $this->get($path);
      $this->assertResponseOk();

      foreach($users as $user) {
        $this->assertContains($user->name, $response->getContent());
      }
    });

    $this->specify("it renders all metrics", function() use($path) {
      App::instance('Metric', $metricMock = Mockery::mock('Metric'));

      $pageViews = Woodling::retrieveList("Metric", 3, [ 'type' => Metric::PAGEVIEWS ]);
      $metricMock->shouldReceive('pageViews')->andReturn($pageViews);

      $uniqueVisitors = Woodling::retrieveList("Metric", 3, [ 'type' => Metric::UNIQUE_VISITORS ]);
      $metricMock->shouldReceive('uniqueVisitors')->andReturn($uniqueVisitors);

      $response = $this->get($path);
      $this->assertResponseOk();

      foreach($uniqueVisitors as $uniqueVisits) {
        $this->assertContains(strval($uniqueVisits->count), $response->getContent());
      }
      foreach($pageViews as $pageView) {
        $this->assertContains(strval($pageView->count), $response->getContent());
      }
    });
  }

}
