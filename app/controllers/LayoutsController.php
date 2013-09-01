<?php

class LayoutsController extends BaseController {

  public function index() {
		$layouts = App::make('Layout')->all();
		return View::make('layouts/index', compact('layouts'));
  }

  public function create() {
    $layout = App::make('Layout');
    $scopes = ['scope1', 'scope2'];
    return View::make('layouts/create', compact('layout', 'scopes'));
  }

  public function store() {
    $layout = App::make('Layout');
    $layout->fill($this->layoutParams());

    if($layout->save()) {
      return Redirect::route('layouts.edit', ['layouts' => $layout->id]);
    } else {
      return Redirect::route('layouts.create')
        ->withInput()
        ->withErrors($layout->errors())
        ->with('message', 'There were validation errors.');
    }
  }

	public function edit($id) {
    $layout = App::make('Layout')->findOrFail($id);
    $scopes = ['scope1', 'scope2'];
		return View::make('layouts.edit', compact('layout','scopes'));
	}

	public function update($id) {
    $layout = App::make('layout')->findOrFail($id);
    $layout->fill($this->layoutParams());

		if ($layout->save()) {
			return Redirect::route('layouts.edit', ['layouts' => $id])
			  ->with('message', 'Updated layout');
		}

		return Redirect::route('layouts.edit', ['layouts' => $id])
			->withInput()
			->withErrors($layout->errors())
			->with('message', 'There were validation errors.');
	}

  private function layoutParams() {
    return Input::only('name', 'content');
  }

}
