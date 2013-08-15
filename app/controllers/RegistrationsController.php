<?php

class RegistrationsController extends BaseController {

  public function create() {
    return View::make('registrations/create');
  }

  public function store() {
    $userParams = array(
      'name' => Input::get('name'),
      'email' => Input::get('email'),
      'password' => Hash::make(Input::get('password'))
    );

    $user = new User($userParams);
    if($user->save()) {
      Auth::login($user);
      return Redirect::to('/');
    } else {
      return Redirect::to('sign-in');
    }
    
  }

}
