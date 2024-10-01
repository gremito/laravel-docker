#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

php artisan migrate
php artisan optimize
php artisan view:cache

php-fpm --nodaemonize
