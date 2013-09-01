<?php

use Woodling\Woodling;

class NodesTableSeeder extends Seeder {

  public function run() {
    DB::table('nodes')->truncate();

    Woodling::saved("Node");
	}

}
