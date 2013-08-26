<?php

class LayoutsController extends BaseController {

  const NAME = "home/index.twig";

  public function index() {
    return Redirect::route('layouts.create');
  }

  public function create() {
    $layout = App::make('Layout')->findOrInitializeBy(['name' => static::NAME]);
    $scopes = ['scope1', 'scope2'];
    return View::make('layouts/create', compact('layout', 'scopes'));
  }

  public function store() {
    $layout = App::make('Layout')->findOrInitializeBy(['name' => static::NAME]);
    $layout->fill($this->layoutParams());

    if($layout->save()) {
      return Redirect::route('layouts.create');
    } else {
      return Redirect::route('layouts.create')
        ->withInput()
        ->withErrors($layout->errors())
        ->with('message', 'There were validation errors.');
    }
  }

  private function layoutParams() {
    return Input::only('name', 'content');
  }

}
