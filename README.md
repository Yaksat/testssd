<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Laravel Framework 9.52.8

Перейдите в папку, в которой собираетесь разворачивать проект.
1) git clone
2) composer install
3) cp .env.example .env (настроить)
4) php artisan key:generate
5) php artisan storage:link
6) php artisan migrate

Start via docker
1) cp .env.example .env
2) docker compose up -d
3) docker compose exec app composer install
4) docker compose exec app php artisan key:generate
5) docker compose exec app php artisan storage:link
