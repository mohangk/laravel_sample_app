<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SyncGoogleAnalytics extends Command {

	protected $name = 'analytics:sync';

	protected $description = 'Sync Google analytics metrics';

	public function fire() {
    $this->info("$this->name is running as ".App::environment());
    $this->info("Syncing data for the past {$this->argument('syncDays')} days");

    foreach(Analytics::getAllSitesIds() as $url => $siteId)
    {
        $result = Analytics::query(
          $siteId,
          date('Y-m-d', strtotime("-{$this->argument('syncDays')} day")),
          date('Y-m-d'),
          'ga:visits,ga:uniquePageviews',
          array('dimensions' => 'ga:date')
        );


        $headerNames = array();

        foreach($result->getColumnHeaders() as $header)
        {
          array_push($headerNames, $header->getName());
        }


        foreach($result->getRows() as $row)
        {
          $data = (array_combine($headerNames, $row));
          $date = DateTime::createFromFormat('Ymd', $data['ga:date']);

          $m = Metric::findOrInitializeBy([
            'date'=>$date,
            'type'=>'ga:visits',
            'site_id'=>$siteId]);

          $m->count = $data['ga:visits'];
          $m->save();

          $m = Metric::findOrInitializeBy([
            'date'=>$date,
            'type'=>'ga:uniquePageViews',
            'site_id'=>$siteId]);
          $m->count = $data['ga:uniquePageviews'];
          $m->save();

        }
    }


    $this->comment("complete");
	}


	protected function getArguments() {
		return [['syncDays', InputArgument::OPTIONAL, 'Sync for data for the past N days', 10]];
	}


}
