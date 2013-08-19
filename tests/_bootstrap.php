<?php

// This is global bootstrap for autoloading

include __DIR__.'/../vendor/autoload.php';

$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'includePaths' => [__DIR__.'/../app/']
]);

$app = require_once __DIR__.'/../bootstrap/start.php';


// calling:
Artisan::call('migrate:refresh'); 
Artisan::call('db:seed'); 
// actually runs against the PRODUCTION database... BOOOoo! 
// unfortunately, acceptance tests run against that database
// so that's what we'll seed for now

// I would like to run 
// Artisan::call("testing:dump") and use the Db module.
