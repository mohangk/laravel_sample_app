<?php

use Illuminate\Support\MessageBag;

trait Validatable {


  /**
   * The message bag instance containing validation error messages
   *
   * @var \Illuminate\Support\MessageBag
   */
  private $errors;

  /**
   * Validate the model instance
   *
   * @return bool
   */
  public function isValid() {
    $rules = static::$rules;

    // clear empty rules
    foreach ($rules as $field => $rls) {
      if ($rls == '') {
        unset($rules[$field]);
      }
    }

    $data = $this->getAttributes(); // the data under validation

    // perform validation
    $validator = Validator::make($data, $rules, $this->getCustomMessages());
    $success   = $validator->passes();
    $this->errors = $validator->errors();

    return $success;
  }

  public function getCustomMessages() {
    return isset(static::$customMessages) ? static::$customMessages : [];
  }
  /**
   * Save the model to the database.
   *
   * @param array   $options
   *
   * @return bool
   */
  public function save(array $options = array()) {
    if ($this->isValid()) {
      return parent::save($options);
    } else {
      return false;
    }
  }

  /**
   * Get validation error message collection for the Model
   *
   * @return \Illuminate\Support\MessageBag
   */
  public function errors() {
    return $this->errors;
  }

}
