<?php

// This is global bootstrap for autoloading

include __DIR__.'/../vendor/autoload.php';
putenv("LARAVEL_ENV=testing");
$app = require_once __DIR__.'/../bootstrap/start.php';

Artisan::call('migrate:refresh');
Artisan::call('db:seed');
Artisan::call('db:dump');
