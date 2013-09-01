<?php

class Node extends Eloquent {
  use Queryable;
  use Validatable;

	public static $rules = [
		'name' => '',
		'description' => '',
		'layout_id' => '',
		'parent_id' => ''
	];

  protected $guarded = [];


  public function layout() {
    return $this->belongsTo('Layout', 'layout_id');
  }

  public function setLayoutAttribute($layout){
    $this->layout()->associate($layout);
  }
}
