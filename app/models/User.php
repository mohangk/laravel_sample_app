<?php

use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface {
  use Authable;
  use Validatable;

  public static $rules = [
    'name' => 'required',
    'email' => 'required|unique:users|email'
  ];

  protected $fillable = array('name', 'email', 'password');

  public function getAuthPassword()
	{
		return $this->password;
	}

}

