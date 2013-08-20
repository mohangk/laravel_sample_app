<?php

class MetricTest extends \Codeception\TestCase\Test {

  use Codeception\Specify;

  protected $metric;

  protected function _before() {
    $this->metric = new Metric(['site_id' => 'ga:123',
                                'date' => '2013-08-01',
                                'type' => 'ga:visits',
                                'count' => 3]);
  }

  public function testValidations() {
    $this->assertTrue($this->metric->isValid());

    $this->specify("site_id is required", function() {
      $this->metric->site_id = null;
      $this->assertFalse($this->metric->isValid());
      $this->assertRegExp('/required/',
                          $this->metric->errors()->first('site_id'));
    });

    $this->specify("date is required", function() {
      $this->metric->date = null;
      $this->assertFalse($this->metric->isValid());
      $this->assertRegExp('/required/',
                          $this->metric->errors()->first('date'));
    });

    $this->specify("type is required", function() {
      $this->metric->type = null;
      $this->assertFalse($this->metric->isValid());
      $this->assertRegExp('/required/',
                          $this->metric->errors()->first('type'));
    });

    $this->specify("count is required", function() {
      $this->metric->count = null;
      $this->assertFalse($this->metric->isValid());
      $this->assertRegExp('/required/',
                          $this->metric->errors()->first('count'));
    });

    $this->specify("count must be a valid integer", function() {
      $this->metric->count = 'foobar';
      $this->assertFalse($this->metric->isValid());
      $this->assertRegExp('/must be an integer/',
                          $this->metric->errors()->first('count'));
    });
  }

  public function testFindOrInitializeBy() {
    $this->site_id = 'ga:123';
    $this->date = '2013-08-08';
    $this->type = 'foobar';
    $this->count = 3;

    $this->specify("it initializes a metric when one isn't found", function() {
      $metric = Metric::findOrInitializeBy(['date' => $this->date, 'type' => $this->type]);
      $this->assertNotNull($metric);
      $this->assertEquals($metric->date->toDateString(), $this->date);
      $this->assertEquals($metric->type, $this->type);
    });

    $this->specify("it retrieves the first metric when they are found", function() {
      $existingMetric = new Metric(['site_id' => $this->site_id, 'date' => $this->date, 'type' => $this->type, 'count' => $this->count]);
      $existingMetric->save();

      $foundMetric = Metric::findOrInitializeBy(['site_id' => $this->site_id, 'date' => $this->date, 'type' => $this->type]);
      $this->assertNotNull($foundMetric);
      $this->assertEquals($foundMetric->id, $existingMetric->id);
      $this->assertEquals($foundMetric->count, $existingMetric->count);
    });
  }


}
