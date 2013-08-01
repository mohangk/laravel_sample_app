<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', array('before' => 'auth',
                      'uses' => 'HomeController@showWelcome'));

Route::get('login', function(){
  echo '<form method="POST" action ="' . URL::to('login') .'">';
  echo '<p><input type="text" id="email" name="email" placeholder="email"/></p>';
  echo '<p><input type="password" id="password" name="password"/></p>';
  echo '<p><input type="submit" value="Log In"/></p>';
  echo '</form>';
});

Route::post('login', function(){
  $userParams = array(
    'email' => Input::get('email'),
    'password' => Input::get('password')
  );

  if(Auth::attempt($userParams)) {
    return Redirect::to('/');
  } else {
    return Redirect::to('login');
  }
});

Route::get('signup', function(){
  echo '<form method="POST" action ="' . URL::to('signup') .'">';
  echo '<p><input type="text" id="name" name="name" placeholder="name"/></p>';
  echo '<p><input type="text" id="email" name="email" placeholder="email"/></p>';
  echo '<p><input type="password" id="password" name="password"/></p>';
  echo '<p><input type="password" id="password_confirmation" name="password_confirmation"/></p>';
  echo '<p><input type="submit" value="Log In"/></p>';
  echo '</form>';
});

Route::post('signup', function(){
  $userParams = array(
    'name' => Input::get('name'),
    'email' => Input::get('email'),
    'password' => Hash::make(Input::get('password'))
  );

  $user = new User($userParams);
  $user->save();
  return Redirect::to('login');
});

Route::get('logout', function(){
  Auth::logout();
  return Redirect::to('login');
});

Route::any('{all}', function($uri){
  return Redirect::to('login');
})->where('all', '.*');
