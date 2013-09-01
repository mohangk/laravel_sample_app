<?php

class Node extends Eloquent {
  use Queryable;
  use Validatable;

	public static $rules = [
		'name' => '',
		'description' => '',
		'layout_id' => 'required',
		'parent_id' => ''
	];

  protected $guarded = [];


  public function layout() {
    return $this->belongsTo('Layout', 'layout_id');
  }

  public function setLayoutAttribute($layout) {
    $this->layout()->associate($layout);
  }

  public function setParentIdAttribute($parent_id) {

    if((int) $parent_id == 0){
      $parent_id = null;
    }

    $this->attributes['parent_id'] = $parent_id;

  }
}
