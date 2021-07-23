#!/bin/bash

#composer create-project laravel/laravel ster

composer install 

if [ ! -f ".env" ]
then
  cp .env.example .env
  php artisan key:generate
fi

php artisan migrate