<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Project

This is a test project. The application built is a blog application (Sports) using PHP and JavaScript.

## Technologies 

The application was built using the following technologies:

- PHP (Laravel 10)
- JavaScript (Vue) (tested on node v20.2.0)

## How to install

Kindly follow the steps below to setup the project on your local machine:

- Clone this repository to your workfolder
- Open your terminal and run the command `cd workfolder`, where workfolder is the name of your work folder
- Install composer dependencies by running the command `composer install` in your terminal
- Install npm dependencies by running the command `npm i` in your terminal
- Create `.env` file in your workfolder base and copy/paste the content from `.env.example` into your create `.env` file
- Update the details in your .env with information on your running database
- Generate application key, by running the command `php artisan key:generate` in your terminal
- Migrate the database by running the command `php artisan migrate`
- Load content in your database by running the command `php artisan db:seed`
- Build frontend file by running `npm run build`
- Server your application using `php artisan serve`
- Open your browser and navigate to `http://localhost:8000` to view the application

## Application Features

- Basic Authentication using Laravel auth scaffold
- Users can perform CRUD operations on posts
- Users can comment on posts
- Posts are displayed on the homepage
- Post can be previewed by clicking on the post
- Post can be searched using the search bar
- API for CRUD operation for post
- API for post listing and previews

## Testing 

The basic features have been covered by unit test. To run the unit test, run `./vendor/bin/phpunit` on your terminal