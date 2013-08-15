<?php

// This is global bootstrap for autoloading

include __DIR__.'/../vendor/autoload.php';

$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'includePaths' => [__DIR__.'/../app/']
]);

$app = require_once __DIR__.'/../bootstrap/start.php';

// seed the production database because that's what acceptance tests run in
Artisan::call('migrate:refresh'); 
Artisan::call('db:seed'); 

// i would like to run 
// Artisan::call("testing:dump") and use the Db module.
