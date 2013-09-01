<?php

use Woodling\Woodling;
use Carbon\Carbon;



class LayoutTableSeeder extends Seeder {

  public function run() {
$content = <<<'CONTENT'
  {{view_make('cells/users_table', { 'users': users }) | raw }}
  </br>
   {{view_make('cells/metrics_table', {'title': 'Unique visitors:', 'items': uniqueVisitorsByDate }) | raw }}
  </br>
   {{view_make('cells/metrics_table', {'title':  'Pageviews:', 'items': pageviewsByDate }) | raw }}
  </br>
CONTENT;

    DB::table('layouts')->truncate();

    $layout = new Layout(['name' =>'home/index.twig', 'content'=> $content]);
    $layout->save();

    $layout_count = Layout::count();
    $this->command->info("Layout table seeded with $layout_count entries.");
  }
}
