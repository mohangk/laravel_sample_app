<?php

use Woodling\Woodling;
use Carbon\Carbon;

Woodling::seed('Node', function($blueprint) {
  $faker = Faker\Factory::create();

  $blueprint->name = function() use($faker) { return $faker->sentence(); };
  $blueprint->description = function() use($faker) { return $faker->sentence(); };
  $blueprint->layout = function() { return Woodling::saved('Layout'); };
  $blueprint->created_at = Carbon::now();
  $blueprint->updated_at = Carbon::now();
});

