<?php

class SessionsController extends BaseController {

  public function create() {
    return View::make('sessions/create');
  }

  public function store() {
    if(Auth::attempt($this->sessionParams())) {
      return Redirect::to('/');
    } else {
      return Redirect::to('sign-in')
        ->withInput()
        ->with('message', 'There was a problem with your email or password.');
    }
  }

  public function destroy() {
    Auth::logout();
    return Redirect::to('sign-in');
  }

  private function sessionParams() {
    return Input::only('email', 'password');
  }

}
