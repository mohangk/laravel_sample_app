<?php

use \Carbon\Carbon;

class Layout extends Eloquent {
  use Validatable;
  use Queryable;

  protected $fillable = array('name', 'content');

  public static $rules = [
    'name' => 'required',
    'content' => 'required',
  ];

  public static $customMessages = [];

}

