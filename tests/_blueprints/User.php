<?php

use Woodling\Woodling;
use Carbon\Carbon;

Woodling::seed('User', function($blueprint) {
  $faker = Faker\Factory::create();

  $blueprint->email = function() use($faker) { return $faker->email(); };
  $blueprint->password = function() { return Hash::make('password'); };
  $blueprint->name = function() use($faker) { return $faker->name(); };
  $blueprint->created_at = Carbon::now();
  $blueprint->updated_at = Carbon::now();

});

