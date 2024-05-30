# Recipe Management API - CDV Project
[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2F2ce8c01b-8a0e-4df9-af7b-a95720c1fe06%3Fdate%3D1%26commit%3D1&style=plastic)](https://forge.laravel.com/servers/793900/sites/2365743)

This is a Laravel-based API for managing recipes, ingredients, and ingredient lists. It supports operations such as creating, updating, deleting, and listing recipes and ingredients, as well as managing ingredients within a recipe and an ingredients list.

## Prerequisites

- PHP >= 7.4
- Composer
- Laravel >= 8.x
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
