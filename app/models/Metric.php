<?php

class Metric extends Eloquent {
  use Validatable;

  protected $fillable = array('date', 'site_id', 'type', 'count');

  public static $rules = [
    'site_id' => 'required',
    'date' => 'required|date',
    'type' => 'required',
    'count' => 'required|integer'
  ];


  // public function getDates() {
  //   return ['created_at', 'update_at', 'date'];
  // }

  public static function findOrInitializeBy($whereArray) {
    $query = (new static)->newQuery();
    foreach($whereArray as $column => $value) {
      $query = $query->where($column, '=', $value);
    }

    if($metric = $query->first()) {
      return $metric;
    } else {
      return new static($whereArray);
    }
  }

}

