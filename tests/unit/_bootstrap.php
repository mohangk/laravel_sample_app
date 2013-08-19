<?php

// calling:
Artisan::call('migrate:refresh'); 
Artisan::call('db:seed'); 
// actually runs against the testing database... yay

// actually runs against the testing database... yay
// configure codeception's Dbh module to use transactions!
\Codeception\Module\Dbh::$dbh = DB::connection()->getPdo();

// Here you can initialize variables that will for your tests
