<?php

class HomeController extends BaseController {

  protected $user;

  public function __construct(User $user) { 
      $this->user = $user;
  }

	public function index() {
    $users = $this->user->all();
		return View::make('home')->with('users', $users);
	}

}
