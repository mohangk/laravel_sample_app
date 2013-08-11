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
        createdb -upostgres -hlocalhost laravel_sample_app_development
        createdb -upostgres -hlocalhost laravel_sample_app_test

2. Install migrations 

        php artisan migrate:install
        php artisan migrate:install --env=testing

3. Migrate and seed the database 

        php artisan migrate --seed

## Start the application:

        $ php artisan serve --host <eth0 IP address if youre using vagrant>

## Console:

Laravel has a default console - `tinker` - but it's not very nice.  Use `boris` instead:

        php artisan boris
        > User::all();
        
## <a id="setup_step_debugging"></a>Setup step debugging

### Overview

We have created a [screencast](https://vimeo.com/72085960) to help with getting started with step debugging. 

There are different parts to setting up step debugging for PHP. We will need to 

 * Make sure xdebug is setup on vagrant and working properly
 * Setup a browser extension that will help signalling to xdebug that the debugger session should be started
 * Have an xdebug-client that will be able to speak to xdebug session 
 
### Xdebug setup on Vagrant box

1. The Vagrant provision script would of setup our xdebug for remote debugging in our ubuntu box. 
			
### Install xdebug helper for Chrome

1. Xdebug only enables itself when it receives the right flag in a request. 

2. To easily enable and disable debugging, install [Xdebug helper](http://goo.gl/HuNptD) 

3. When you enable debugging, the server will break rightaway and try to connect to your xdebug client, so only turn it on if you actually want to debug.	
	
### Install an xdebug client

#### Installing MacGDBp

1. Install from its [homepage](http://www.bluestatic.org/software/macgdbp/)
2. Set break points from within the code by making a call to xdebug_break()

#### Installing Vdebug plugin for Vim

1. Install Vdebug for remote debugging on your hostbox Vim instance. Copy the following into your plugin_config.vim. Change "/Users/mohan/Projects/laravel_sample_app" to where the root of project is on your machine, restart your vim and run :BundleInstall (This uses vundle, if you're using neo vim-config you're fine)

		Bundle 'joonty/vdebug.git'
		  let g:vdebug_options= {
		            \    "port" : 9000,
		            \    "server" : 'localhost',
		            \    "timeout" : 20,
		            \    "on_close" : 'detach',
		            \    "break_on_open" : 0,
		            \    "continuous_mode" : 0,
		            \    "ide_key" : '',
		            \    "path_maps" : {'/vagrant' : '/Users/mohan/Projects/laravel_sample_app'},
		            \    "debug_window_level" : 0,
		            \    "debug_file_level" : 1,
		            \    "debug_file" : "/tmp/vdebug.log",
		            \    "watch_window_style" : 'expanded',
		            \    "marker_default" : '⬦',
		            \    "marker_closed_tree" : '▸',
		            \    "marker_open_tree" : '▾'
		            \}
		            
2. I'll write a longer HOWTO use guide. For now though the plugin docs are pretty well written.		            
		            
		       
## Testing

PHPUnit has been vendored.  To run the test execute

    ./vendor/bin/phpunit ./tests

That's quite verbose so it's recommended you add an alias in your shell.
In order to debug a spec do refer to the [setup step debugging](#setup_step_debugging) of this documentation.

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

