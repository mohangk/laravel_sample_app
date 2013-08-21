# Our sample Laravel app

## Machine setup with provided Vagrantfile:

1. Install Vagrant on your machine (http://vagrantup.com)

2. Run 

        vagrant up

3. Access the vagrant image via:

        vagrant ssh

4. Install the dependencies for the sample application via 

        cd /vagrant
        ./composer.phar install
        bundle install

## Project setup:

1. Create the user & database

        createuser -Upostgres -hlocalhost -s vagrant
        createdb -Upostgres -hlocalhost laravel_sample_app_development
        createdb -Upostgres -hlocalhost laravel_sample_app_test

2. Install migrations 

        php artisan migrate:install
        php artisan migrate:install --env=testing

3. Migrate and seed the database 

        php artisan migrate --seed
        php artisan migrate --seed --env=testing

## Start the application:

        php artisan server --host <eth0 IP address if youre using vagrant>

## Console:

Laravel has a default console - `tinker` - but it's not very nice.  Use `boris` instead:

        php artisan boris
        > User::all();
        
## Testing


### Test database 

1. We have created a separate database `laravel_sample_app_test` for which all tests. Please don't use your development database for tests. We achieve this by creating an additional `testing` environment that can be accessed from artisan via the --env=testing flag.

### Running all tests

We're using Codeception for our specifications.  To run all the tests, execute:

    	./codeception.phar run

You can specify a particular suite:

    	./codeception.phar run unit

### Debugging tests

1. In order to debug a test do refer to the [setup step debugging](#setup_step_debugging) of this documentation.

### Acceptance tests

1.  Acceptance tests drive the Firefox browser on the host machine, they have been setup for that. To start acceptance tests, firstly run the selenium server on the host machine, the provision script would of downloaded it into the `scripts` folder.

		user@host-machine $ java -jar scripts/selenium-server-standalone-2.35.0.jar

2. On vagrant, run your app in the test environment on port 3444
	
		vagrant@vagrant-ubuntu-raring-64:/vagrant$ php artisan server --host 10.0.2.15 --port 3444

2. On vagrant, start the acceptance tests
	
		vagrant@vagrant-ubuntu-raring-64:/vagrant$ ./vendor/bin/codecept run acceptance

### Feature tests

1. Feature specs will be like acceptance but without going through an actual server (like using Rack driver for capybara). This is how codeception does things, so best we just follow

### Unit tests

### Factories

### Mocking

### Javascript

### CI
        
## <a id="setup_step_debugging"></a> Step debugging

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

## Asset organization

1. We use [Basset](https://github.com/jasonlewis/basset) for asset compilation.
2. There's a configuration file in `app/config/packages/jasonlewis/basset/config.php` that specifies the directories it'll compile.
3. To add new scss or coffescript files to the project, put them in `app/public/stylesheets/` and `app/public/assets/javascripts/` respectively.

## Dependencies

1. Add new dependencies to `composer.json` and then run `./composer.phar update`

2. (optional) Add any new dependencies and vendor at the same time
  
    	./composer.phar require davejamesmiller/laravel-boris dev-master

# Setting up a fresh project from scratch (on MacOSX)

1. Install phpenv - `https://github.com/phpenv/phpenv`
	- You may need to `brew install bison gd`. If so, you will need to link it `brew link bison --force` because it overwrites the system install.
	- Compile php with Postgres support. Modify `./phpenv/etc/php.#.#.PLATFORM.source` to include:
	
    		--with-pgsql=/usr/local/bin/pg_config
    		--with-pdo-pgsql=/usr/local/bin/pg_config

2. Install composer 
		curl -sS https://getcomposer.org/installer | php
		
3. Create a new Laravel project 
	`./composer.phar create-project laravel/laravel PROJECT_NAME --prefer-dist`

  OR

  You can run off of edge by simply cloning `https://github.com/laravel/laravel/` and creating a `master` branch.

