<?php

use Woodling\Woodling;

Woodling::seed('User', function($blueprint) {
  $faker = Faker\Factory::create();

  $blueprint->name = $faker->name();
  $blueprint->email = $faker->email();
  $blueprint->password = 'whatthehtml';
});

