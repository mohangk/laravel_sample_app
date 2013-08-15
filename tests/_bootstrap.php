<?php

// This is global bootstrap for autoloading

include __DIR__.'/../vendor/autoload.php';

$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'includePaths' => [__DIR__.'/../app/']
]);

$app = require_once __DIR__.'/../bootstrap/start.php';

// automatically dump the database, except that it 
// keeps the 'production' environment.. fuck
// Artisan::call('testing:dump', ['--env' => 'testing']);
