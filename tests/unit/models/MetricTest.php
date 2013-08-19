<?php

use AspectMock\Test as test;

class MetricTest extends \Codeception\TestCase\Test {

  protected $metric;

  protected function _before() {
    $this->metric = new Metric(['site_id' => 'ga:123',
                                'date' => '2013-08-01',
                                'type' => 'ga:visits',
                                'count' => 3]);
  }

  protected function _after() {
    test::clean();
  }

  public function testRequiresDate() {
    $this->assertTrue($this->metric->valid());
    $this->metric->date = 'foobar';
    $this->assertFalse($this->metric->valid());
  }

  public function testRequiresType() {
    $this->assertTrue($this->metric->valid());
    $this->metric->type = null;
    $this->assertFalse($this->metric->valid());
  }

  public function testRequiresCount() {
    $this->assertTrue($this->metric->valid());
    $this->metric->count = 'foobar';
    $this->assertFalse($this->metric->valid());
  }

  public function testFindOrInitialize() {
    // when something doesn't exist, it news one up
    $site_id = 'ga:123';
    $date = '2013-08-08';
    $type = 'foobar';
    $count = 3;

    $metric = Metric::findOrInitializeBy(['date' => $date, 'type' => $type]);
    $this->assertNotNull($metric);
    $this->assertEquals($metric->date, $date);
    $this->assertEquals($metric->type, $type);

    // when the metric already exists, it finds it
    $existingMetric = new Metric(['site_id' => $site_id, 'date' => $date, 'type' => $type, 'count' => $count]);
    $existingMetric->save();

    $foundMetric = Metric::findOrInitializeBy(['site_id' => $site_id, 'date' => $date, 'type' => $type]);
    $this->assertNotNull($foundMetric);
    $this->assertEquals($foundMetric->id, $existingMetric->id);
    $this->assertEquals($foundMetric->count, $existingMetric->count);
  }


}
