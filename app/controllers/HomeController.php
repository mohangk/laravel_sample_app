<?php

class HomeController extends BaseController {

  public function index() {
    $users = App::make('User')->all();
		return View::make('home')->with('users', $users);
	}

}
