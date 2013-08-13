<?php

class SessionsController extends BaseController {

  public function create() {
    return View::make('sessions/create');
  }

  public function store() {
    $userParams = array(
      'email' => Input::get('email'),
      'password' => Input::get('password')
    );

    if(Auth::attempt($userParams)) {
      return Redirect::to('/');
    } else {
      return Redirect::to('sign-in');
    }
  }

  public function destroy() {
    Auth::logout();
    return Redirect::to('sign-in');
  }

}
