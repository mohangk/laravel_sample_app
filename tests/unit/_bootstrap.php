<?php

// configure codeception's Dbh module to use transactions!
\Codeception\Module\Dbh::$dbh = DB::connection()->getPdo();

// Here you can initialize variables that will for your tests
