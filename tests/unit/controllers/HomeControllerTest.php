<?php

class HomeControllerTest extends ControllerTest {

  use Codeception\Specify;

  public function testIndex() {
    $this->path = URL::action('HomeController@index', [], false);

    $this->specify("it renders all users", function() {
      $user = new User(['name' => 'Sean Carter',
                        'email' => 'jay-z@example.com',
                        'password' => 'password',
                        'created_at' => new DateTime(),
                        'updated_at' => new DateTime()]);

      App::instance('User', Mockery::mock('User', ['all' => [$user]]));

      $response = $this->get($this->path);
      $this->assertResponseOk();
      $this->assertContains('Sean Carter', $response->getContent());
    });

    $this->specify("it renders all metrics", function() {
      $metricMock = Mockery::mock('Metric');

      $uniqueVisitor = new Metric(['date' => new DateTime(), 'count' => 31337 ]);
      $metricMock->shouldReceive('uniqueVisitors')->andReturn([$uniqueVisitor]);

      $pageView = new Metric(['date' => new DateTime(), 'count' => 1234567 ]);
      $metricMock->shouldReceive('pageViews')->andReturn([$pageView]);

      App::instance('Metric', $metricMock);

      $response = $this->get($this->path);
      $this->assertResponseOk();
      $this->assertContains(strval($uniqueVisitor->count), $response->getContent());
      $this->assertContains(strval($pageView->count), $response->getContent());
    });
  }

}
