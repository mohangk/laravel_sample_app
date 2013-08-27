<?php

class DummyModel {
  use Validatable;

  public static $customMessages = ['content.required' => "Custom message ':attribute'."];

  protected $fillable = array('name', 'content');

  public static $rules = [
    'name' => 'required',
    'content' => 'required',
  ];

  public $dummyAttributes = [];

  function __construct($attributes) {
    $this->dummyAttributes = $attributes;
  }

  function getAttributes() {
    return $this->dummyAttributes;
  }

}

class ValidatableTest extends LibTest {


  public function test_isValid() {
    $dummyModel = new DummyModel(['name' => 'Superawesometomto']);

    $this->specify('when there is a validation_error, it returns false', function() use($dummyModel) {
      $this->assertFalse($dummyModel->isValid());
    });

    $dummyModel = new DummyModel(['name' => 'Superawesometomto', 'content'=>'Tommy']);
    $this->specify('when there are no validation errors, it returns true', function() use($dummyModel) {
      $this->assertTrue($dummyModel->isValid());
    });

  }

  public function test_getCustomMessages() {
    $dummyModel = new DummyModel(['name' => 'Superawesometomto']);

    $dummyModel->isValid();
    $this->specify('when $customMessage is defined on the model, it uses it', function() use($dummyModel) {
      $this->assertArrayHasKey('content.required', $dummyModel->getCustomMessages());
    });
  }

  public function test_errors() {
    $dummyModel = new DummyModel(['name' => 'Superawesometomto']);

    $dummyModel->isValid();
    $this->specify('it uses custom messages', function() use($dummyModel) {
      $this->assertRegExp('/Custom message/', $dummyModel->errors()->first('content'));
    });

  }

}

