<?php
use \Carbon\Carbon as Carbon;

class MetricTableSeeder extends Seeder {

  public function run() {

    $this->command->info("The environment is ".App::environment());

    DB::table('metrics')->delete();

    $date = Carbon::today();
    $daysToSeed = 30;

    while($daysToSeed) {
      $pageviews = rand(10,50);
      $uniqueVisitors = rand(1, $pageviews);

      Metric::create([
        'date'=> $date,
        'type'=> Metric::PAGEVIEWS,
        'count'=> $pageviews,
        'site_id'=>'ga:123']);

      Metric::create([
        'date'=> $date,
        'type'=> Metric::UNIQUE_VISITORS,
        'count'=> $uniqueVisitors,
        'site_id'=>'ga:123']);

      $date->subDay();
      $daysToSeed -= 1;
    }

    $metric_count = Metric::count();
    $this->command->info("Metric table seeded with $metric_count entries.");
  }
}
