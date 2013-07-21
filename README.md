# Sample laravel app

The app is in the tinycms folder. All the following is executed within the dir.

All dependencies have been vendorized.

### Notes

#### Starting the application

To start the application

`php -S localhost:8000 server.php`

#### Laravel console

1. Run
	`php artisan boris`
2. Execute commands - e.g.
echo User::all();

#### Testing

1. Factories - https://packagist.org/packages/breerly/factory-girl-php (might not work with Laravel ORM ?)


#### Adding new packages to application

1. Add a dependency to vendor and composer.json at the same time 

	`composer require davejamesmiller/laravel-boris dev-master`

#### Fresh setup

1. Install phpenv - github.com/phpenv/phpenv
2. Install composer - `curl -sS https://getcomposer.org/installer | php`
3. Install laravel with new project - `composer create-project laravel/laravel your-project-name --prefer-dist`




