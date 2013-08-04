# Our sample Laravel app

## Machine setup with provided Vagrantfile:

1. Install Vagrant on your machine (http://vagrantup.com)

2. Run 

        vagrant up

3. Access the vagrant image via:

        vagrant ssh

4. Install the dependencies for the sample application via 

        cd /vagrant; composer.phar install

## Project setup:

1. Create the user & database

        createuser -Upostgres -hlocalhost -s vagrant
        createdb -Upostgres -hlocalhost laravel_sample_app_development

2. Install migrations 

        php artisan migrate:install

3. Migrate and seed the database 

        php artisan migrate --seed

## Start the application:

        $ php artisan serve --host <eth0 IP address if youre using vagrant>

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


# Setting up a fresh project from scratch (on MacOSX)

1. Install phpenv - `https://github.com/phpenv/phpenv`
	- You may need to `brew install bison gd`. If so, you will need to link it `brew link bison --force` because it overwrites the system install.
	- Compile php with Postgres support. Modify `./phpenv/etc/php.#.#.PLATFORM.source` to include:
	
    		--with-pgsql=/usr/local/bin/pg_config
    		--with-pdo-pgsql=/usr/local/bin/pg_config

2. Install composer - `curl -sS https://getcomposer.org/installer | php`.  Rename `composer.phar` to `composer` add it to `/usr/local/bin/`.

3. Create a new Laravel project - `composer create-project laravel/laravel PROJECT_NAME --prefer-dist`4. 
	- Optionally, you can run off of edge by simply cloning `https://github.com/laravel/laravel/` and creating a `master` branch.

