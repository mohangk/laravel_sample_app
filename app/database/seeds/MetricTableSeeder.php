<?php

class MetricTableSeeder extends Seeder {

  public function run() {

    $this->command->info("The environment is ".App::environment());

    DB::table('metrics')->delete();

    Metric::create([
      'date'=>'2012-12-12',
      'type'=>'ga:visits',
      'count'=>5,
      'site_id'=>'ga:123']);

    $metric_count = Metric::count();
    $this->command->info("Metric table seeded with $metric_count entries.");
  }
}
