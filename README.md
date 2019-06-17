# Cat API
  
This API's purpose is to provide information about cats based on TheCatAPI data.  

## Requirements

Laravel:
- PHP >= 7.1.3

## Installation

This application can be installed using [Composer](https://getcomposer.org/).

```bash
composer install
``` 

Afterwards, generate the app key: 
```bash
php artisan key:generate
```  

**Note:** dependency conflicts may appear during update. In that case, delete the *composer.lock* file and run `composer install`.

## Running 

Using a web server during development is not required. The project can be run using Laravel's built-in server, available through [Artisan](https://laravel.com/docs/5.8/artisan): 

```bash
php artisan serve --host 192.168.0.100 --port 8000
```  

**Note:**  `host` and `port` are optional parameters. By default, `serve` runs the application at http://localhost:8000.
