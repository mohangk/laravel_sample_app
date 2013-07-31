# Our sample Laravel app

## Setup:

- Create the database `laravel_sample_app_development` manually with `psql`.  
- Install migrations `php artisan migrate:install`
- Migrate and seed the database `php artisan migrate --seed`

## Start the application:

	$ php artisan serve

or

	$ php -S localhost:8000 server.php


## Console:

Laravel has a default console - `tinker` - but it's not very nice.  Use `boris` instead:

	php artisan boris
	> User::all();

## Testing

PHPUnit has been vendored.  To run the test execute

    ./vendor/bin/phpunit

That's quite verbose so it's recommended you add an alias in your shell.
In order to debug a spec do: DEBUGGER.!!

  1. Feature spec.
    - capybara page
    - factories: https://packagist.org/packages/breerly/factory-girl-php (might not work with Laravel ORM ?)

  2. (optional) Add any new dependencies to vendor and composer.json at the same time
    
  		composer require davejamesmiller/laravel-boris dev-master

  3. Controller spec.
  4. Unit spec.

# Setting up a fresh project

1. Install phpenv - `https://github.com/phpenv/phpenv`
	- You may need to `brew install bison gd`. If so, you will need to link it `brew link bison --force` because it overwrites the system install.
	- Compile php with Postgres support. Modify `./phpenv/etc/php.#.#.PLATFORM.source` to include:
	
    		--with-pgsql=/usr/local/bin/pg_config
    		--with-pdo-pgsql=/usr/local/bin/pg_config

2. Install composer - `curl -sS https://getcomposer.org/installer | php`.  Rename `composer.phar` to `composer` add it to `/usr/local/bin/`.

3. Create a new Laravel project - `composer create-project laravel/laravel PROJECT_NAME --prefer-dist`4. 
	- Optionally, you can run off of edge by simply cloning `https://github.com/laravel/laravel/` and creating a `master` branch.

