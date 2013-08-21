<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AnalyticsSync extends Command {

	protected $name = 'analytics:sync';

	protected $description = 'Sync Google analytics metrics';

	public function fire() {
    $this->info("$this->name is running as ".App::environment());
    $this->info("Syncing data for the past {$this->argument('syncDays')} days");

    // We will need to relook at how we are calculating unique visitiors
    // http://analytics.blogspot.sg/2011/02/mastering-unique-visitors-in-api.html
    // https://support.google.com/analytics/answer/2992042?hl=en

    foreach(Analytics::getAllSitesIds() as $url => $siteId)
    {
        $result = Analytics::query(
          $siteId,
          date('Y-m-d', strtotime("-{$this->argument('syncDays')} day")),
          date('Y-m-d'),
          Metric::PAGEVIEWS.','.Metric::UNIQUE_VISITORS,
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
            'type'=> Metric::UNIQUE_VISITORS,
            'site_id'=>$siteId]);
          $m->count = $data[Metric::UNIQUE_VISITORS];
          $m->save();

          $m = Metric::findOrInitializeBy([
            'date'=>$date,
            'type'=>Metric::PAGEVIEWS,
            'site_id'=>$siteId]);
          $m->count = $data[Metric::PAGEVIEWS];
          $m->save();

        }
    }


    $this->comment("complete");
	}


	protected function getArguments() {
		return [['syncDays', InputArgument::OPTIONAL, 'Sync for data for the past N days', 10]];
	}


}
