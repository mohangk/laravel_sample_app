<?php

class NodesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$nodes = App::make('Node')->all();
		return View::make('nodes.index', compact('nodes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
    $node = App::make('Node');
		return View::make('nodes.create', compact('node'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
    $node = App::make('Node');
    $node->fill($this->nodeParams());

		if ($node->save()) {
			return Redirect::route('nodes.show', ['nodes' => $node->id]);
		}

		return Redirect::route('nodes.create')
			->withInput()
			->withErrors($node->errors())
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
    $node = App::make('Node')->findOrFail($id);
		return View::make('nodes.show', compact('node'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
    $node = App::make('Node')->findOrFail($id);
		return View::make('nodes.edit', compact('node'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
    $node = App::make('Node')->findOrFail($id);
    $node->fill($this->nodeParams());

		if ($node->save()) {
			return Redirect::route('nodes.show', ['nodes' => $id]);
		}

		return Redirect::route('nodes.edit', ['nodes' => $id])
			->withInput()
			->withErrors($node->errors())
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		App::make('Node')->findOrFail($id)->delete();
		return Redirect::route('nodes.index');
	}

    private function nodeParams() {
      throw new Exception("FIXME: specify the permitted parameters");
      return Input::only([]);
    }

}
