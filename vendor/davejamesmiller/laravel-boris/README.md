# Laravel Boris

Adds an `artisan boris` command to [Laravel 4][1] that runs the [Boris REPL][2]
in the Laravel environment.

## Installation

### 1. Install with Composer
```bash
composer require davejamesmiller/laravel-boris dev-master
```

This will update `composer.json` and install it into the `vendor/` directory.

**Note:** `dev-master` is the latest development version.
See the [Packagist website][3] for a list of other versions.

### 2. Add to `app/config/app.php`
```php
    'providers' => array(
        // ...
        'DaveJamesMiller\Boris\BorisServiceProvider',
    ),
```

This registers the Artisan task with Laravel.

## Usage
```bash
php artisan boris
```

## Changelog
### 1.0.0
* Initial release

## License
MIT License. See [LICENSE.txt][4].

[1]: http://four.laravel.com/
[2]: https://github.com/d11wtq/boris
[3]: https://packagist.org/packages/davejamesmiller/laravel-boris
[4]: LICENSE.txt
