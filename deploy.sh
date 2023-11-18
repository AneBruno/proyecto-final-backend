#!/bin/bash

php artisan passport:install
php artisan cache:clear
php artisan config:clear

npm install -g serverless
serverless plugin install -n serverless-prune-plugin
serverless plugin install -n serverless-lift

serverless prune -n 1
serverless deploy --stage staging --force 
