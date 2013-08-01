<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->client->request('GET', '/');

    echo print_r($this->client);
    echo print_r(get_class_methods($this->client));
    $this->assertTrue($this->client->getResponse()->isOk());

	}

}
