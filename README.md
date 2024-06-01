<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Recipes Management API - CDV Project

[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2F2ce8c01b-8a0e-4df9-af7b-a95720c1fe06%3Fdate%3D1%26commit%3D1&style=plastic)](https://forge.laravel.com/servers/793900/sites/2365743)
![CI](https://github.com/dawid-olejniczak/recipes-api/actions/workflows/phpunit.yml/badge.svg)


This is a Laravel-based API for managing recipes, ingredients, and ingredient lists. It supports operations such as creating, updating, deleting, and listing recipes and ingredients, as well as managing ingredients within a recipe and an ingredients list.

## Cool technical details about the project
- CI/CD is set up through Github Action and Forge
- It uses latest version of Laravel Framework 
- Full API documention is set up through Postman Collections and available online. You can find the collection [here](https://www.postman.com/dawidolejniczak/workspace/recipes-api-cdv/collection/6311894-ebf128bb-3bba-4f7a-900a-53f92d876a00).
- It's deployed live! [http://167.71.40.16/recipes](http://167.71.40.16/recipes).

## Prerequisites

- PHP >= 8.2
- Composer
- Laravel >= 11.x
- MySQL or any other database supported by Laravel

## Setup Instructions

1. **Clone the repository**: `git clone https://github.com/dawid-olejniczak/recipes-api.git && cd recipes-api`
2. **Install dependencies**: `composer install`
3. **Copy `.env.example` to `.env`**: `cp .env.example .env`
4. **Generate application key**: `php artisan key:generate`
5. **Configure the `.env` file**: Update your database credentials and other settings in the `.env` file.
6. **Run migrations**: `php artisan migrate`
7. **Run seeders (optional)**: `php artisan db:seed`
8. **Serve the application**: `php artisan serve`

## Postman Collection

You can find the Postman collection to interact with the API in the repository under the `postman` directory. Import the collection into Postman to test the API endpoints.

## Features

- Create, update, delete, and list recipes
- Create, update, delete, and list ingredients
- Manage ingredients within recipes
- Manage ingredients within an ingredients list
- Mark ingredients as completed or uncompleted in the ingredients list
