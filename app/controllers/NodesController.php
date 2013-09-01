<?php

class NodesController extends BaseController {

	public function index() {
		$nodes = App::make('Node')->all();
		return View::make('nodes.index', compact('nodes'));
	}

	public function create() {
    $node = App::make('Node');
		return View::make('nodes.create', compact('node'));
	}

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

	public function show($id) {
    $node = App::make('Node')->findOrFail($id);

    //This is a temporary hack, scopes will need to be dynamically
    //loaded based on the scopes that are associated with a layout or node
    $users = App::make('User')->all();
    $uniqueVisitorsByDate = App::make('Metric')->uniqueVisitors();
    $pageviewsByDate = App::make('Metric')->pageViews();

    $scopes = [ 'users' => $users,
               'uniqueVisitorsByDate' => $uniqueVisitorsByDate,
               'pageviewsByDate' => $pageviewsByDate];

		return View::make('nodes.show', compact('node', 'scopes'));
	}

	public function edit($id) {
    $node = App::make('Node')->findOrFail($id);
		return View::make('nodes.edit', compact('node'));
	}

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

	public function destroy($id) {
		App::make('Node')->findOrFail($id)->delete();
		return Redirect::route('nodes.index');
	}

  private function nodeParams() {
    return Input::only(['name','description','layout_id','parent_id']);
  }

}
