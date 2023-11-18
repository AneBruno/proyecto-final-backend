#!/bin/bash

php artisan passport:install
php artisan cache:clear
php artisan config:clear

serverless deploy --stage staging --force 
