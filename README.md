# This is the plenty/logger package, should be used with composer, in the current version it is easy to use together with laravel

- To use it in your laravel project first add in your composer.json the repository like this:

```
"repositories": [
{
"type": "vcs",
"url": "https://github.com/raducumbogdan/plentylogger"
}
]
```
- Then run command `composer require plenty/logger`
- If you want to log in mysql you should do a `php artisan migrate`
- You should then configure your `config/plentylogger.php` like our `config/plentylogger.php.example`
- To add a new driver go to `src/Drivers/` and make sure to treat it correctly in the `src/Providers/PlentyLoggerServiceProvider.php`


# Have fun !
