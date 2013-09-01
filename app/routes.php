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

Route::resource('sign-in', 'SessionsController',
                ['only' => ['index', 'store', 'destroy']]);

Route::get(   'sign-out', 'SessionsController@destroy'      );

Route::get(   'sign-in/hybrid/{action?}', [ 'uses' => 'Sessions\HybridController@create',
                                            'as' => 'hybridauth' ]);

Route::resource('sign-up', 'RegistrationsController',
                ['only' => ['index', 'store']]);

Route::get('/', [ 'uses' => 'HomeController@index',
                  'as' => 'root']);

Route::resource('nodes', 'NodesController');

Route::resource('layouts', 'LayoutsController');

/*
 * This is useful, but it makes debugging in development hard as Laravel does no route related logging
 * Must figure out how to do this only in Production
Route::any('{all}', function($uri){
  return Redirect::route('sign-in.index');
})->where('all', '.*');
*/


