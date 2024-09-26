#!/bin/bash
set -e
composer install
php --ri opentelemetry
php artisan octane:start --server=swoole --host=0.0.0.0 --port=9000
