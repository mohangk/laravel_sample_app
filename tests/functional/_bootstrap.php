<?php

// calling:
Artisan::call('migrate:refresh'); 
Artisan::call('db:seed'); 
// actually runs against the testing database... yay

Route::enableFilters();

// Here you can initialize variables that will for your tests
