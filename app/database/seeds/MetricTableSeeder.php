<?php

use Woodling\Woodling;
use Carbon\Carbon;

class MetricTableSeeder extends Seeder {

  public function run() {
    DB::table('metrics')->truncate();

    $date = Carbon::today();
    $daysToSeed = 30;

    while($daysToSeed) {
      $pageviews = rand(10,50);
      $uniqueVisitors = rand(1, $pageviews);

      Woodling::saved("Metric", [ 'date' => $date, 'type' => Metric::PAGEVIEWS ]);
      Woodling::saved("Metric", [ 'date' => $date, 'type' => Metric::UNIQUE_VISITORS ]);

      $date->subDay();
      $daysToSeed -= 1;
    }

    $metric_count = Metric::count();
    $this->command->info("Metric table seeded with $metric_count entries.");
  }
}
