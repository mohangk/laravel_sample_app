<?php

trait Queryable {

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

  public static function last() {
    return static::orderBy('id', 'DESC')->first();
  }

}
