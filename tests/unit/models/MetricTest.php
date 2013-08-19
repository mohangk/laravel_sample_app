<?php

use AspectMock\Test as test;

class MetricTest extends \Codeception\TestCase\Test {

  protected $metric;

  protected function _before() {
    $this->metric = new Metric(['type' => 'ga:visits',
                                'date' => '2013-08-01',
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

  public function testSave(){
    $this->assertTrue($this->metric->save());
    $this->assertNotNull($this->metric->id);
  }

}
