<?php

class Metric extends Eloquent {
  use Validatable;

  public static $rules = [
    'date' => 'required|date',
    'type' => 'required',
    'count' => 'required|integer'
  ];


}

