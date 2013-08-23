<?php

use Woodling\Woodling;
use Carbon\Carbon;

Woodling::seed('Metric', function($blueprint) {
  $faker = Faker\Factory::create();

  $blueprint->site_id = 'ga:123';
  $blueprint->date = function() use($faker) { return $faker->date(); };

  $blueprint->type = function() use($faker) {
    return $faker->randomElement([\Metric::PAGEVIEWS, \Metric::UNIQUE_VISITORS]);
  };

  $blueprint->count = function() use($faker) { return $faker->randomNumber(10, 50); };
  $blueprint->created_at = Carbon::now();
  $blueprint->updated_at = Carbon::now();
});

// TODO: inheriting from blueprints?
// Woodling::seed('PageViews', ['class' => 'Metric', 'do' => function($blueprint) {
//   Woodling::retrieve('Metric', array_merge(['type' => \Metric::PAGEVIEWS], $blueprint));
// }]);
// 
// Woodling::seed('UniqueVisitors', ['class' => 'Metric', 'do' => function($blueprint) {
//   Woodling::retrieve('Metric', array_merge(['type' => \Metric::UNIQUE_VISITORS], $blueprint));
// }]);
// 
