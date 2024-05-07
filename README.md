<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About

- Laravel 11.6.0
- PHP 8.2.18

## Set Up

- composer install
- docker-compose up -d --build
- php artisan key:generate
- docker exec -it leme-leme-web-1 php artisan migrate --seed
- docker exec -it leme-leme-web-1 php artisan storage:link
- docker exec -it leme-leme-web-1 php artisan optimize:clear (if necessary)

## Database .env
```shell
    DB_CONNECTION=pgsql
    DB_HOST=leme-db
    DB_PORT=5432
    DB_DATABASE=postgres
    DB_USERNAME=postgres
    DB_PASSWORD=postgres
```    

## Access
- http://localhost:9000
- admin@teste.com | secret