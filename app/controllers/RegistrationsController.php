<?php

class RegistrationsController extends BaseController {

  public function index() {
    return View::make('registrations/index');
  }

  public function store() {
    $user = new User($this->registrationParams());

    if($user->save()) {
      Auth::login($user);
      return Redirect::route('root');
    } else {
      return Redirect::route('sign-up.index')
        ->withInput()
        ->withErrors($user->errors)
        ->with('message', 'There were validation errors.');
    }

  }

  private function registrationParams() {
    $params = Input::only('name', 'email', 'password');
    $params['password'] = Hash::make($params['password']);
    return $params;
  }

}
