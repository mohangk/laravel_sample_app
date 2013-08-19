<?php

trait Validatable {

  public $errors;

  public function valid() {
    $v = Validator::make($this->attributes, static::$rules);

    if ($v->passes()) {
      return true;
    }

    $this->errors = $v->messages();
    return false;
  }

}
