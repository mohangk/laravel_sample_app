<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Database Override
	|--------------------------------------------------------------------------
  |
  | Use a test database that can be reset and rolled back.
	|
	*/

	'connections' => array(
		'pgsql' => array(
			'driver'   => 'pgsql',
			'host'     => 'localhost',
			'database' => 'laravel_sample_app_test',
			'charset'  => 'utf8',
			'prefix'   => '',
			'schema'   => 'public',
		),
	),

);
