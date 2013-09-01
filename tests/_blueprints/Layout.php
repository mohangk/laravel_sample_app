<?php

use Woodling\Woodling;
use Carbon\Carbon;

Woodling::seed('Layout', function($blueprint) {
  $content = <<<'CONTENT'
  {{view_make('cells/users_table', { 'users': users }) | raw }}
  </br>
   {{view_make('cells/metrics_table', {'title': 'Unique visitors:', 'items': uniqueVisitorsByDate }) | raw }}
  </br>
   {{view_make('cells/metrics_table', {'title':  'Pageviews:', 'items': pageviewsByDate }) | raw }}
  </br>
CONTENT;

  $faker = Faker\Factory::create();

  $blueprint->sequence('name', function($i) {
    return "Home Index $i";
  });

  $blueprint->content = $content;

});

