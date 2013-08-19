<?php

class RegistrationsController extends BaseController {

  public function create() {
    return View::make('registrations/create');
  }

  public function store() {
    $user = new User($this->registrationParams());

    if($user->save()) {
      Auth::login($user);
      return Redirect::to('/');
    } else {
      return Redirect::to('sign-up')
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
