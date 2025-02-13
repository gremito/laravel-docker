#!/bin/bash
set -e

composer install

APP_KEY=$(grep '^APP_KEY=' .env | cut -d '=' -f2-)
if [ -z "$APP_KEY" ]; then
  echo "APP_KEY is not set. Generating new key..."
  php artisan key:generate

  if [ $? -eq 0 ]; then
    echo "APP_KEY generated successfully."
  else
    echo "Error: Failed to generate APP_KEY."
    exit 1
  fi
fi

php artisan octane:start --server=swoole --host=0.0.0.0 --port=9000
