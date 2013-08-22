<?php

use Woodling\Woodling;

class MetricTest extends \Codeception\TestCase\Test {

  use Codeception\Specify;

  public function testFactory() {
    $metric = Woodling::retrieve('Metric');

    $this->specify("should be valid", function() use($metric) {
      $this->assertTrue($metric->isValid());
    });
  }

  public function testValidations() {
    $this->specify("site_id is required", function() {
      $metric = Woodling::retrieve('Metric', ['site_id' => null]);
      $metric->site_id = null; # TODO: can't override sequence T_T
      $this->assertFalse($metric->isValid());
      $this->assertRegExp('/required/',
                          $metric->errors()->first('site_id'));
    });

    $this->specify("date is required", function() {
      $metric = Woodling::retrieve('Metric', ['date' => null]);
      $this->assertFalse($metric->isValid());
      $this->assertRegExp('/required/',
                          $metric->errors()->first('date'));
    });

    $this->specify("type is required", function() {
      $metric = Woodling::retrieve('Metric', ['type' => null]);
      $this->assertFalse($metric->isValid());
      $this->assertRegExp('/required/',
                          $metric->errors()->first('type'));
    });

    $this->specify("count is required", function() {
      $metric = Woodling::retrieve('Metric', ['count' => null]);
      $this->assertFalse($metric->isValid());
      $this->assertRegExp('/required/',
                          $metric->errors()->first('count'));
    });

    $this->specify("count must be a valid integer", function() {
      $metric = Woodling::retrieve('Metric', ['count' => 'foobar']);
      $this->assertFalse($metric->isValid());
      $this->assertRegExp('/must be an integer/',
                          $metric->errors()->first('count'));
    });
  }

  public function testFindOrInitializeBy() {
    $this->specify("when one isn't found, it initializes a metric ", function() {
      $attr = array_only(Woodling::retrieve('Metric')->getAttributes(), ['site_id', 'type', 'date', 'count']);
      $metric = Metric::findOrInitializeBy($attr);
      $this->assertTrue($metric->isValid());
      $this->assertEquals($metric->date, $attr['date']);
      $this->assertEquals($metric->type, $attr['type']);
    });

    $this->specify("when one is found, it retrieves the first metric", function() {
      $existingMetric = Woodling::saved('Metric');

      $foundMetric = Metric::findOrInitializeBy(array_only($existingMetric->getAttributes(), ['site_id', 'type', 'date', 'count']));
      $this->assertNotNull($foundMetric);
      $this->assertEquals($foundMetric->id, $existingMetric->id);
      $this->assertEquals($foundMetric->count, $existingMetric->count);
    });
  }


}
