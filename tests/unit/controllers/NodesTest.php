<?php

use Woodling\Woodling;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NodesTest extends ControllerTest {

	public function testIndex() {
    $path = URL::action('NodesController@index', [], false);

    $this->specify("it renders the view", function() use($path) {
      $response = $this->get($path);
      $this->assertResponseOk();
      $this->assertViewHas('nodes');
      $this->assertContains('table', $response->getContent());
    });
	}

	public function testCreate() {
    $path = URL::action('NodesController@create', [], false);

    $this->specify("renders the view", function() use($path) {
      $response = $this->get($path);
      $this->assertResponseOk();
      $this->assertViewHas('node');
      $this->assertContains('form', $response->getContent());
    });
	}

	public function testStore() {
    $path = URL::action('NodesController@store', [], false);

    $this->specify("when valid, it persists the node and redirects", function() use($path) {
      $node = Woodling::retrieve('Node');
      $validInputs = array_except($node->getAttributes(), ['updated_at', 'created_at']);

      $response = $this->post($path, $validInputs);
		  $this->assertRedirectedToRoute('nodes.show', ['nodes' => Node::last()->id]);
    });

    $this->specify("when invalid, it flashes errors and redirects", function() use($path) {
      $invalidInputs = [];

      $response = $this->post($path, $invalidInputs);
      $this->assertRedirectedToRoute('nodes.create');
      $this->assertSessionHasErrors();
      $this->assertSessionHas('message');
    });
	}

	public function testShow() {
    $node = Woodling::saved('Node');
    $path = URL::action('NodesController@show', ['nodes' => $node->id], false);

    $this->specify("renders the view", function() use($path, $node) {
      $response = $this->get($path);
      $this->assertResponseOk();
      $this->assertViewHas('node');
      $this->assertContains('table', $response->getContent());
    });

    $this->specify("when not found, throws an exception", function() use($path, $node) {
      $nodeMock = Mockery::mock('Vertical')->makePartial();
      $nodeMock->shouldReceive('findOrFail')->andThrow(new ModelNotFoundException);
      App::instance('Node', $nodeMock);

      $this->setExpectedException('Illuminate\Database\Eloquent\ModelNotFoundException');
      $response = $this->get($path);
    });
  }

	public function testEdit() {
    $node = Woodling::saved('Node');
    $path = URL::action('NodesController@edit', ['nodes' => $node->id], false);

    $this->specify("renders the view", function() use($node, $path) {
      $response = $this->get($path);
      $this->assertResponseOk();
      $this->assertViewHas('node');
      $this->assertContains('form', $response->getContent());
    });
	}

	public function testUpdate() {
    $node = Woodling::saved('Node');
    $path = URL::action('NodesController@update', ['nodes' => $node->id], false);

    $this->specify("when valid, it persists the node and redirects", function() use($path, $node) {
      $validInputs = array_except($node->getAttributes(), ['updated_at', 'created_at']);

      $response = $this->put($path, $validInputs);
      $this->assertRedirectedToRoute('nodes.show', ['nodes' => $node->id]);
    });

    $this->specify("when invalid, it flashes errors and redirects", function() use($path, $node) {
      $invalidInputs = [];

      $response = $this->put($path, $invalidInputs);
      $this->assertRedirectedToRoute('nodes.edit', ['nodes' => $node->id]);
      $this->assertSessionHasErrors();
      $this->assertSessionHas('message');
    });
	}

	public function testDestroy() {
    $node = Woodling::saved('Node');
    $path = URL::action('NodesController@destroy', ['nodes' => $node->id], false);

    $this->specify("calls delete on the node", function() use($path, $node) {
      $response = $this->delete($path);
      $this->assertRedirectedToRoute('nodes.index');
    });
	}

}
