<?php

class SessionsController extends BaseController {

  public function index() {
    return View::make('sessions/index');
  }

  public function store() {
    if(Auth::attempt($this->sessionParams())) {
      return Redirect::route('root');
    } else {
      return Redirect::route('sign-in.index')
        ->withInput()
        ->with('message', 'There was a problem with your email or password.');
    }
  }

  public function destroy() {
    Auth::logout();
    return Redirect::route('sign-in.index');
  }

  private function sessionParams() {
    return Input::only('email', 'password');
  }

}
