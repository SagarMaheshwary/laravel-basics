# Laravel 5.8 Basics
This is an example application built on Laravel and Bootstrap for beginners.

## Running this web application

- make sure you already have [xampp](https://www.apachefriends.org/index.html) installed.

- clone this repository to your local machine or just download the zip from the above green button.

- install [Composer](https://getcomposer.org/download) first, then run this command in your command-line (you should be inside your project directory). 
```bash
  composer install
```

- rename .env.example to .env and add your database and mail driver credentials.

- generate application key.
```bash
    php artisan key:generate
```
- Start the development server.
```bash
    php artisan serve
```
> This is the initial state of the application and no changes have been made.