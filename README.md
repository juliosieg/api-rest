# Cat API
  
This API's purpose is to provide information about cats based on TheCatAPI data.  

## The problem and how it was solved

This code is responsible for fetching data on TheCatAPI, about breeds of cats. The requested races are passed by parameter in the API call URL. However, care must be taken to cache the information so that you do not have to make too many API requests for information that you have previously searched for. For this, with each call of the URL, a check in the database is made to know if the information already exists. If the answer is no, the data is searched in TheCatAPI and if the results are as expected, these results will be saved in the database for future reference.

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
