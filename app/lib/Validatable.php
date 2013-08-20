<?php

use Illuminate\Support\MessageBag;

trait Validatable {

  /**
   * The message bag instance containing validation error messages
   *
   * @var \Illuminate\Support\MessageBag
   */
  public $validationErrors;

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

    $customMessages = static::$customMessages;

    $data = $this->getAttributes(); // the data under validation

    // perform validation
    $validator = Validator::make($data, $rules, $customMessages);
    $success   = $validator->passes();
    $this->validationErrors = $validator->messages();

    return $success;
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
    return $this->validationErrors;
  }

}
