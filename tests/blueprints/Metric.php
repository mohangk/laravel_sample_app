<?php

use Woodling\Woodling;

Woodling::seed('Metric', function($blueprint)
{
  $faker = Faker\Factory::create();

  $blueprint->sequence('site_id', function($i)
  {
      return "ga:{$i}";
  });
  $blueprint->date = $faker->date();
  # TODO: can't reference Metric's const here T_T
  # TODO: this freaking randomElement doesn't work
  #$blueprint->type = $faker->randomElement(['ga:pageviews', 'ga:visitors']);
  $blueprint->type = 'ga:pageviews';
  $blueprint->count = $faker->randomNumber();
});

