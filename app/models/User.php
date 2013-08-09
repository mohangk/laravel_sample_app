<?php

use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface {

  public $errors;

  public static $rules = [
    'name' => 'required',
    'email' => 'required|unique:users|email'
  ];

  protected $fillable = array('name', 'email', 'password');

  public function validate() {
    $v = Validator::make($this->attributes, static::$rules); if ($v->passes()) return true;
    $this->errors = $v->messages();
    return false;
  } 

	/**
   * UserInterface requires:
   *   - getAuthIdentifier
   *   - getAuthPassword
	 */
	public function getAuthIdentifier() {
		return $this->getKey();
	}

	public function getAuthPassword() {
		return $this->password;
	}


}

