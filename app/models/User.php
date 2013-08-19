<?php

use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface {
  use Authable;
  use Validatable;

  public static $rules = [
    'name' => 'required',
    'email' => 'required|unique:users|email'
    ];

  public static $customMessages = [];

  protected $fillable = array('name', 'email', 'password',
                              'google_access_token', 'google_access_token_expires_at', 'google_photoURL');

  public function getAuthPassword() {
		return $this->password;
  }

  // hook to call save only if $this->valid() and return the valid result?

}

