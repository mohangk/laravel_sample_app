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


Route::get(   'login', [ 'uses' => 'SessionsController@create',
                         'as' => 'login' ]                );

Route::post(  'login',  'SessionsController@store'        );
Route::get(   'logout', 'SessionsController@destroy'      );

Route::get(   'signup', 'RegistrationsController@create'  );
Route::post(  'signup', 'RegistrationsController@store'   );

Route::get('/', ['before' => 'auth',
                 'uses' => 'HomeController@showWelcome']);

Route::any('{all}', function($uri){
  return Redirect::to('login');
})->where('all', '.*');
